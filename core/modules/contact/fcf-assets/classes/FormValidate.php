<?php
// ************************************
// This file is part of a package from:
// www.freecontactform.com
// See license for details
// ************************************

class FormValidate {
    
    private $error_messages = array(); 
    
    public function validate($value, $field_rules) {

        $display_name = $field_rules['label'];

        // exclude if not required and no value passed
        if(!$field_rules['required'] && $this->isEmpty($value)) {
            return;
        }

        // check required and no value passed
        if($field_rules['required'] && $this->isEmpty($value)) {
            $this->error_messages[] = "'$display_name' is required";
            return;
        }

        // validate minLength
        if(isset($field_rules['minLength'])) {
            if(!$this->minlength($value, $field_rules['minLength'])) {
                $this->error_messages[] = "'$display_name' must contain a minimum of {$field_rules['minLength']} characters";
                return;
            }
        }

        // validate maxLength
        if(isset($field_rules['maxLength'])) {
            if(!$this->maxlength($value, $field_rules['maxLength'])) {
                $this->error_messages[] = "'$display_name' must contain a maximum of {$field_rules['maxLength']} characters";
                return;
            }
        }

        // validate min
        if(isset($field_rules['min'])) {
            if(!$this->minValue($value, $field_rules['min'])) {
                $this->error_messages[] = "'$display_name' must contain a minimum value of {$field_rules['min']}";
                return;
            }
        }

        // validate max
        if(isset($field_rules['max'])) {
            if(!$this->maxValue($value, $field_rules['max'])) {
                $this->error_messages[] = "'$display_name' must contain a maximum value of {$field_rules['max']}";
                return;
            }
        }

        // validate email address
        if(isset($field_rules['email']) && $field_rules['email']) {
            if(!$this->validEmail($value)) {
                $this->error_messages[] = "'$display_name' requires a valid email address";
                return;
            }
        }

        // validate the file upload type
        if(isset($field_rules['fileTypes'])) {
            if(!$this->validFileType($value['name'], $field_rules['fileTypes'])) {
                $this->error_messages[] = "'$display_name' has an invalid file type";
                return;
            }
        }

        // validate the file upload maximum size
        if(isset($field_rules['fileMaxSize'])) {
            if(!$this->validFileSize($value['size'], $field_rules['fileMaxSize'])) {
                $this->error_messages[] = "'$display_name' must be less than {$field_rules['fileMaxSize']}Kb in size";
                return;
            }
        }

    }
    
    public function anyErrors() {
        if(count($this->error_messages) > 0) {
            return true;
        }
        return false;
    }
    
    public function getErrorString() {
        $return_value = "";
        foreach($this->error_messages as $message) {
            $return_value .= "<li>$message</li>";
        }
        return $return_value;
    }
    
    private function isEmpty($value) {
        if(is_array($value)) {
            foreach($value as $val) {
                return $this->isEmpty($val);
            }
        }
        if (trim($value) == "") {
            return true;
        } else {
            return false;
        } 
    } 

    private function validFileType($value_name, $type_options) {
        $acceptable_types = explode(",",strtolower($type_options));
        if(is_array($value_name)) {
            foreach($value_name as $filename) {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!in_array(strtolower($ext), $acceptable_types)) {
                    return false;
                }
            }
        } else {
            $ext = pathinfo($value_name, PATHINFO_EXTENSION);
            if (!in_array(strtolower($ext), $acceptable_types)) {
                return false;
            }
        }
        return true;
    }

    private function validFileSize($value_size, $maxfilesize) {
        if(is_array($value_size)) {
            foreach($value_size as $filesize) {
                if($filesize == 0 || ($filesize / 1024) > $maxfilesize) {
                    return false;
                }
            }
        } else {
            if($value_size == 0 || ($value_size / 1024) > $maxfilesize) {
                return false;
            }
        }
        return true;
    }

    private function validEmail($value) {
        $exp = '/^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i';
        if (!preg_match($exp, $value)) {
            return false;
        }
        return true;
    }

    private function minlength($value, $minlength) {
        if(strlen(trim($value)) < $minlength) {
            return false;
        }
        return true;
    }

    private function maxlength($value, $maxlength) {
        if(strlen(trim($value)) > $maxlength) {
            return false;
        }
        return true;
    }

    private function minValue($value, $min) {
        if(trim($value) < $min) {
            return false;
        }
        return true;
    }

    private function maxValue($value, $max) {
        if(trim($value) > $max) {
            return false;
        }
        return true;
    }
    
}