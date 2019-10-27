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
    private function getCommandHandler(CommandMessageInterface $commandMessage): CommandHandlerInterface
    {
        $name = $commandMessage
            ->getPayloadType()
            ->getName();
        $commandHandlers = $this->getCommandHandlers();
        if (!array_key_exists($name, $commandHandlers)) {
            throw new CommandHandlerNotFound($commandMessage);
        }

        return $commandHandlers[$name];
    }

    /**
     * Get command handlers.
     *
     * @return CommandHandlerInterface[]
     */
    private function getCommandHandlers(): array
    {
        return $this->commandHandlers;
    }
}
