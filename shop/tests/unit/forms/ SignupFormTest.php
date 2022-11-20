<?php
namespace shop\tests\unit\forms;

use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use shop\tests\UnitTester;
use shop\forms\auth\SignupForm;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class SignupFormTest extends Unit
{

    protected UnitTester $tester;

    /**
     * @return array
     */
    public function _fixtures(): array
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

    public function testCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
        ]);

        assertTrue($model->validate());
    }

    public function testNotCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'troy.becker',
            'email' => 'nicolas.dianna@hotmail.com',
            'password' => 'some_password',
        ]);

        assertFalse($model->validate());
        assertTrue($model->getErrors('username'));
        assertTrue($model->getErrors('email'));

        assertEquals($model->getFirstError('username'), 'This username has already been taken.');
        assertEquals($model->getFirstError('email'), 'This email address has already been taken.');

    }
}