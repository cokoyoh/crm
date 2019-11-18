<?php

namespace Tests\Feature;

use CRM\Models\Schedule;
use CRM\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageSchedulesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_schedules()
    {
        $schedule = create(Schedule::class);

        $this->post(route('schedules.store'), [])
            ->assertRedirect('login');

        $this->delete(route('schedules.destroy', $schedule))
            ->assertRedirect('login');
    }

    /** @test */
    public function date_is_required_when_adding_a_schedule()
    {
        $this->actingAs(create(User::class))
            ->post(route('schedules.store'), ['date' => ''])
            ->assertSessionHasErrors('date');
    }

    /** @test */
    public function start_time_is_required_when_adding_a_schedule()
    {
        $this->actingAs(create(User::class))
            ->post(route('schedules.store'), ['start_at' => ''])
            ->assertSessionHasErrors('start_at');
    }

    /** @test */
    public function end_time_is_required_when_adding_a_schedule()
    {
        $this->actingAs(create(User::class))
            ->post(route('schedules.store'), ['end_at' => ''])
            ->assertSessionHasErrors('end_at');
    }

    /** @test */
    public function lead_id_is_required_when_adding_a_schedule()
    {
        $this->actingAs(create(User::class))
            ->post(route('schedules.store'), ['lead_id' => ''])
            ->assertSessionHasErrors('lead_id');
    }


    /** @test */
    public function authorised_users_can_add_schedules()
    {
        $this->signIn();

        $attributes = raw(Schedule::class);

        $this->post(route('schedules.store'), $attributes)
            ->assertRedirect(route('dashboard.user', auth()->user()));

        $this->assertDatabaseHas('schedules', [
            'date' => $attributes['date'],
            'user_id' => auth()->id()
        ]);
    }

    /** @test */
    public function a_user_can_only_delete_a_schedule_which_belong_to_them()
    {
        $schedule = create(Schedule::class);

        $this->actingAs(create(User::class))
            ->delete(route('schedules.destroy', $schedule))
            ->assertStatus(403);
    }


    /** @test */
    public function authorised_users_can_delete_a_schedule()
    {
        $jamal = create(User::class);

        $schedule = create(Schedule::class, ['user_id' => $jamal->id]);

        $this->actingAs($jamal)
            ->delete(route('schedules.destroy', $schedule));

        $this->assertDatabaseMissing('schedules', $schedule->toArray());
    }
}
