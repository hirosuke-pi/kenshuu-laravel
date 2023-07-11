<?php

namespace Packages\Domains\Interfaces\Factories;

use Packages\Domains\Entities\News;

interface NewsFactoryInterface {
    /**
     * ニュースを生成する
     *
     * @param string $id ニュースID
     * @param string $userId ユーザーID
     * @param string $title タイトル
     * @param string $body 本文
     * @param string $createdAt 作成日時
     * @param string $updatedAt 更新日時
     * @return News ニュースEntity
     */
    public function create(string $id, string $userId, string $title, string $body, string $createdAt, string $updatedAt): News;
}
