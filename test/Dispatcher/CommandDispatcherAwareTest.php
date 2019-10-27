<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Dispatcher;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Message\Payload\PayloadInterface;
use PHPUnit\Framework\TestCase;

class CommandDispatcherAwareTest extends TestCase
{
    /**
     * Dispatch.
     *
     * Test that dispatch method will proxy to the command dispatcher.
     *
     * @covers \ExtendsFramework\Command\Dispatcher\CommandDispatcherAware::dispatch()
     * @covers \ExtendsFramework\Command\Dispatcher\CommandDispatcherAware::getCommandDispatcher()
     */
    public function testDispatch(): void
    {
        $commandDispatcher = $this->createMock(CommandDispatcherInterface::class);
        $commandDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with($this->isInstanceOf(CommandMessageInterface::class));

        $payload = $this->createMock(PayloadInterface::class);

        /**
         * @var CommandDispatcherInterface $commandDispatcher
         * @var PayloadInterface           $payload
         */
        $stub = new CommandDispatcherAwareStub($commandDispatcher);
        $stub->execute('foo', $payload, ['foo' => 'bar']);
    }
}
