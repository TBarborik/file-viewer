<?php

class FileManager
{
    private $currentDirectory;
    private $directoryContent = array();
    private $ignore = array("/^\.$/");

    /**
     * FileManager constructor.
     * @param string $currentDirectory
     */
    public function __construct(string $currentDirectory)
    {
        $this->currentDirectory = $currentDirectory;
        $this->scanDirectoryContent();
    }

    /**
     * @throws Exception
     */
    private function scanDirectoryContent()
    {
        if (!file_exists($this->currentDirectory) || !is_dir($this->currentDirectory)) {
            throw new Exception("Directory " . $this->currentDirectory . " does not exist.");
        }

        $content = scandir($this->currentDirectory);
        foreach ($content as $c) {
            if (Lib::matchArray($this->ignore, $c)) {
                continue;
            }

            $file = array();
            $file["name"] = $c;

            $file["fullPath"] = $this->currentDirectory . $c;

            if ($c == "..") {
                $file["fullPath"] = Lib::stripLast($this->currentDirectory);
            }

            if (is_dir($file["fullPath"])) {
                $file["type"] = "directory";
            } else {
                $file["type"] = "file";
            }

            array_push($this->directoryContent, $file);
        }
    }

    /**
     * @return array
     */
    public function getDirectoryContent(): array
    {
        return $this->directoryContent;
    }

    /**
     * @param string $filePath
     * @throws Exception
     */
    public function downloadFile(string $filePath)
    {
        if (!file_exists($filePath) || !is_file($filePath)) {
            throw new Exception("File for download does not exist (" . $filePath . ")");
        }

        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }

    /**
     * @param string $filePath
     * @throws Exception
     */
    public function showFile(string $filePath)
    {
        if (!file_exists($filePath) || !is_file($filePath)) {
            throw new Exception("File for print does not exist (" . $filePath . ")");
        }

        $finfo = pathinfo($filePath);

        $page = new Template("file");
        $page->filePath = $filePath;
        $page->fileContent = htmlspecialchars(file_get_contents($filePath));
        $page->fileInfo = $finfo;
        $page->imgExtensions = Lib::IMAGE_EXTENSIONS;

        $page->render();
        echo $page;
        exit;
    }
}