<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Model;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Command\Handler\AbstractCommandHandler;
use ExtendsFramework\Message\Payload\PayloadMethodTrait;

abstract class AbstractAggregate extends AbstractCommandHandler implements AggregateInterface
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
}
