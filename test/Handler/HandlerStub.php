<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Handler;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Message\Payload\PayloadInterface;

class HandlerStub extends AbstractCommandHandler
{
    /**
     * @var PayloadInterface
     */
    protected $payload;

    /**
     * @param PayloadInterface $payload
     */
    public function handlePayloadStub(PayloadInterface $payload): void
    {
        $this->payload = $payload;
    }

    /**
     * @inheritDoc
     */
    public function getCommandMessage(): CommandMessageInterface
    {
        return parent::getCommandMessage();
    }

    /**
     * @return PayloadInterface
     */
    public function getPayload(): PayloadInterface
    {
        return $this->payload;
    }
}
