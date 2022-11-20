<?php
namespace shop\tests\unit\forms;

use Codeception\Test\Unit;
use shop\forms\ContactForm;
use function PHPUnit\Framework\assertTrue;

class ContactFormTest extends Unit
{
    public function testSuccess()
    {
        $model = new ContactForm();

        $model->attributes = [
            'name' => 'Tester',
            'email' => 'tester@example.com',
            'subject' => 'very important letter subject',
            'body' => 'body of current message',
        ];

        assertTrue($model->validate(['name', 'email', 'subject', 'body']));
    }
}