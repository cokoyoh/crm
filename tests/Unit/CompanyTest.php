<?php

namespace Tests\Unit;

use CRM\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\UserFactory;
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

    /** @test */
    public function it_has_many_users()
    {
        $company = create(Company::class);

        $this->assertInstanceOf(Collection::class, $company->users);
    }

    /** @test */
    public function it_has_an_admin()
    {
        $lehmanBrothers = create(Company::class);

        $hepzibahSmith = UserFactory::fromCompany($lehmanBrothers)->withRole('admin')->create();

        $this->assertEquals($lehmanBrothers->admin->name, $hepzibahSmith->name);
    }
}
