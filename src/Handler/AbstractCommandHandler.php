<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Handler;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Command\Handler\Exception\MethodNotFound;
use ReflectionMethod;

abstract class AbstractCommandHandler implements CommandHandlerInterface
{
    /**
     * Method prefix.
     *
     * @var string
     */
    protected $prefix = 'handle';

    /**
     * Aggregate id.
     *
     * @var string
     */
    protected $aggregateId;

    /**
     * Meta data.
     *
     * @var array
     */
    protected $metaData;

    /**
     * @inheritDoc
     */
    public function handle(CommandMessageInterface $commandMessage): void
    {
        $this->aggregateId = $commandMessage->getAggregateId();
        $this->metaData = $commandMessage->getMetaData();

        $method = $this->getMethod($commandMessage);

        $method->invokeArgs($this, [$commandMessage->getPayload()]);
    }

    /**
     * Get reflection method for event message payload.
     *
     * Method name is based on the method prefix combined with payload name.
     *
     * @param CommandMessageInterface $commandMessage
     * @return ReflectionMethod
     * @throws CommandHandlerException
     */
    protected function getMethod(CommandMessageInterface $commandMessage): ReflectionMethod
    {
        $method = $this->getPrefix() . $commandMessage
                ->getPayloadType()
                ->getName();

        if (method_exists($this, $method) === false) {
            throw new MethodNotFound($commandMessage);
        }

        return new ReflectionMethod($this, $method);
    }

    /**
     * Get method prefix.
     *
     * @return string
     */
    protected function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * Get aggregate id.
     *
     * @return string
     */
    protected function getAggregateId(): string
    {
        return $this->aggregateId;
    }

    /**
     * Get meta data.
     *
     * @return array
     */
    protected function getMetaData(): array
    {
        return $this->metaData;
    }
}
