<?php

namespace Tests\Unit;

use CRM\Models\Company;
use CRM\Models\LeadSource;
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

    /** @test */
    public function it_gets_the_plural()
    {
        $this->assertEquals('Companies', pluralise('Company', 2));
    }

    /** @test */
    public function it_has_a_status()
    {
        $company = create(Company::class);

        $this->assertEquals($company->status, 'Unverified');
    }

    /** @test */
    public function it_has_lead_sources()
    {
        $company = create(Company::class);

        $leadSource = create(LeadSource::class, ['company_id' => $company->id]);

        $this->assertTrue($company->leadSources->contains($leadSource));
    }
}
