<?php
//добавляем параметры для работы в админке 
$moduleurl = 'index.php?a=112&id='.$_GET['id'].'&';

/**
 * MODx Installer
 */
// do a little bit of environment cleanup if possible
if (version_compare(phpversion(), "5.3") < 0) {
    @ ini_set('magic_quotes_runtime', 0);
    @ ini_set('magic_quotes_sybase', 0);
}

$self = $modulePath.'index.php';
require_once("{$modulePath}functions.php");

// set error reporting
error_reporting(E_ALL & ~E_NOTICE);
//ini_set('display_errors',1);
//error_reporting(E_ALL);

$_lang = array();
$_params = array();
require_once($modulePath."lang/russian-UTF8.inc.php");
require_once('includes/version.inc.php');

// start session
//session_start();
$_SESSION['test'] = 1;
install_sessionCheck();

$moduleName = "MODX";
$moduleVersion = $modx_branch.' '.$modx_version;
$moduleRelease = $modx_release_date;
$moduleSQLBaseFile = "setup.sql";
$moduleSQLDataFile = "setup.data.sql";

$moduleChunks = array (); // chunks - array : name, description, type - 0:file or 1:content, file or content
$moduleTemplates = array (); // templates - array : name, description, type - 0:file or 1:content, file or content
$moduleSnippets = array (); // snippets - array : name, description, type - 0:file or 1:content, file or content,properties
$modulePlugins = array (); // plugins - array : name, description, type - 0:file or 1:content, file or content,properties, events,guid
$moduleModules = array (); // modules - array : name, description, type - 0:file or 1:content, file or content,properties, guid
$moduleTemplates = array (); // templates - array : name, description, type - 0:file or 1:content, file or content,properties
$moduleTVs = array (); // template variables - array : name, description, type - 0:file or 1:content, file or content,properties

$errors= 0;

// get post back status
$isPostBack = (count($_POST));
$action= isset ($_GET['action']) ? trim(strip_tags($_GET['action'])) : 'load';

ob_start();
echo '<!DOCTYPE html>
<html><head><title>Install</title>
<meta http-equiv="Content-Type" content="text/html; charset="utf-8" />
<link rel="stylesheet" href="/assets/modules/install/style.css" type="text/css" media="screen" /></head>
<body><div id="contentarea"><div class="container_12"><br>';

if (!@include ('action.' . $action . '.php')) {
    die ('Invalid install action attempted. [action=' . $action . ']');
}

echo "</div><!-- // content --></div><!-- // contentarea --><br /></body></html>";
ob_end_flush();

?>