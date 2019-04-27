<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /** @var User $user */
    private $user;

    public function setUp() {
        parent::setUp();

        $this->seed('TestDatabaseSeeder');

        $this->user = factory(User::class)->create([
            'pin' => 1234
        ]);
    }

    public function testUserPin() {
        $this->assertTrue($this->user->pin == 1234);
    }
}
