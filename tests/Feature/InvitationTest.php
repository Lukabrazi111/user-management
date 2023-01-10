<?php

namespace Tests\Feature;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class InvitationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function user_can_see_invitation_or_registration_page()
    {
        $this->get(route('invitation.create'))->assertOk();
    }

    /**
     * @test
     */
    public function user_can_see_validation_errors_on_invitation_page()
    {
        $response = $this->post(route('invitation.store', $this->getUserData('', '', '', '')));
        $response->assertSessionHasErrors(['first_name', 'last_name', 'username', 'email']);

        $this->get(route('invitation.create'))
            ->assertSee('The first name field is required')
            ->assertSee('The email field is required.');
    }

    /**
     * Get user data
     */
    public function getUserData($first_name, $last_name, $username, $email, $image = null)
    {
        return [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'username' => $username,
            'email' => $email,
            'image' => $image,
        ];
    }

    /**
     * @test
     */
    public function user_invitation_token_exist_after_submit_form()
    {
        $this->post(route('invitation.store', $this->getUserData('Geo', 'Hotz', 'geohotz', 'geo@gmail.com')))
            ->assertRedirectToRoute('login.create')
            ->assertSessionHas('success', __('invitation.email.sent'));

        $this->get(route('login.create'))
            ->assertSee(__('invitation.email.sent'));

        $user = User::first();
        $invitation = Invitation::create(['user_id' => $user->id, 'token' => Str::random(30)]);

        $this->assertDatabaseHas('invitations', ['user_id' => $invitation->user_id, 'token' => $invitation->token]);
    }

    /**
     * @test
     */
    public function user_can_verify_email_with_specific_invitation_token()
    {
        $user = User::factory()->create(['email_verified_at' => null, 'email' => 'geo@gmail.com', 'username' => 'geohotz']);
        $token = Str::random(30);
        $invitation = Invitation::create(['user_id' => $user->id, 'token' => $token]);

        $this->get(route('register.create', $token))
            ->assertOk();

        $data = [
            'token' => $invitation->token,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post(route('register.store', $data));
        $response->assertSessionHas('success', __('auth.verified'));
        $response->assertRedirectToRoute('login.create');
        $response->assertSessionMissing('error');

        $this->assertDatabaseCount('invitations', 0);
        $this->assertDatabaseMissing('invitations', $invitation->toArray());
        $this->assertDatabaseHas('users', ['email_verified_at' => now()]);
    }

    /**
     * @test
     */
    public function user_can_not_verify_his_account_if_token_does_not_exist()
    {
        $token = Str::random(30);

        $data = [
            'token' => $token,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $this->post(route('register.store', $data))
            ->assertSessionHasErrors('token');
    }

    /**
     * @test
     */
    public function user_exist_in_database_after_invitation()
    {
        $this->post(route('invitation.store', $this->getUserData('Geo', 'Hotz', 'geohotz', 'geo@gmail.com')));

        $this->assertDatabaseHas('users', ['email' => 'geo@gmail.com', 'email_verified_at' => null]);
    }
}
