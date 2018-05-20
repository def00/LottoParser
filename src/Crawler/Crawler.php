<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 19.05.2018
 * Time: 20:54
 */

namespace def\Crawler;

use def\Collectors\GameCollector;
use def\Model\GameFactory;
use def\Sites\Site;
use React\HttpClient\Client;

class Crawler
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function crawl(Site $site, ParserFactory $parserFactory, GameFactory $gameFactory, GameCollector $collector)
    {
        $request = $this->client->request('GET', $site->getAddress());

        $request->on('response', function($response) use ($site, $parserFactory, $gameFactory, $collector) {
            $response->on('data', function($html) use ($site, $parserFactory, $gameFactory, $collector) {
                $parserFactory->create($html)->parse($site, $gameFactory, $collector);
            });

        });

        $request->on('error', function(\Exception $exception) {
            echo "There was as error parsing site\n";
        });

        $request->end();
    }

}