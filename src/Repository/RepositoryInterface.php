<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Repository;

use ExtendsFramework\Command\Model\AggregateInterface;

interface RepositoryInterface
{
    /**
     * Load aggregate for identifier.
     *
     * An exception will be thrown when aggregate for identifier can not be found.
     *
     * @param string $identifier
     * @return AggregateInterface
     * @throws RepositoryException
     */
    public function load(string $identifier): AggregateInterface;

    /**
     * Save aggregate.
     *
     * @param AggregateInterface $aggregate
     * @return void
     */
    public function save(AggregateInterface $aggregate): void;
}
