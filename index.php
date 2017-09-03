<?php
/**
 * Simple file viewer for web purposes.
 * @author Tom Barbořík
 * @version 1.0
 */

define('DOCROOT', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR); // Set the full path to the docroot
define('TEMPLATE', DOCROOT . "template" . DIRECTORY_SEPARATOR);
define('CLASSES', DOCROOT . "classes" . DIRECTORY_SEPARATOR);
define('MEDIA', DOCROOT . "media" . DIRECTORY_SEPARATOR);

// Set autoloading
spl_autoload_register(function (string $className) {
    $classPath = CLASSES. strtolower($className) . ".php";
    include_once($classPath);
});

$action = Lib::getAction();

try {
    $fm = new FileManager(Lib::getWorkingDirectory());

    switch ($action) {
        //case "download": {
        //    $fm->downloadFile(Lib::getFilePath());
        //    break;
        //}

        case "show": {
            $fm->showFile(Lib::getFilePath());
            break;
        }
    };

} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}

// Front-end generation through class Page
$page = new Template("base");
$page->dirContent = $fm->getDirectoryContent();
$page->dir = Lib::getWorkingDirectory();
$page->render();
echo $page;