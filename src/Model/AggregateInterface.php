<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Model;

use ExtendsFramework\Command\CommandMessageInterface;

interface AggregateInterface
{
    /**
     * Handle command message.
     *
     * @param CommandMessageInterface $commandMessage
     * @return void
     */
    public function handle(CommandMessageInterface $commandMessage): void;

    /**
     * Get identifier.
     *
     * @return string
     */
    public function getIdentifier(): string;

    /**
     * Get version.
     *
     * @return int
     */
    public function getVersion(): int;
}
