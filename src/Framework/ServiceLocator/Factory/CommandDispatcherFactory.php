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
     */
    public function createService(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): CommandDispatcherInterface
    {
        $config = $serviceLocator->getConfig();
        $config = $config[CommandDispatcherInterface::class] ?? [];

        $dispatcher = new CommandDispatcher();
        foreach ($config as $key => $payloadNames) {
            $handler = $this->getCommandHandler($serviceLocator, $key);

            foreach ((array)$payloadNames as $payloadName) {
                $dispatcher->addCommandHandler($handler, $payloadName);
            }
        }

        return $dispatcher;
    }

    /**
     * Get command handler from service locator for key.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param string                  $key
     * @return CommandHandlerInterface
     * @throws ServiceLocatorException
     */
    protected function getCommandHandler(ServiceLocatorInterface $serviceLocator, string $key): CommandHandlerInterface
    {
        return $serviceLocator->getService($key);
    }
}
