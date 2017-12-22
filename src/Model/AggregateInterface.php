<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Model;

use ExtendsFramework\Command\Handler\CommandHandlerInterface;

interface AggregateInterface extends CommandHandlerInterface
{
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
