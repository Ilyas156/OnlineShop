<?php

namespace common\tests\unit\entities;

use Codeception\Test\Unit;
use common\entities\User;

class SignupTest extends Unit
{
    public function testSuccess()
    {
        $user = User::create(
            $username = 'username',
            $email = 'user@mail.ru',
            $password = 'someUserPassword'
        );

        $this->assertEquals($username, $user->username);
        $this->assertEquals($email, $user->email);
        $this->assertNotEmpty($user->password_hash);
        $this->assertNotEquals($password, $user->password_hash);
        $this->assertNotEmpty($user->created_at);
        $this->assertNotEmpty($user->auth_key);
        $this->assertEquals($user::STATUS_ACTIVE, $user->status);

    }
}