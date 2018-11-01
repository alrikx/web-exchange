<?php

class FileService
{

    var $internal;

    var $external;

    public function __construct()
    {
        $this->external = $_SERVER["SERVER_NAME"];
        $this->internal = '/share';
    }

    function translateToExternalURL($internal_url)
    {
        return $this->external . substr($internal_url, strlen($this->internal));
    }
}

