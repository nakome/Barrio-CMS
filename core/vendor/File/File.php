<?php
/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare(strict_types=1);

namespace File;

/*
 * Acceso restringido
 */
defined('ACCESS') or exit('No tiene acceso a este archivo');

/**
 * Class File.
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 */
class File
{
    /**
     * Escanea los archivos recursivamente.
     *
     * <code>
     *  File::scan(CONTENT,'md',false);
     * </code>
     *
     * @param string $folder    the folder
     * @param string $type      extension
     * @param bool   $file_path boolean
     *
     * @return array
     */
    public static function scan(string $folder = '', string $type = null, bool $file_path = true)
    {
        $data = [];
        if (is_dir($folder)) {
            $iterator = new \RecursiveDirectoryIterator($folder);
            foreach (new \RecursiveIteratorIterator($iterator) as $file) {
                if (null !== $type) {
                    if (is_array($type)) {
                        $file_ext = substr(strrchr($file->getFilename(), '.'), 1);
                        if (in_array($file_ext, $type)) {
                            if (strpos($file->getFilename(), $file_ext, 1)) {
                                if ($file_path) {
                                    $data[] = $file->getPathName();
                                } else {
                                    $data[] = $file->getFilename();
                                }
                            }
                        }
                    } else {
                        if (strpos($file->getFilename(), $type, 1)) {
                            if ($file_path) {
                                $data[] = $file->getPathName();
                            } else {
                                $data[] = $file->getFilename();
                            }
                        }
                    }
                } else {
                    if ('.' !== $file->getFilename() && '..' !== $file->getFilename()) {
                        if ($file_path) {
                            $data[] = $file->getPathName();
                        } else {
                            $data[] = $file->getFilename();
                        }
                    }
                }
            }

            return $data;
        } else {
            return false;
        }
    }

    /**
     * Minify json
     *
     * @source https://searchcode.com/codesearch/raw/34805091/
     * @param (string) $json json file
     * @return json
     */
    public static function jsonMinify($json)
    {
        $tokenizer = "/\"|(\/\*)|(\*\/)|(\/\/)|\n|\r/";
        $in_string = false;
        $in_multiline_comment = false;
        $in_singleline_comment = false;
        $new_str = [];
        $from = 0;
        $lastIndex = 0;

        while (preg_match($tokenizer, $json, $tmp, PREG_OFFSET_CAPTURE, $lastIndex)) {
            $tmp = $tmp[0];
            $lastIndex = $tmp[1] + strlen($tmp[0]);
            $lc = substr($json, 0, $lastIndex - strlen($tmp[0]));
            $rc = substr($json, $lastIndex);
            if (!$in_multiline_comment && !$in_singleline_comment) {
                $tmp2 = substr($lc, $from);
                if (!$in_string) {
                    $tmp2 = preg_replace("/(\n|\r|\s)*/", '', $tmp2);
                }
                $new_str[] = $tmp2;
            }
            $from = $lastIndex;

            if ('"' == $tmp[0] && !$in_multiline_comment && !$in_singleline_comment) {
                preg_match('/(\\\\)*$/', $lc, $tmp2);
                if (!$in_string || !$tmp2 || (strlen($tmp2[0]) % 2) == 0) { // start of string with ", or unescaped " character found to end string
                    $in_string = !$in_string;
                }
                --$from; // include " character in next catch
                $rc = substr($json, $from);
            } elseif ('/*' == $tmp[0] && !$in_string && !$in_multiline_comment && !$in_singleline_comment) {
                $in_multiline_comment = true;
            } elseif ('*/' == $tmp[0] && !$in_string && $in_multiline_comment && !$in_singleline_comment) {
                $in_multiline_comment = false;
            } elseif ('//' == $tmp[0] && !$in_string && !$in_multiline_comment && !$in_singleline_comment) {
                $in_singleline_comment = true;
            } elseif (("\n" == $tmp[0] || "\r" == $tmp[0]) && !$in_string && !$in_multiline_comment && $in_singleline_comment) {
                $in_singleline_comment = false;
            } elseif (!$in_multiline_comment && !$in_singleline_comment && !(preg_match("/\n|\r|\s/", $tmp[0]))) {
                $new_str[] = $tmp[0];
            }
        }
        $new_str[] = $rc;

        return implode('', $new_str);
    }
}
