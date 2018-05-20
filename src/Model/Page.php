<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 20.05.2018
 * Time: 15:38
 */

namespace def\Model;


class Page
{
    protected $html;

    public function addChunk($data)
    {
        $this->html .= $data;
    }

    public function getHtml(): string
    {
        return $this->html;
    }

}