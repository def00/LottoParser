<?php

/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 20.05.2018
 * Time: 11:05
 */

namespace def\Model;

class Game
{
    protected $date;
    protected $result = [];
    protected $name;

    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    public function setName($name)
    {
        $this->name = trim($name);
    }

    public function addToResult($num)
    {
        $this->result[] = (int) $num;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'date' => $this->date->format('Y-m-d'),
            'result' => join(' ', $this->result)
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function getResult(): string
    {
        return join(' ', $this->result);
    }
}