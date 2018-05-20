<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 20.05.2018
 * Time: 10:15
 */

namespace def\Crawler;


class ParserFactory
{
    public function create($data)
    {
        return new Parser($data);
    }
}