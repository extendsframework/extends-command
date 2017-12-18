<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Handler;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Message\Payload\PayloadMethodTrait;

abstract class AbstractCommandHandler implements CommandHandlerInterface
{
    use PayloadMethodTrait;

    /**
     * Command message.
     *
     * @var CommandMessageInterface
     */
    protected $commandMessage;

    /**
     * @inheritDoc
     */
    public function handle(CommandMessageInterface $commandMessage): void
    {
        $this->commandMessage = $commandMessage;

        $this->getMethod($commandMessage, 'handle')($commandMessage->getPayload());
    }

    /**
     * Get command message.
     *
     * @return CommandMessageInterface
     */
    public function getCommandMessage(): CommandMessageInterface
    {
        return $this->commandMessage;
    }
}
