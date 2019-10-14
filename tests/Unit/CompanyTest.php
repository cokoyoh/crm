<?php

namespace Tests\Unit;

use CRM\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $company = create(Company::class);

        $this->assertEquals('/companies/' . $company->id, $company->path());
    }
}
