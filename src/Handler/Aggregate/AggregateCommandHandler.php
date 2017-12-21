<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Handler\Aggregate;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Command\Handler\Aggregate\Exception\AggregateClassNameNotFound;
use ExtendsFramework\Command\Handler\CommandHandlerException;
use ExtendsFramework\Command\Handler\CommandHandlerInterface;
use ExtendsFramework\Command\Model\AggregateInterface;
use ExtendsFramework\Command\Repository\RepositoryException;
use ExtendsFramework\Command\Repository\RepositoryInterface;

class AggregateCommandHandler implements CommandHandlerInterface
{
    /**
     * Aggregate repository.
     *
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * Aggregate class name for payload name.
     *
     * @var AggregateInterface[]
     */
    protected $classNames = [];

    /**
     * AggregateCommandHandler constructor.
     *
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function handle(CommandMessageInterface $commandMessage): void
    {
        $aggregate = $this->getAggregate($commandMessage);
        $aggregate->handle($commandMessage);

        $this->saveAggregate($aggregate);
    }

    /**
     * Add aggregate for payload name.
     *
     * @param string $className
     * @param string $payloadName
     * @return AggregateCommandHandler
     */
    public function addAggregate(string $className, string $payloadName): AggregateCommandHandler
    {
        $this->classNames[$payloadName] = $className;

        return $this;
    }

    /**
     * Get aggregate instance for payload type name.
     *
     * @param CommandMessageInterface $commandMessage
     * @return AggregateInterface
     * @throws RepositoryException
     * @throws CommandHandlerException
     */
    protected function getAggregate(CommandMessageInterface $commandMessage): AggregateInterface
    {
        $payloadName = $commandMessage
            ->getPayloadType()
            ->getName();
        if (array_key_exists($payloadName, $this->classNames) === false) {
            throw new AggregateClassNameNotFound($commandMessage);
        }

        return $this
            ->getRepository()
            ->load($commandMessage->getAggregateId());
    }

    /**
     * Save aggregate to repository.
     *
     * @param AggregateInterface $aggregate
     */
    protected function saveAggregate(AggregateInterface $aggregate): void
    {
        $this
            ->getRepository()
            ->save($aggregate);
    }

    /**
     * Get repository.
     *
     * @return RepositoryInterface
     */
    protected function getRepository(): RepositoryInterface
    {
        return $this->repository;
    }
}
