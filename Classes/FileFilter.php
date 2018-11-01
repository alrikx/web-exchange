<?php

class FileFilter
{

    var $erlaubtebilddateiendungen;

    var $erlaubtevideodateiendungen;

    function FileFilter()
    {
        $this->erlaubtebilddateiendungen = array(
            "jpg",
            "jpeg",
            "bmp",
            "png",
            "gif"
        );
        $this->erlaubtevideodateiendungen = array(
            "mp4",
            "mov"
        );
    }

    public function getFilteredFileListofDirectory($directory)
    {
        $anzuzeigendedateien = array();
        $all_files = scandir($directory); // Ordner "files"auslesen
        foreach ($all_files as $single_file) { // Ausgabeschleife
            $info = pathinfo($single_file); // Infos holen
            if (isset($info['extension'])) {
                $dateiendung = strtolower($info['extension']);
            } else {
                $dateiendung = '';
            }
            if (in_array($dateiendung, $this->erlaubtebilddateiendungen)) {
                $typ[$single_file] = 'pic';
                array_push($anzuzeigendedateien, $single_file);
            } elseif (in_array($dateiendung, $this->erlaubtevideodateiendungen)) {
                $typ[$single_file] = 'vid';
                array_push($anzuzeigendedateien, $single_file);
            }
        }
        return array(
            $anzuzeigendedateien,
            $typ
        );
    }
}


