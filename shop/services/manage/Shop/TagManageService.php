<?php

use shop\entities\Shop\Tag;
use shop\forms\manage\Shop\TagForm;
use shop\repositories\Shop\TagRepository;
use yii\db\StaleObjectException;

class TagManageService
{
    private TagRepository $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(TagForm $tagForm): Tag
    {
        $tag = Tag::create(
            $tagForm->name,
            $tagForm->slug
        );

        $this->repository->save($tag);

        return $tag;
    }

    public function edit(int $id, TagForm $tagForm): void
    {
        $tag = $this->repository->get($id);

        $tag->edit(
            $tagForm->name,
            $tagForm->slug
        );

        $this->repository->save($tag);
    }

    /**
     * @param int $id
     * @return void
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function remove(int $id): void
    {
        $tag = $this->repository->get($id);

        $this->repository->remove($tag);
    }

}