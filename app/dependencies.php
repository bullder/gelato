<?php
declare(strict_types=1);

use App\Infrastructure\Service\CheckoutBuilder;
use App\Infrastructure\Service\CheckoutBuilderInterface;
use App\Infrastructure\Service\ShoppingCartProcessor;
use App\Infrastructure\Service\ShoppingCartProcessorInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
    ]);

    $containerBuilder->addDefinitions([
        ShoppingCartProcessorInterface::class => autowire(ShoppingCartProcessor::class),
        CheckoutBuilderInterface::class => autowire(CheckoutBuilder::class),
    ]);
};
