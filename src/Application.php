<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 19.05.2018
 * Time: 13:53
 */

namespace def;

class Application
{
    protected $loop;
    protected $crawler;
    protected $siteFactory;
    protected $parserFactory;
    protected $gameFactory;
    protected $collector;
    protected $done;
    protected $writeStream;

    public function __construct(ApplicationFactory $factory)
    {
        $this->loop = $factory->getLoop();
        $this->crawler = $factory->getCrawler();
        $this->siteFactory = $factory->getSiteFactory();
        $this->parserFactory = $factory->getParserFactory();
        $this->gameFactory = $factory->getGameFactory();
        $this->collector = $factory->getGameCollector();
    }

    public function run()
    {
        try {
            $done = $this->done;

            $this->collector->withGame(function($game) use ($done) {
                $done($game);
            });

            foreach ($this->siteFactory->createAll() as $site) {
                $this->crawler->crawl($site, $this->parserFactory, $this->gameFactory, $this->collector);
            }

            $this->loop->run();


        } catch (\Exception $resultError) {
            echo "There was an error, try again\n";
        }
    }

    public function onDone(callable $func)
    {
        $this->done = $func;
    }

}