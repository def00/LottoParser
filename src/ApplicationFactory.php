<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 20.05.2018
 * Time: 10:46
 */

namespace def;


use def\Collectors\GameCollector;
use def\Crawler\Crawler;
use def\Crawler\ParserFactory;
use def\Model\GameFactory;
use def\Model\PageFactory;
use def\Sites\SiteFactory;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use React\HttpClient\Client;

class ApplicationFactory
{
    protected $loop;
    protected $crawler;
    protected $siteFactory;
    protected $parserFactory;
    protected $gameFactory;
    protected $gameCollector;
    protected $pageFactory;

    public function getLoop(): LoopInterface
    {
        if (! $this->loop) {
            $this->loop = Factory::create();
        }

        return $this->loop;
    }

    public function getCrawler(): Crawler
    {
        if (! $this->crawler) {
            $this->crawler = new Crawler(new Client($this->getLoop()));
        }

        return $this->crawler;
    }

    public function getSiteFactory(): SiteFactory
    {
        if (! $this->siteFactory) {
            $this->siteFactory = new SiteFactory();
        }

        return $this->siteFactory;
    }

    public function getParserFactory(): ParserFactory
    {
        if (! $this->parserFactory) {
            $this->parserFactory = new ParserFactory();
        }

        return $this->parserFactory;
    }

    public function getGameFactory(): GameFactory
    {
        if (! $this->gameFactory) {
            $this->gameFactory = new GameFactory();
        }

        return $this->gameFactory;
    }

    public function getGameCollector(): GameCollector
    {
        if (! $this->gameCollector) {
            $this->gameCollector = new GameCollector();
        }

        return $this->gameCollector;
    }

    public function getPageFactory(): PageFactory
    {
        if (! $this->pageFactory) {
            $this->pageFactory = new PageFactory();
        }

        return $this->pageFactory;
    }
}