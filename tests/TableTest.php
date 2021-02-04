<?php

namespace Tests;

use Tests\Fixtures\UnknownTable;
use Tests\Fixtures\UsersTable;
use Illuminate\Database\Eloquent\Builder;

class TableTest extends TestCase
{
    public function testQueryDiscovered(): void
    {
        $table = new UsersTable;

        $this->assertInstanceOf(Builder::class, $table->query());
    }

    public function testQueryNotDiscovered(): void
    {
        $this->expectException(\BadMethodCallException::class);

        (new UnknownTable())->query();
    }
}
