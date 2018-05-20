<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 20.05.2018
 * Time: 15:40
 */

namespace def\Model;


class PageFactory
{
    public function create(): Page
    {
        return new Page();
    }
}