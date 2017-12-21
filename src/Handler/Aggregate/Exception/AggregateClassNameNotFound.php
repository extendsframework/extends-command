<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Handler\Aggregate\Exception;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Command\Handler\CommandHandlerException;
use InvalidArgumentException;

class AggregateClassNameNotFound extends InvalidArgumentException implements CommandHandlerException
{
    /**
     * AggregateClassNameNotFound constructor.
     *
     * @param CommandMessageInterface $commandMessage
     */
    public function __construct(CommandMessageInterface $commandMessage)
    {
        parent::__construct(sprintf(
            'No aggregate found for payload name "%s".',
            $commandMessage
                ->getPayloadType()
                ->getName()
        ));
    }
}
