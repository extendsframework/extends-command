<?php
declare(strict_types=1);

namespace ExtendsFramework\Command;

use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Message\Payload\Type\PayloadTypeInterface;
use PHPUnit\Framework\TestCase;

class CommandMessageTest extends TestCase
{
    /**
     * Get aggregate id.
     *
     * Test that correct aggregate id will be returned.
     *
     * @covers \ExtendsFramework\Command\CommandMessage::__construct()
     * @covers \ExtendsFramework\Command\CommandMessage::getAggregateId()
     */
    public function testGetAggregateId(): void
    {
        $payload = $this->createMock(PayloadInterface::class);
        $payloadType = $this->createMock(PayloadTypeInterface::class);

        /**
         * @var PayloadInterface     $payload
         * @var PayloadTypeInterface $payloadType
         */
        $message = new CommandMessage($payload, $payloadType, 'id', ['foo' => 'bar']);

        $this->assertSame('id', $message->getAggregateId());
    }
}
