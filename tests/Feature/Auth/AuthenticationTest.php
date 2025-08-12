<?php

namespace Tests\Feature\Auth;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'author', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
    }
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

//    public function test_users_can_authenticate_using_the_login_screen(): void
//    {
//        $user = User::factory()->create();
//        $user->assignRole('admin');
//
//        $response = $this->post('/login', [
//            'email' => $user->email,
//            'password' => 'password',
//        ]);
//
//        $this->assertAuthenticated();
//        $response->assertRedirect(route('dashboard', absolute: false));
//
//
//        $user2 = User::factory()->create();
//        $user2->assignRole('user');
//
//        $this->withSession(['url.intended' => route('user.profile', absolute: false)]);
//
//        $response2 = $this->post('/login', [
//            'email' => $user2->email,
//            'password' => 'password',
//        ]);
//
//        $this->assertAuthenticated();
//        $response2->assertRedirect(route('user.profile', absolute: false));
//
//    }

    /**
     * @dataProvider roleRedirectProvider
     */
    public function test_users_are_redirected_based_on_role(string $role, string $expectedRoute): void
    {
        // ساخت کاربر و انتساب نقش
        $user = User::factory()->create();
        $user->assignRole($role);

        // اقدام به لاگین
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route($expectedRoute, absolute: false));
    }

    public static function roleRedirectProvider(): array
    {
        return [
            'admin gets dashboard' => ['admin', 'dashboard'],
            'user gets profile' => ['user', 'user.profile'],
        ];
    }
    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
