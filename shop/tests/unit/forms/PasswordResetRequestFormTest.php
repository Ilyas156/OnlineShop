<?php

namespace shop\tests\unit\forms;

use Codeception\Test\Unit;
use shop\tests\UnitTester;
use Yii;
use shop\forms\auth\PasswordResetRequestForm;
/*use common\fixtures\UserFixture as UserFixture;*/
use shop\fixtures\UserFixture;
use shop\entities\User\User;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class PasswordResetRequestFormTest extends Unit
{

    protected array $tester;



    public function setUp(): void
    {
        $this->tester = [
            [
                'username' => 'okirlin',
                'auth_key' => 'iwTNae9t34OmnK6l4vT4IeaTk-YWI2Rv',
                'password_hash' => '$2y$13$CXT0Rkle1EMJ/c1l5bylL.EylfmQ39O5JlHJVFpNn618OUS1HwaIi',
                'password_reset_token' => 't5GU9NwpuGYSfb7FEZMAxqtuz2PkEvv_' . time(),
                'created_at' => '1391885313',
                'updated_at' => '1391885313',
                'email' => 'brady.renner@rutherford.com',
            ],
            [
                'username' => 'troy.becker',
                'auth_key' => 'EdKfXrx88weFMV0vIxuTMWKgfK2tS3Lp',
                'password_hash' => '$2y$13$g5nv41Px7VBqhS3hVsVN2.MKfgT3jFdkXEsMC4rQJLfaMa7VaJqL2',
                'password_reset_token' => '4BSNyiZNAuxjs5Mty990c47sVrgllIi_' . time(),
                'created_at' => '1391885313',
                'updated_at' => '1391885313',
                'email' => 'nicolas.dianna@hotmail.com',
                'status' => '0',
            ],
        ];
    }

    public function testWithWrongEmailAddress()
    {
        $model = new PasswordResetRequestForm();
        $model->email = 'not-existing-email@example.com';
        assertFalse($model->validate());
    }

    public function testInactiveUser()
    {
        $user = $this->tester->grabFixture('user', 1);
        $model = new PasswordResetRequestForm();
        $model->email = $user['email'];
        assertFalse($model->validate());
    }

    public function testSuccessfully()
    {
        $userFixture = $this->tester[0];

        $model = new PasswordResetRequestForm();
        $model->email = $userFixture['email'];
        $user = User::findOne(['password_reset_token' => $userFixture['password_reset_token']]);

        assertTrue($model->validate());
    }
}