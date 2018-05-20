<?php
require __DIR__ . '/vendor/autoload.php';


$cli = new Commando\Command();

$cli->option('s')
    ->aka('save')
    ->describedAs('Save results')
    ->must(function($name) {
        return $name;
    });

$cli->option('d')
    ->aka('database')
    ->describedAs('Save to database')
    ->must(function($name) {
        return $name;
    });


$app = new \def\Application(new \def\ApplicationFactory());


if (! $cli['database']) {
    $data = [];
    $app->onDone(function($collector) use ($data, $cli) {
        foreach ($collector->getGames() as $game) {
            $data[] = $game->toArray();
        }

        if (! $cli['save']) {
            echo json_encode($data, JSON_PRETTY_PRINT) . "\n";
        }

        if ($cli['save']) {
            file_put_contents($cli['save'], json_encode($data));
            echo sprintf("Saved to file in JSON format %s\n", $cli['save']);

        }
    });
}

if ($cli['database']) {
    $app->onDone(function($collector) use ($data, $cli) {
        $db = new def\Database\SaveToDb($cli['database']);
        $db->createResultTable();
        foreach ($collector->getGames() as $game) {
            $db->saveResult($game);
        }

        echo sprintf("Saved to database %s\n", $cli['database']);
    });
}


$app->run();