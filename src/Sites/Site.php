<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 19.05.2018
 * Time: 20:56
 */

namespace def\Sites;

use def\Model\Game;

interface Site
{
    public function getAddress(): string;
    public function getResult(Game $result, $node): Game;
    public function getDrawSelector(): string;
}