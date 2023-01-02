<?php

namespace Tests\Feature;

use Tests\TestCase;

class InvitationTest extends TestCase
{
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
        $data = [
            'first_name' => '',
            'last_name' => '',
            'username' => '',
            'email' => '',
        ];
        $response = $this->post(route('invitation.store', $data));
        $response->assertSessionHasErrors(['first_name', 'last_name', 'username', 'email']);

        $this->get(route('invitation.create'))
            ->assertSee('The first name field is required')
            ->assertSee('The email field is required.');
    }
}
