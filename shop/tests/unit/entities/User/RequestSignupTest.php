<?php

namespace shop\tests\unit\entities\User;

use Codeception\Test\Unit;
use shop\entities\User\User;
use yii\base\Exception;

class RequestSignupTest extends Unit
{
    /**
     * @throws Exception
     */
    public function testSuccess()
    {
        $user = User::requestSignup(
            $username = 'username',
            $email = 'email@site.com',
            $password = 'password'
        );

        $this->assertEquals($username, $user->username);
        $this->assertEquals($email, $user->email);
        $this->assertNotEmpty($user->password_hash);
        $this->assertNotEquals($password, $user->password_hash);
        $this->assertNotEmpty($user->created_at);
        $this->assertNotEmpty($user->auth_key);
        $this->assertNotEmpty($user->email_confirm_token);
        $this->assertTrue($user->isWait());
        $this->assertFalse($user->isActive());
    }
}