<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Dispatcher;

use ExtendsFramework\Message\Payload\PayloadInterface;

class CommandDispatcherAwareStub
{
    use CommandDispatcherAware;

    /**
     * CommandDispatcherAwareStub constructor.
     *
     * @param CommandDispatcherInterface $commandDispatcher
     */
    public function __construct(CommandDispatcherInterface $commandDispatcher)
    {
        $this->commandDispatcher = $commandDispatcher;
    }

    /**
     * Execute method.
     *
     * @param string           $aggregateId
     * @param PayloadInterface $payload
     * @param array            $metaData
     * @throws CommandDispatcherException
     */
    public function execute(string $aggregateId, PayloadInterface $payload, array $metaData): void
    {
        $this->dispatch($aggregateId, $payload, $metaData);
    }
}
