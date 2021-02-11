<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Fixtures\UnknownTable;
use Tests\Fixtures\LegendsTable;
use Illuminate\Database\Eloquent\Builder;

class TableTest extends TestCase
{
    public function testQueryCanBeDiscovered(): void
    {
        $table = new LegendsTable;

        $this->assertInstanceOf(Builder::class, $table->query());
    }

    public function testThrowsExceptionIfQueryNotDiscovered(): void
    {
        $this->expectException(\BadMethodCallException::class);

        (new UnknownTable)->query();
    }

    public function testGetModelsAppliesTraitsQueryModifiers()
    {
        //
    }
}
