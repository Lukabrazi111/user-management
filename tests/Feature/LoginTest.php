<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get specific data.
     *
     * @param $email
     * @param $password
     * @return array
     */
    public function getLoginFormData($email, $password)
    {
        return [
            'email' => $email,
            'password' => $password,
        ];
    }

    /**
     * @test
     */
    public function user_can_see_login_page()
    {
        $response = $this->get(route('login.create'));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function authorized_user_can_not_see_login_page() {
        $this->seed();
        $response = $this->actingAs(User::first())->get(route('login.create'));

        $response->assertRedirect(route('todo.create'));
    }

    /**
     * @test
     */
    public function show_validation_error_for_empty_fields()
    {
        $this->post(route('login'), $this->getLoginFormData('', ''))
            ->assertSessionHasErrors(['email', 'password']);

        $response = $this->get(route('login.create'));
        $response->assertSee('The email field is required');
        $response->assertSee('The password field is required');
    }

    /**
     * @test
     */
    public function user_entered_wrong_data()
    {
        $response = $this->post(route('login'), $this->getLoginFormData('luka@gmail.com', 'passwd'));

        $response->assertSessionHas('error', __('auth.bad_credentials'));

        $this->get(route('login.create'))
            ->assertSee(__('auth.bad_credentials'));
    }

    /**
     * @test
     */
    public function user_authorized_successfully()
    {
        $response = $this->post(route('login'), $this->getLoginFormData('luka@gmail.com', 'password'));

        $response->assertRedirect(route('todo.create'));
    }

    /**
     * @test
     */
    public function user_can_authorize_with_username_also()
    {
        $response = $this->post(route('login'), $this->getLoginFormData('Lukabrazi111', 'password'));

        $response->assertRedirect(route('todo.create'));
    }

    /**
     * @test
     */
    public function user_logged_out()
    {
        $this->seed();

        $response = $this->actingAs(User::first())->post(route('logout'));

        $response->assertSessionHas('success', __('auth.logged_out'));
        $response->assertRedirect(route('login.create'));
    }
}
