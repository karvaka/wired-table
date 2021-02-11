<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Fixtures\LegendsTable;
use Karvaka\Wired\Table\Utils;

class UtilsTest extends TestCase
{
    public function testHumanize(): void
    {
        $this->assertEquals('Legends Table', Utils::humanize(new LegendsTable));
        $this->assertEquals('Snake Attribute', Utils::humanize('snake_attribute'));
        $this->assertEquals('Nested Dot Attribute', Utils::humanize('nested.dot.attribute'));
    }
}
