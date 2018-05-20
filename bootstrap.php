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
    $json = new \def\Database\SaveToJSON($cli['save']);

    $app->onDone(function($game) use ($data, $json) {
        $json->saveResult($game);
    });
}

if ($cli['database']) {
    $db = new def\Database\SaveToDb($cli['database']);
    $db->createResultTable();

    $app->onDone(function($game) use ($data, $cli, $db) {
        $db->saveResult($game);

    });
    echo sprintf("Saved to database %s\n", $cli['database']);
}


$app->run();