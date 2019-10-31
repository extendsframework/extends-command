<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Dispatcher;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Command\Dispatcher\Exception\CommandHandlerNotFound;
use ExtendsFramework\Command\Handler\CommandHandlerInterface;
use ExtendsFramework\Message\Payload\Type\PayloadTypeInterface;
use PHPUnit\Framework\TestCase;

class CommandDispatcherTest extends TestCase
{
    /**
     * Dispatch.
     *
     * Test that command message will be dispatched to correct command handler.
     *
     * @covers \ExtendsFramework\Command\Dispatcher\CommandDispatcher::addCommandHandler()
     * @covers \ExtendsFramework\Command\Dispatcher\CommandDispatcher::dispatch()
     */
    public function testDispatch(): void
    {
        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $payloadType
            ->method('getName')
            ->willReturn('PayloadBar');

        $message = $this->createMock(CommandMessageInterface::class);
        $message
            ->method('getPayloadType')
            ->willReturn($payloadType);

        $handler = $this->createMock(CommandHandlerInterface::class);
        $handler
            ->expects($this->once())
            ->method('handle')
            ->with($message);

        $dispatcher = new CommandDispatcher();
        $dispatcher
            ->addCommandHandler($handler, 'PayloadFoo')
            ->addCommandHandler($handler, 'PayloadBar')
            ->dispatch($message);
    }

    /**
     * Command handler not found.
     *
     * Test that and exception will be thrown when there is no command handler for the command message.
     *
     * @covers \ExtendsFramework\Command\Dispatcher\CommandDispatcher::addCommandHandler()
     * @covers \ExtendsFramework\Command\Dispatcher\CommandDispatcher::dispatch()
     * @covers \ExtendsFramework\Command\Dispatcher\Exception\CommandHandlerNotFound::__construct()
     */
    public function testCommandHandlerNotFound(): void
    {
        $this->expectException(CommandHandlerNotFound::class);
        $this->expectExceptionMessage('No command handler found for command message payload name "PayloadBar".');

        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $payloadType
            ->method('getName')
            ->willReturn('PayloadBar');

        $message = $this->createMock(CommandMessageInterface::class);
        $message
            ->method('getPayloadType')
            ->willReturn($payloadType);

        $handler = $this->createMock(CommandHandlerInterface::class);
        $handler
            ->expects($this->never())
            ->method('handle');

        $dispatcher = new CommandDispatcher();
        $dispatcher
            ->addCommandHandler($handler, 'PayloadFoo')
            ->dispatch($message);
    }
}
