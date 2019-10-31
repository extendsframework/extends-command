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
     * @covers \ExtendsFramework\Command\Handler\AbstractCommandHandler::getCommandMessage()
     */
    public function testDispatch(): void
    {
        $payload = $this->createMock(PayloadInterface::class);

        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $payloadType
            ->method('getName')
            ->willReturn('PayloadStub');

        $message = $this->createMock(CommandMessageInterface::class);
        $message
            ->method('getPayload')
            ->willReturn($payload);

        $message
            ->method('getPayloadType')
            ->willReturn($payloadType);

        /**
         * @var CommandMessageInterface $message
         */
        $handler = new HandlerStub();
        $handler->handle($message);

        $this->assertSame($payload, $handler->getPayload());
        $this->assertSame($message, $handler->getCommandMessage());
    }
}
