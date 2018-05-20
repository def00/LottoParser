<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 19.05.2018
 * Time: 22:36
 */

namespace def\Crawler;

use def\Collectors\GameCollector;
use \Symfony\Component\DomCrawler\Crawler as SymfonyCrawler;
use def\Sites\Site;
use def\Model\GameFactory;

class Parser extends SymfonyCrawler
{
    public function parse(Site $site, GameFactory $gameFactory, GameCollector $collector) {
        $this->filter($site->getDrawSelector())
            ->each(function($draw) use ($gameFactory, $site, $collector) {
                $collector->addGame($site->getResult($gameFactory->create(), $draw));
            });
    }
}