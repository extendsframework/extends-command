<?php
declare(strict_types=1);

namespace ExtendsFramework\Command;

use ExtendsFramework\Message\MessageInterface;

interface CommandMessageInterface extends MessageInterface
{
    /**
     * Get aggregate id.
     *
     * @return string
     */
    public function getAggregateId(): string;
}
