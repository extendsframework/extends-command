<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Framework\ServiceLocator\Factory;

use ExtendsFramework\Command\Dispatcher\CommandDispatcherInterface;
use ExtendsFramework\Command\Handler\CommandHandlerInterface;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use PHPUnit\Framework\TestCase;

class CommandDispatcherFactoryTest extends TestCase
{
    /**
     * Create service.
     *
     * Test that command dispatcher will be created from config.
     *
     * @covers \ExtendsFramework\Command\Framework\ServiceLocator\Factory\CommandDispatcherFactory::createService()
     */
    public function testCreateService(): void
    {
        $handler = $this->createMock(CommandHandlerInterface::class);

        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);
        $serviceLocator
            ->method('getConfig')
            ->willReturn([
                CommandDispatcherInterface::class => [
                    'FooHandler' => [
                        'FooCommand',
                        'QuxCommand',
                    ],
                    'BarHandler' => 'BarCommand',
                ],
            ]);

        $serviceLocator
            ->method('getService')
            ->withConsecutive(
                ['FooHandler'],
                ['BarHandler']
            )
            ->willReturn($handler);

        $factory = new CommandDispatcherFactory();
        $dispatcher = $factory->createService(CommandDispatcherInterface::class, $serviceLocator);

        $this->assertInstanceOf(CommandDispatcherInterface::class, $dispatcher);
    }
}
