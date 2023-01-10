<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
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
    public function user_exist_in_database_after_invitation()
    {
        $this->post(route('invitation.store', $this->getUserData('Geo', 'Hotz', 'geohotz', 'geo@gmail.com')));

        $this->assertDatabaseHas('users', ['email' => 'geo@gmail.com', 'email_verified_at' => null]);
    }
}
