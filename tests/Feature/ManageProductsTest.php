<?php

namespace Tests\Feature;

use CRM\Models\Company;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProductFactory;
use Tests\TestCase;

class ManageProductsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_products()
    {
        $this->post(route('products.store'), [])
            ->assertRedirect('login');
    }

    /** @test */
    public function users_who_are_not_admins_cannot_add_company_products()
    {
        $user = UserFactory::regularUser()->create();

        $this->actingAs($user)
            ->post(route('products.store'), [])
            ->assertForbidden();
    }

    /** @test */
    public function product_name_is_required_when_adding_a_product()
    {
        $wayneEnterprises = create(Company::class);

        $mrFox = UserFactory::fromCompany($wayneEnterprises)->admin()->create();

        $this->actingAs($mrFox)
            ->post(route('products.store'), ['name' => ''])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function authorised_users_can_add_products_to_a_company()
    {
        $wayneEnterprises = create(Company::class);

        $mrFox = UserFactory::fromCompany($wayneEnterprises)->admin()->create();

        $attributes = ['name' => 'Million Dollar LLC'];

        $this->actingAs($mrFox)
            ->post(route('products.store'), $attributes)
            ->assertRedirect();

        $this->assertDatabaseHas('products', $attributes);
    }

    /** @test */
    public function admins_can_view_products_from_the_company_in_which_they_are_members()
    {
        $wayneEnterprises = create(Company::class);

        $mrFox = UserFactory::fromCompany($wayneEnterprises)->admin()->create();

        $productA = ProductFactory::fromCompany($wayneEnterprises)->create();

        $productB = ProductFactory::fromCompany(create(Company::class))->create();

        $jsonResponse = $this->actingAs($mrFox)->get('/apis/products');

        $jsonResponse->assertJsonFragment(['name' => $productA->name]);

        $jsonResponse->assertJsonMissing(['name' => $productB->name]);
    }
}
