<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Handler\Exception;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Command\Handler\CommandHandlerException;
use RuntimeException;

class MethodNotFound extends RuntimeException implements CommandHandlerException
{
    /**
     * MethodNotFound constructor.
     *
     * @param CommandMessageInterface $commandMessage
     */
    public function __construct(CommandMessageInterface $commandMessage)
    {
        parent::__construct(sprintf(
            'No command handler method found for payload name "%s".',
            $commandMessage
                ->getPayloadType()
                ->getName()
        ));
    }
}
