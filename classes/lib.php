<?php

class Lib
{

    const IMAGE_EXTENSIONS = array("png", "jpg", "jpeg", "gif");

    /**
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