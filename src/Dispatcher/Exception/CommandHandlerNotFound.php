<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Dispatcher\Exception;

use ExtendsFramework\Command\CommandMessageInterface;
use ExtendsFramework\Command\Dispatcher\CommandDispatcherException;
use InvalidArgumentException;

class CommandHandlerNotFound extends InvalidArgumentException implements CommandDispatcherException
{
    /**
     * CommandHandlerNotFound constructor.
     *
     * @param CommandMessageInterface $commandMessage
     */
    public function __construct(CommandMessageInterface $commandMessage)
    {
        parent::__construct(sprintf(
            'No command handler found for command message payload name "%s".',
            $commandMessage
                ->getPayloadType()
                ->getName()
        ));
    }
}
