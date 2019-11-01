<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Dispatcher;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Command\Dispatcher\Exception\CommandHandlerNotFound;
use ExtendsFramework\Command\Handler\CommandHandlerInterface;

class CommandDispatcher implements CommandDispatcherInterface
{
    /**
     * Command handlers per payload name.
     *
     * @var CommandHandlerInterface[]
     */
    private $commandHandlers = [];

    /**
     * @inheritDoc
     */
    public function dispatch(CommandMessageInterface $commandMessage): void
    {
        $name = $commandMessage
            ->getPayloadType()
            ->getName();
        if (!isset($this->commandHandlers[$name])) {
            throw new CommandHandlerNotFound($commandMessage);
        }

        $this->commandHandlers[$name]->handle($commandMessage);
    }

    /**
     * Add command handler for payload name.
     *
     * @param CommandHandlerInterface $commandHandler
     * @param string                  $payloadName
     * @return CommandDispatcher
     */
    public function addCommandHandler(CommandHandlerInterface $commandHandler, string $payloadName): CommandDispatcher
    {
        $this->commandHandlers[$payloadName] = $commandHandler;

        return $this;
    }
}
