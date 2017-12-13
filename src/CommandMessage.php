<?php
declare(strict_types=1);

namespace ExtendsFramework\Command;

use ExtendsFramework\Message\Message;
use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Message\Payload\Type\PayloadTypeInterface;

class CommandMessage extends Message implements CommandMessageInterface
{
    /**
     * Aggregate id.
     *
     * @var string
     */
    protected $aggregateId;

    /**
     * CommandMessage constructor.
     *
     * @param PayloadInterface     $payload
     * @param PayloadTypeInterface $payloadType
     * @param string               $aggregateId
     * @param array                $metaData
     */
    public function __construct(PayloadInterface $payload, PayloadTypeInterface $payloadType, string $aggregateId, array $metaData)
    {
        parent::__construct($payload, $payloadType, $metaData);

        $this->aggregateId = $aggregateId;
    }

    /**
     * @inheritDoc
     */
    public function getAggregateId(): string
    {
        return $this->aggregateId;
    }
}
