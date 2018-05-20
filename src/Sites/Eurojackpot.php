<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 20.05.2018
 * Time: 12:07
 */

namespace def\Sites;
use def\Model\Game;

class Eurojackpot extends Lotto implements Site
{
    const URL = 'http://www.lotto.pl/eurojackpot/wyniki-i-wygrane';
    const NAME = 'Eurojackpot';

    public function getAddress(): string
    {
        return self::URL;
    }

    final public function getResult(Game $result, $node): Game
    {
        $result->setName(self::NAME);
        $date = $node->filter('td')->eq(1)->text();
        $result->setDate($this->formatDate($date));
        $node->filter('td .sortrosnaco .text-center')
            ->each(function($num) use ($result) {
                if ($num->text() == '+') {
                    return;
                }
                $result->addToResult($num->text());
            });

        return $result;
    }

}