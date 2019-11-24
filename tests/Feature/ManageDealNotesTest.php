<?php

namespace Tests\Feature;

use CRM\Models\Deal;
use CRM\Models\User;
use Facades\Tests\Setup\DealFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageDealNotesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_deal_notes()
    {
        $deal = create(Deal::class);

        $this->post(route('deals.notes.store', $deal), [])
            ->assertRedirect('login');
    }

    /** @test */
    public function a_user_cannot_add_a_note_to_deal_which_they_not_own()
    {
        $user = create(User::class);

        $deal = DealFactory::belongingTo(create(User::class))->create();

        $this->actingAs($user)
            ->post(route('deals.notes.store', $deal), [])
            ->assertForbidden();
    }

    /** @test */
    public function user_id_is_required_when_adding_notes_to_a_deal()
    {
        $user = create(User::class);

        $deal = DealFactory::belongingTo($user)->create();

        $this->actingAs($user)
            ->post(route('deals.notes.store', $deal), ['user_id' => ''])
            ->assertSessionHasErrors('user_id');
    }

    /** @test */
    public function authorised_users_can_add_notes_to_a_deal()
    {
        $user = create(User::class);

        $deal = DealFactory::belongingTo($user)->create();

        $attributes = [
            'user_id' => $user->id,
            'body' => 'Some hocus pocus notes'
        ];

        $this->actingAs($user)
            ->post(route('deals.notes.store', $deal), $attributes)
            ->assertRedirect(route('deals.show', $deal));

        $this->assertDatabaseHas('deal_notes', $attributes);
    }
}
