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
    private $commandDispatcher;

    /**
     * Dispatch new command message.
     *
     * @param string           $aggregateId
     * @param PayloadInterface $payload
     * @param array|null       $metaData
     * @throws CommandDispatcherException
     */
    private function dispatch(string $aggregateId, PayloadInterface $payload, array $metaData = null): void
    {
        $this->commandDispatcher->dispatch(
            new CommandMessage(
                $payload,
                new PayloadType($payload),
                $aggregateId,
                $metaData
            )
        );
    }
}
