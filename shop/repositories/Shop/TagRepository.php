<?php

namespace shop\repositories\Shop;


use RuntimeException;
use shop\entities\Shop\Tag;
use shop\repositories\NotFoundException;
use Throwable;
use yii\db\StaleObjectException;

class TagRepository
{
    public function get(int $id): Tag
    {
        if (!$tag = Tag::findOne($id)) {
            throw new NotFoundException('Tag is not found');
        }

        return $tag;
    }

    public function save(Tag $tag): void
    {
        if (!$tag->save()) {
            throw new RuntimeException('Saving error');
        }
    }

    /**
     * @throws Throwable
     * @throws StaleObjectException
     * @throws RuntimeException
     */
    public function remove(Tag $tag): void
    {
        if (!$tag->delete()) {
            throw new RuntimeException('Removing error');
        }
    }
}