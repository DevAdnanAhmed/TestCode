<?php

namespace tests\Unit\Repositories;

use Tests\TestCase;
use App\Repositories\UserRepository;

class UserRepositoryTest extends TestCase
{
    protected $userRepository;


    /** @test */
    public function it_creates_a_new_user()
    {
        $requestData = [
            'role' => 'customer',
            'name' => 'Adnan Ahmed',
            'email' => 'adnan.ahmed@gmail.com',
            'password' => 'password123',
        ];

        $user = $this->userRepository->createOrUpdate(null, $requestData);

        $this->assertNotNull($user);
        $this->assertEquals('customer', $user->user_type);
        $this->assertEquals('Adnan Ahmed', $user->name);
        $this->assertEquals('adnan.ahmed@gmail.com', $user->email);
    }

    /** @test */
    public function it_updates_an_existing_user()
    {
        // First, create a user
        $user = factory(\App\User::class)->create();

        $requestData = [
            'role' => 'translator',
            'name' => 'Adnan Ahmed',
            'email' => 'adnan.ahmed@gmail.com',
        ];

        $updatedUser = $this->userRepository->createOrUpdate($user->id, $requestData);

        $this->assertNotNull($updatedUser);
        $this->assertEquals('translator', $updatedUser->user_type);
        $this->assertEquals('Adnan Ahmed', $updatedUser->name);
        $this->assertEquals('adnan.ahmed@gmail.com', $updatedUser->email);
    }
}
