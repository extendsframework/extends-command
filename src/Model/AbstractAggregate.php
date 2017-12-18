<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Model;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Message\Payload\PayloadMethodTrait;

abstract class AbstractAggregate implements AggregateInterface
{
    use PayloadMethodTrait;

    /**
     * Unique identifier.
     *
     * @var string
     */
    protected $identifier;

    /**
     * Version.
     *
     * @var int
     */
    protected $version;

    /**
     * Command message.
     *
     * @var CommandMessageInterface
     */
    protected $commandMessage;

    /**
     * AbstractAggregate constructor.
     *
     * @param string $identifier
     * @param int    $version
     */
    public function __construct(string $identifier, int $version)
    {
        $this->identifier = $identifier;
        $this->version = $version;
    }

    /**
     * @inheritDoc
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @inheritDoc
     */
    public function getVersion(): int
    {
        return $this->version;
    }

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
    protected function getCommandMessage(): CommandMessageInterface
    {
        return $this->commandMessage;
    }
}
