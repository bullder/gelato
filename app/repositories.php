<?php
declare(strict_types=1);

use App\Domain\DiscountRepository;
use App\Domain\SkuRepository;
use App\Infrastructure\Persistence\InMemoryDiscountRepository;
use App\Infrastructure\Persistence\InMemorySkuRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return static function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        DiscountRepository::class => autowire(InMemoryDiscountRepository::class),
        SkuRepository::class => autowire(InMemorySkuRepository::class),
    ]);
};
