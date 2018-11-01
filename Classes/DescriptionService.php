<?php
namespace Classes;

class DescriptionService
{

    var $baseDir;

    var $fileName;

    public function setConstants()
    {
        $this->fileName = 'description.json';
    }

    public function __construct($baseDir)
    {
        $this->setConstants();
        $this->setBaseDir($baseDir);
    }

    /**
     *
     * @return mixed
     */
    public function getBaseDir()
    {
        return $this->baseDir;
    }

    /**
     *
     * @param mixed $baseDir
     */
    public function setBaseDir($baseDir)
    {
        $this->baseDir = $baseDir;
    }

    function loadDescription()
    {
        $current_desc_file = $this->baseDir . "/" . $this->fileName;
        if (file_exists($current_desc_file)) {
            $string = file_get_contents($current_desc_file);
            $json_a = json_decode($string, true);
            return $json_a;
        } else {
            return FALSE;
        }
    }

    function saveDescription($desc_array)
    {
        $current_desc_file = $this->baseDir . "/" . $this->fileName;
        $fp = fopen($current_desc_file, 'w');
        fwrite($fp, json_encode($desc_array));
        fclose($fp);
    }
}