<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Model;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Message\Payload\Type\PayloadTypeInterface;
use PHPUnit\Framework\TestCase;

class AbstractAggregateTest extends TestCase
{
    /**
     * Get methods.
     *
     * Test that get methods will return correct values.
     *
     * @covers \ExtendsFramework\Command\Model\AbstractAggregate::__construct()
     * @covers \ExtendsFramework\Command\Model\AbstractAggregate::getIdentifier()
     * @covers \ExtendsFramework\Command\Model\AbstractAggregate::getVersion()
     */
    public function testGetMethods(): void
    {
        $aggregate = new AggregateStub('foo', 33);

        $this->assertSame('foo', $aggregate->getIdentifier());
        $this->assertSame(33, $aggregate->getVersion());
    }

    /**
     * Handle.
     *
     * Test that correct method will be called.
     *
     * @covers \ExtendsFramework\Command\Model\AbstractAggregate::__construct()
     */
    public function testHandle(): void
    {
        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $payloadType
            ->method('getName')
            ->willReturn('FooBar');

        $payload = $this->createMock(PayloadInterface::class);

        $message = $this->createMock(CommandMessageInterface::class);
        $message
            ->method('getPayload')
            ->willReturn($payload);

        $message
            ->method('getPayloadType')
            ->willReturn($payloadType);

        $message
            ->method('getMetaData')
            ->willReturn(['foo' => 'bar']);

        /**
         * @var CommandMessageInterface $message
         */
        $aggregate = new AggregateStub('foo', 33);
        $aggregate->handle($message);

        $this->assertSame($payload, $aggregate->getPayload());
        $this->assertSame($message, $aggregate->getCommandMessage());
    }
}

class AggregateStub extends AbstractAggregate
{
    /**
     * @var PayloadInterface
     */
    protected $payload;

    /**
     * @return PayloadInterface
     */
    public function getPayload(): PayloadInterface
    {
        return $this->payload;
    }

    /**
     * @return CommandMessageInterface
     */
    public function getCommandMessage(): CommandMessageInterface
    {
        return parent::getCommandMessage();
    }

    /**
     * @param PayloadInterface $payload
     */
    protected function handleFooBar(PayloadInterface $payload): void
    {
        $this->payload = $payload;
    }
}
