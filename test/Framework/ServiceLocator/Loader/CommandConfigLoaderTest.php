<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Framework\ServiceLocator\Loader;

use ExtendsFramework\Command\Dispatcher\CommandDispatcherInterface;
use ExtendsFramework\Command\Framework\ServiceLocator\Factory\CommandDispatcherFactory;
use ExtendsFramework\ServiceLocator\Resolver\Factory\FactoryResolver;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use PHPUnit\Framework\TestCase;

class CommandConfigLoaderTest extends TestCase
{
    /**
     * Load.
     *
     * Test that correct config will be loaded.
     *
     * @covers \ExtendsFramework\Command\Framework\ServiceLocator\Loader\CommandConfigLoader::load()
     */
    public function testLoad(): void
    {
        $loader = new CommandConfigLoader();

        $this->assertSame([
            ServiceLocatorInterface::class => [
                FactoryResolver::class => [
                    CommandDispatcherInterface::class => CommandDispatcherFactory::class,
                ],
            ],
            CommandDispatcherInterface::class => [],
        ], $loader->load());
    }
}
