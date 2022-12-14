<?php

namespace shop\repositories;

use shop\entities\User\User;
use Throwable;
use yii\db\StaleObjectException;

class UserRepository
{
    public function findByUsernameOrEmail(string $value): ?User
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }

    public function findByNetworkIdentity($network, $identity): ?User
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }

    public function getByEmailConfirmToken(string $token): User
    {
        return $this->getBy(['email_confirm_token' => $token]);
    }

    public function getByEmail(string $email): User
    {
        return $this->getBy(['email' => $email]);
    }

    public function getByPasswordResetToken(string $token): User
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function existsByPasswordResetToken(string $token): bool
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    private function getBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User not found.');
        }
        return $user;
    }

    public function get(int $id): User
    {
        return $this->getBy(['id' => $id]);
    }

    /**
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new \RuntimeException();
        }
    }
}