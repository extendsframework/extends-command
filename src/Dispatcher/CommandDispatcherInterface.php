<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Dispatcher;

use ExtendsFramework\Command\CommandMessageInterface;

interface CommandDispatcherInterface
{
    /**
     * Dispatch command message to handler.
     *
     * Command message can only be dispatched to one handler. An exception will be thrown when a handler for the
     * command message can not be found.
     *
     * @param CommandMessageInterface $commandMessage
     * @throws CommandDispatcherException
     */
    public function dispatch(CommandMessageInterface $commandMessage): void;
}
