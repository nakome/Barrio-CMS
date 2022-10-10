<?php
/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare(strict_types=1);

/*
 * Acceso restringido
 */
defined('ACCESS') or exit('No tiene acceso a este archivo');

include 'functions/Assets.php';
include 'functions/Actions.php';
include 'functions/Config.php';
include 'functions/Url.php';
include 'functions/UrlCurrent.php';
include 'functions/ImageToDataUri.php';
include 'functions/Menu.php';
include 'functions/Posts.php';
include 'functions/PrimaryPost.php';
include 'functions/LastPosts.php';
include 'functions/GenerateAttrs.php';
include 'functions/NavFolder.php';
include 'functions/Search.php';

