<?php

/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 20.05.2018
 * Time: 13:24
 */
namespace def\Database;
use PDO;
use def\Model\Game;
class SaveToDb
{
    protected $db;

    public function __construct(string $fileName)
    {
        $this->db = new PDO('sqlite:'.$fileName);
    }

    public function createResultTable()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS results (
                        id   INTEGER PRIMARY KEY,
                        game_name VARCHAR(100) NOT NULL,
                        result VARCHAR(40) NOT NULL,
                        result_date DATE NOT NULL
                      )';
        $this->db->query($sql);
    }

    public function saveResult(Game $game)
    {
        $stm = $this->db->prepare('INSERT INTO results (game_name, result, result_date) VALUES(?, ?, ?)');
        $stm->execute([
            $game->getName(),
            $game->getResult(),
            $game->getDate()->format('Y-m-d')
        ]);
    }

}