<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Handler;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Message\Payload\Type\PayloadTypeInterface;
use PHPUnit\Framework\TestCase;

class AbstractCommandHandlerTest extends TestCase
{
    /**
     * Dispatch.
     *
     * Test that command message will be handler by the correct method.
     *
     * @covers \ExtendsFramework\Command\Handler\AbstractCommandHandler::handle()
     * @covers \ExtendsFramework\Command\Handler\AbstractCommandHandler::getMethod()
     * @covers \ExtendsFramework\Command\Handler\AbstractCommandHandler::getPrefix()
     * @covers \ExtendsFramework\Command\Handler\AbstractCommandHandler::getMetaData()
     * @covers \ExtendsFramework\Command\Handler\AbstractCommandHandler::getAggregateId()
     */
    public function testDispatch(): void
    {
        $payload = $this->createMock(PayloadInterface::class);

        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $payloadType
            ->method('getName')
            ->willReturn('PayloadStub');

        $commandMessage = $this->createMock(CommandMessageInterface::class);
        $commandMessage
            ->method('getPayload')
            ->willReturn($payload);

        $commandMessage
            ->method('getPayloadType')
            ->willReturn($payloadType);

        $commandMessage
            ->method('getMetaData')
            ->willReturn(['foo' => 'bar']);

        $commandMessage
            ->method('getAggregateId')
            ->willReturn('foo');

        /**
         * @var CommandMessageInterface $commandMessage
         */
        $listener = new HandlerStub();
        $listener->handle($commandMessage);

        $this->assertSame($payload, $listener->getPayload());
        $this->assertSame('foo', $listener->getAggregateId());
        $this->assertSame(['foo' => 'bar'], $listener->getMetaData());
    }

    /**
     * Method not found.
     *
     * Test that command handler can not be found and an exception will be thrown.
     *
     * @covers                   \ExtendsFramework\Command\Handler\AbstractCommandHandler::handle()
     * @covers                   \ExtendsFramework\Command\Handler\AbstractCommandHandler::getMethod()
     * @covers                   \ExtendsFramework\Command\Handler\Exception\MethodNotFound::__construct()
     * @expectedException        \ExtendsFramework\Command\Handler\Exception\MethodNotFound
     * @expectedExceptionMessage No command handler method found for payload name "PayloadFoo".
     */
    public function testMethodNotFound(): void
    {
        $payload = $this->createMock(PayloadInterface::class);

        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $payloadType
            ->method('getName')
            ->willReturn('PayloadFoo');

        $commandMessage = $this->createMock(CommandMessageInterface::class);
        $commandMessage
            ->method('getPayload')
            ->willReturn($payload);

        $commandMessage
            ->method('getPayloadType')
            ->willReturn($payloadType);

        $commandMessage
            ->method('getMetaData')
            ->willReturn(['foo' => 'bar']);

        $commandMessage
            ->method('getAggregateId')
            ->willReturn('foo');

        /**
         * @var CommandMessageInterface $commandMessage
         */
        $listener = new HandlerStub();
        $listener->handle($commandMessage);
    }
}

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
     * @return array
     */
    public function getMetaData(): array
    {
        return parent::getMetaData();
    }

    /**
     * @return string
     */
    public function getAggregateId(): string
    {
        return parent::getAggregateId();
    }

    /**
     * @return PayloadInterface
     */
    public function getPayload(): PayloadInterface
    {
        return $this->payload;
    }
}
