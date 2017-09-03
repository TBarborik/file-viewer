<?php

/**
 * Class Lib
 * Static class with helper methods and constants.
 */
class Lib
{

    const IMAGE_EXTENSIONS = array("png", "jpg", "jpeg", "gif");

    /**
     * Returns path to the current working directory.
     * Works with GET parameter.
     * @return string
     */
    public static function getWorkingDirectory(): string
    {
        $dir = DOCROOT;

        if (isset($_GET["dir"]) && strlen($_GET["dir"]) > 0) {
            $dirPath = urldecode($_GET["dir"]);

            $parts = explode(DIRECTORY_SEPARATOR, $dirPath);
            if ($parts[count($parts) - 1] == "..") {
                unset($parts[count($parts) - 1]);
                unset($parts[count($parts) - 1]);
                $dirPath = implode(DIRECTORY_SEPARATOR, $parts);
            }

            if (file_exists($dirPath) && is_dir($dirPath)) {
                $dir = $dirPath;
            } else if (file_exists(DOCROOT . $dirPath) && is_dir(DOCROOT . $dirPath)) {
                $dir = DOCROOT . $dirPath;
            }
        }

        if (substr($dir, -1, 1) !== DIRECTORY_SEPARATOR)
            $dir .= DIRECTORY_SEPARATOR;

        return $dir;
    }

    /**
     * Returns action for file manager to do.
     * Works with GET parameter.
     * @return string
     */
    public static function getAction(): string
    {
        $action = "nothing";
        if (isset($_GET["action"]) && strlen($_GET["action"]) > 0) {
            $action = $_GET["action"];
        }

        return $action;
    }

    /**
     * Returns file path to the file obtained in the GET parameter
     * only if exists.
     * @return string
     */
    public static function getFilePath(): string
    {
        if (isset($_GET["file"]) && strlen($_GET["file"]) > 0 && file_exists($_GET["file"])) {
            return $_GET["file"];
        } else {
            return "";
        }
    }

    /**
     * Checks if given string matches at least on of the patterns.
     * @param array $patterns
     * @param string $str
     * @return bool
     */
    public static function matchArray(array $patterns, string $str): bool
    {
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $str) === 1)
                return true;
        }

        return false;
    }

    /**
     * Removes last directory (the deepest one) from given path.
     * @param string $path
     * @return string
     */
    public static function stripLast(string $path): string
    {
        $parts = explode(DIRECTORY_SEPARATOR, $path);

        if (count($parts) <= 1)
            return DIRECTORY_SEPARATOR;

        if ($parts[count($parts) - 1] == '') {
            if (count($parts) > 1) {
                unset($parts[count($parts) - 2]);
            } else {
                return DIRECTORY_SEPARATOR;
            }
        } else {
            unset($parts[count($parts) - 1]);
        }

        return implode(DIRECTORY_SEPARATOR, $parts);
    }
}