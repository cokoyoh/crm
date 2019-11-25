<?php

namespace Tests\Unit;

use Facades\CRM\Formatters\CurrencyNumberFormatter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_converts_to_values_to_millions()
    {
        $value = 679890800;

        $result = formatCurrency($value, true);

        $this->assertEquals("$679.89M", $result);
    }
}
