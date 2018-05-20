<?php

/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 19.05.2018
 * Time: 14:37
 */
namespace def\Sites;
use def\Crawler\Parser;
use def\Model\Game;

class Lotto implements Site
{
    const URL = 'http://www.lotto.pl/lotto/wyniki-i-wygrane';

    public function getAddress(): string
    {
        return self::URL;
    }

    protected function formatDate(string $date): \DateTime
    {
        if (preg_match("/\d{2}-\d{2}-\d{2}/", $date, $match)) {
            $date = \DateTime::createFromFormat('d-m-y', $match[0]);
            $date->setTime(0, 0,0);
            return $date;
        }

        throw new \InvalidArgumentException('Wrong date format');
    }

    public function getResult(Game $result, $node): Game
    {
        $result->setName($node->filter('img')->first()->attr('alt'));

        $date = $node->filter('td')->eq(2)->text();

        $result->setDate($this->formatDate($date));

        $node->filter('td .resultsItem .number')
            ->each(function($num) use ($result) {
                $result->addToResult($num->text());
            });

        return $result;
    }


    public function getDrawSelector(): string
    {
        return '.ostatnie-wyniki-table tr.wynik';
    }
}