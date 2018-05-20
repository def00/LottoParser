<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 20.05.2018
 * Time: 15:21
 */

namespace def\Database;

use def\Model\Game;

class SaveToJSON
{
    protected $data = [];
    protected $saveToFile;

    public function __construct($saveToFile = false)
    {
        $this->saveToFile = $saveToFile;
    }

    public function saveResult(Game $game)
    {
        $this->data[] = $game->toArray();
    }

    public function __destruct()
    {
        if ($this->saveToFile) {
            return file_put_contents($this->saveToFile, json_encode($this->data));
        }

        echo json_encode($this->data, JSON_PRETTY_PRINT);
    }
}