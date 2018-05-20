<?php

/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 19.05.2018
 * Time: 14:37
 */
namespace def\Sites;

use def\Model\Game;

class Euromillions implements Site
{
    const URL = 'https://www.elgordo.com/results/euromillonariaen.asp';
    const NAME = 'Euromillions';

    public function getAddress(): string
    {
        return self::URL;
    }

    public function getDrawSelector(): string
    {
        return '.body_game:not(.hide-element)';
    }

    protected function formatDate(string $date): \DateTime
    {
        $date = preg_replace('/[^\da-z]/i', ' ', $date);
        return new \DateTime($date);
    }

    public function getResult(Game $result, $node): Game
    {
        $result->setName(self::NAME);
        $date = $this->formatDate($node->filter('.body_game > .c')->text());
        $result->setDate($date);
        $node->filter('span.int-num')
            ->each(function($num) use ($result) {
                $result->addToResult($num->text());
            });

        return $result;
    }
}