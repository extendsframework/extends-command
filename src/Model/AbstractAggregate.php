<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Model;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Message\Payload\PayloadMethodTrait;

abstract class AbstractAggregate implements AggregateInterface
{
    use PayloadMethodTrait;

    /**
     * Method prefix;
     *
     * @var string
     */
    protected $prefix = 'handle';

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
     * Command message meta data.
     *
     * @var array
     */
    protected $metaData;

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
        $this->metaData = $commandMessage->getMetaData();

        $this->getMethod($commandMessage)($commandMessage->getPayload());
    }

    /**
     * Get command message meta data.
     *
     * @return array
     */
    protected function getMetaData(): array
    {
        return $this->metaData;
    }
}
