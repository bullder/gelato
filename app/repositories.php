<?php
declare(strict_types=1);

use App\Domain\DiscountRepository;
use App\Domain\SkuRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\InMemoryDiscountRepository;
use App\Infrastructure\Persistence\InMemorySkuRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => autowire(InMemoryUserRepository::class),
        DiscountRepository::class => autowire(InMemoryDiscountRepository::class),
        SkuRepository::class => autowire(InMemorySkuRepository::class),
    ]);
};
