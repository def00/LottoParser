<?php

/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 20.05.2018
 * Time: 11:54
 */
namespace def\Collectors;

use def\Model\Game;

class GameCollector
{
    protected $games = [];

    public function addGame(Game $game)
    {
        $this->games[] = $game;
    }

    public function getGames(): array
    {
        return $this->games;
    }

    public function withGame(callable $func)
    {
        foreach ($this->games as $game) {
            $func($game);
        }
    }
}