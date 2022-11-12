<?php

namespace shop\services\manage;

use shop\entities\User\User;
use shop\forms\manage\UserCreateForm;
use shop\forms\manage\UserEditForm;
use shop\repositories\UserRepository;
use Throwable;
use yii\base\Exception;
use yii\db\StaleObjectException;

class UserManageService
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password
        );

        $this->repository->save($user);
        return $user;
    }

    public function edit(int $id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email
        );
        $this->repository->save($user);
    }

    /**
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function remove(int $id): void
    {
        $user = $this->repository->get($id);
        $this->repository->remove($user);
    }
}