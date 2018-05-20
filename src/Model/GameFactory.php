<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 20.05.2018
 * Time: 11:48
 */

namespace def\Model;


class GameFactory
{
    public function create(): Game
    {
        return new Game();
    }
}