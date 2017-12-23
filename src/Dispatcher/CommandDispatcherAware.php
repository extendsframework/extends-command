<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Dispatcher;

use ExtendsFramework\Command\CommandMessage;
use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Message\Payload\Type\PayloadType;

trait CommandDispatcherAware
{
    /**
     * Command dispatcher.
     *
     * @var CommandDispatcherInterface
     */
    protected $commandDispatcher;

    /**
     * Dispatch new command message.
     *
     * @param string           $aggregateId
     * @param PayloadInterface $payload
     * @param array|null       $metaData
     * @throws CommandDispatcherException
     */
    protected function dispatch(string $aggregateId, PayloadInterface $payload, array $metaData = null): void
    {
        $this
            ->getCommandDispatcher()
            ->dispatch(
                new CommandMessage(
                    $payload,
                    new PayloadType($payload),
                    $aggregateId,
                    $metaData
                )
            );
    }

    /**
     * Get command dispatcher.
     *
     * @return CommandDispatcherInterface
     */
    protected function getCommandDispatcher(): CommandDispatcherInterface
    {
        return $this->commandDispatcher;
    }
}
