<?php

namespace Tests\Feature\Dashboard;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AkunTest extends TestCase
{
    use RefreshDatabase;

    /**
     * acting as user
     *
     * @return void
     */
    private function acting()
    {
        Role::create(['name' => 'superadmin']);
        $user = User::factory()->create();
        $user->assignRole('superadmin');
        $this->actingAs($user);

        return $user;
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function seeAkunPage()
    {
        $this->acting();
        $response = $this->get('/akun');

        $response->assertStatus(200);
    }

    /** @test */
    public function userCanUpdateAkun()
    {
        Role::create(['name' => 'superadmin']);
        $user = User::factory()->create();
        $user->assignRole('superadmin');
        $data = [
            'name'     => 'new name',
            'username' => 'updateusername',
            'email'    => 'new.email@email.com',
        ];
        $response = $this->actingAs($user)->post('/akun', $data);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    /**
     * @test
     *
     * @dataProvider invalidUser
     */
    public function userValidationData($invalidData, $invalidField)
    {
        Role::create(['name' => 'superadmin']);
        $user = User::factory()->create();
        $user->assignRole('superadmin');

        User::factory()->create([
            'name'     => 'same',
            'username' => 'same@gmail.com',
            'email'    => 'same@gmail.com',
        ]);

        $response = $this->actingAs($user)->post('/akun', $invalidData);
        $response->assertRedirect();
        $response->assertSessionHasErrors($invalidField);
        $response->assertStatus(302);
    }

    public function invalidUser()
    {
        return [
            [
                [
                    'name'     => null,
                    'username' => 'username1',
                    'email'    => 'email1@gmail.com',
                ],
                ['name'],
            ],
            [
                [
                    'name'     => 'name',
                    'username' => '',
                    'email'    => 'email1@gmail.com',
                ],
                ['username'],
            ],
            [
                [
                    'name'     => 'name',
                    'username' => 'username1',
                    'email'    => '',
                ],
                ['email'],
            ],
            [
                [
                    'name'     => 'same',
                    'username' => 'same@gmail.com',
                    'email'    => 'same@gmail.com',
                ],
                ['username'],
            ],
        ];
    }

    /** @test */
    public function seePasswordPage()
    {
        $this->acting();
        $response = $this->get('/akun/password');
        $response->assertStatus(200);
    }

    /**
     * User Can Update His Password
     *
     * @test
     */
    public function userCanUpdatePassword()
    {
        $this->withoutExceptionHandling();
        Role::create(['name' => 'superadmin']);
        $user = User::factory()->create();
        $user->assignRole('superadmin');
        $data = [
            'old_password'          => 'password',
            'password'              => 'newpassord',
            'password_confirmation' => 'newpassord',
        ];
        $response = $this->actingAs($user)->post('/akun/password', $data);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }

    /** @test */
    public function oldPasswordMustSame()
    {
        Role::create(['name' => 'superadmin']);
        $user = User::factory()->create();
        $user->assignRole('superadmin');
        $this->actingAs($user);

        $data = [
            'old_password'          => 'wrong-password',
            'password'              => 'newpassord',
            'password_confirmation' => 'newpassord',
        ];

        $response = $this->post('/akun/password', $data);
        $response->assertSessionHasErrors();
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }

    /** @test */
    public function newPasswordMustSame()
    {
        Role::create(['name' => 'superadmin']);
        $user = User::factory()->create();
        $user->assignRole('superadmin');
        $this->actingAs($user);

        $data = [
            'old_password'          => Hash::make('password'),
            'password'              => 'newpassord',
            'password_confirmation' => 'wrong-new-password',
        ];

        $response = $this->post('/akun/password', $data);
        $response->assertSessionHasErrors();
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}
