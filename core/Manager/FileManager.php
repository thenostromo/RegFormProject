<?php
namespace Core\Manager;

class FileManager
{
    /**
     * @var string
     */
    private $projectFolder;

    /**
     * @var string
     */
    private $tmpStorage;

    /**
     * @var string
     */
    private $avatarStorage;

    public function __construct()
    {
        $this->projectFolder = $_SERVER['DOCUMENT_ROOT'];
        $this->tmpStorage = "public/tmp";
        $this->avatarStorage = "public/avatar";
    }

    /**
     * @param array $file
     * @return string
     */
    public function moveToTmp($file)
    {
        if ($this->isValidExtension($file["type"])) {
            $newPath = $this->projectFolder . "/" . $this->tmpStorage . "/" . $file["name"];
            rename($file["tmp_name"], $newPath);
        }
        return $this->tmpStorage . "/" . $file["name"];
    }

    /**
     * @param string $tmpFile
     * @return string
     */
    public function moveToAvatarStorage($tmpFile)
    {
        $filename = str_replace($this->tmpStorage . "/", "", $tmpFile);

        $oldPath = $this->projectFolder . "/" . $this->tmpStorage . "/" . $filename;
        $newPath = $this->projectFolder . "/" . $this->avatarStorage . "/" . $filename;
        rename($oldPath, $newPath);

        return $filename;
    }

    /**
     * @param string $extension
     * @return bool
     */
    private function isValidExtension(string $extension)
    {
        return ($extension === 'image/png'
            || $extension === 'image/jpg'
            || $extension === 'image/jpeg'
            || $extension === 'image/gif');
    }
}