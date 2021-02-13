<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Fixtures\Components\CharactersTable;
use Karvaka\Wired\Table\Utils;

class UtilsTest extends TestCase
{
    public function testCanHumanize(): void
    {
        $this->assertEquals('Characters Table', Utils::humanize(new CharactersTable));
        $this->assertEquals('Snake Attribute', Utils::humanize('snake_attribute'));
        $this->assertEquals('Nested Dot Attribute', Utils::humanize('nested.dot.attribute'));
    }
}
