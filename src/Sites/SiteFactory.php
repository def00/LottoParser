<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 19.05.2018
 * Time: 14:41
 */

namespace def\Sites;


class SiteFactory
{
    const CRAWLERS = [
        Euromillions::class,
        Lotto::class,
        Eurojackpot::class,
    ];


    public function createAll(): array
    {
        $instances = [];
        foreach (self::CRAWLERS as $crawler) {
            $instances[] = new $crawler;
        }

        return $instances;
    }

}