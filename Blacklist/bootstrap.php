<?php

require __DIR__ . '/../vendor/latte/latte/src/latte.php';
require __DIR__ . '/../Libs/autoload.php';
require __DIR__ . '/../Config/languages/czech/loader.php';

$configurator = new Nette\Configurator;

$configurator->setDebugMode(TRUE);  // debug mode MUST NOT be enabled on production server
$configurator->enableDebugger(__DIR__ . '/../Log');

$configurator->setTempDirectory(__DIR__ . '/../Temp');

$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->addDirectory(__DIR__ . '/../Libs/others')
	->register();

$configurator->addConfig(__DIR__ . '/../Config/config.neon');
$configurator->addConfig(__DIR__ . '/../Config/config.local.neon');

$container = $configurator->createContainer();
$container->application->errorPresenter = 'Front:Error';
$container->application->catchExceptions = \Nette\Environment::isProduction();

return $container;
