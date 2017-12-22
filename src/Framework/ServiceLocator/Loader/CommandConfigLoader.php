<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Framework\ServiceLocator\Loader;

use ExtendsFramework\Command\Dispatcher\CommandDispatcherInterface;
use ExtendsFramework\Command\Framework\ServiceLocator\Factory\CommandDispatcherFactory;
use ExtendsFramework\ServiceLocator\Config\Loader\LoaderInterface;
use ExtendsFramework\ServiceLocator\Resolver\Factory\FactoryResolver;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;

class CommandConfigLoader implements LoaderInterface
{
    /**
     * @inheritDoc
     */
    public function load(): array
    {
        return [
            ServiceLocatorInterface::class => [
                FactoryResolver::class => [
                    CommandDispatcherInterface::class => CommandDispatcherFactory::class,
                ],
            ],
            CommandDispatcherInterface::class => [],
        ];
    }
}
