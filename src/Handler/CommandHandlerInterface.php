<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Handler;

use ExtendsFramework\Command\CommandMessageInterface;

interface CommandHandlerInterface
{
    /**
     * Handle command message.
     *
     * @param CommandMessageInterface $commandMessage
     * @return void
     */
    public function handle(CommandMessageInterface $commandMessage): void;
}
