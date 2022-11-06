<?php

namespace shop\services;


use shop\forms\ContactForm;
use yii\mail\MailerInterface;

class ContactService
{
    private string|array $adminEmail;
    private MailerInterface $mailer;

    public function __construct(string|array $adminEmail, MailerInterface $mailer)
    {
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
    }

    public function send(ContactForm $form): void
    {
        $sent = $this->mailer->compose()
            ->setTo($this->adminEmail)
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }
}