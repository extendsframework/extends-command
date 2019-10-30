<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Framework\ServiceLocator\Factory;

use ExtendsFramework\Command\Dispatcher\CommandDispatcher;
use ExtendsFramework\Command\Dispatcher\CommandDispatcherInterface;
use ExtendsFramework\Command\Handler\CommandHandlerInterface;
use ExtendsFramework\ServiceLocator\Resolver\Factory\ServiceFactoryInterface;
use ExtendsFramework\ServiceLocator\ServiceLocatorException;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;

class CommandDispatcherFactory implements ServiceFactoryInterface
{
    /**
     * @inheritDoc
     * @throws ServiceLocatorException
     */
    public function createService(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        $config = $serviceLocator->getConfig();
        $config = $config[CommandDispatcherInterface::class] ?? [];

        $dispatcher = new CommandDispatcher();
        foreach ($config as $commandKey => $payloadNames) {
            /** @var CommandHandlerInterface $handler */
            $handler = $serviceLocator->getService($commandKey);

            foreach ((array)$payloadNames as $payloadName) {
                $dispatcher->addCommandHandler($handler, $payloadName);
            }
        }

        return $dispatcher;
    }
}
