<?php

namespace shop\tests\unit\forms;

use frontend\tests\UnitTester;
use shop\forms\auth\ResetPasswordForm;

class ResetPasswordFormTest extends \Codeception\Test\Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    public function testCorrectToken()
    {
        $form = new ResetPasswordForm();
        $form->password = 'new-password';
        expect_that($form->validate());
    }
}