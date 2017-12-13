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
    protected $commandHandlers = [];

    /**
     * @inheritDoc
     */
    public function dispatch(CommandMessageInterface $commandMessage): void
    {
        $this
            ->getCommandHandler($commandMessage)
            ->handle($commandMessage);
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

    /**
     * Get command handler for command message.
     *
     * An exception will be thrown when command handler for command message payload name can not be found.
     *
     * @param CommandMessageInterface $commandMessage
     * @return CommandHandlerInterface
     * @throws CommandDispatcherException
     */
    protected function getCommandHandler(CommandMessageInterface $commandMessage): CommandHandlerInterface
    {
        $name = $commandMessage->getPayloadType()->getName();
        if (array_key_exists($name, $this->commandHandlers) === false) {
            throw new CommandHandlerNotFound($commandMessage);
        }

        return $this->commandHandlers[$name];
    }
}