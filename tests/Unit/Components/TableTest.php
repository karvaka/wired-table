<?php

namespace Tests\Unit\Components;

use Tests\TestCase;
use Tests\Fixtures\Components\UnknownTable;
use Tests\Fixtures\Components\CharactersTable;
use Illuminate\Database\Eloquent\Builder;

class TableTest extends TestCase
{
    public function testQueryCanBeDiscovered(): void
    {
        $table = new CharactersTable;

        $this->assertInstanceOf(Builder::class, $table->query());
    }

    public function testThrowsExceptionIfQueryNotDiscovered(): void
    {
        $this->expectException(\BadMethodCallException::class);

        (new UnknownTable)->query();
    }

//    public function testGetModelsAppliesTraitsQueryModifiers(): void
//    {
//        //
//    }
}
