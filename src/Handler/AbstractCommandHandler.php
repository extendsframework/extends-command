<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Handler;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Message\Payload\PayloadMethodTrait;

abstract class AbstractCommandHandler implements CommandHandlerInterface
{
    use PayloadMethodTrait;

    /**
     * Method prefix.
     *
     * @var string
     */
    protected $prefix = 'handle';

    /**
     * Aggregate id.
     *
     * @var string
     */
    protected $aggregateId;

    /**
     * Meta data.
     *
     * @var array
     */
    protected $metaData;

    /**
     * @inheritDoc
     */
    public function handle(CommandMessageInterface $commandMessage): void
    {
        $this->aggregateId = $commandMessage->getAggregateId();
        $this->metaData = $commandMessage->getMetaData();

        $this->getMethod($commandMessage)($commandMessage->getPayload());
    }

    /**
     * Get aggregate id.
     *
     * @return string
     */
    protected function getAggregateId(): string
    {
        return $this->aggregateId;
    }

    /**
     * Get meta data.
     *
     * @return array
     */
    protected function getMetaData(): array
    {
        return $this->metaData;
    }
}
