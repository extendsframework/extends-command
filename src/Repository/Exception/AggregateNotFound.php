<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Repository\Exception;

use ExtendsFramework\Command\Repository\RepositoryException;
use InvalidArgumentException;

class AggregateNotFound extends InvalidArgumentException implements RepositoryException
{
    /**
     * AggregateNotFound constructor.
     *
     * @param string $identifier
     */
    public function __construct(string $identifier)
    {
        parent::__construct(sprintf(
            'Aggregate with id "%s" could not be found.',
            $identifier
        ));
    }
}
