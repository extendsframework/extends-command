<?php
declare(strict_types=1);

namespace ExtendsFramework\Command\Repository\Exception;

use PHPUnit\Framework\TestCase;

class AggregateNotFoundTest extends TestCase
{
    /**
     * Construct.
     *
     * Test that construct will generate correct message.
     *
     * @covers \ExtendsFramework\Command\Repository\Exception\AggregateNotFound::__construct()
     */
    public function testConstruct(): void
    {
        $exception = new AggregateNotFound('foo');

        $this->assertSame('Aggregate with id "foo" could not be found.', $exception->getMessage());
    }
}
