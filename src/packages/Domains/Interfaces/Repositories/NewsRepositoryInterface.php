<?php

namespace Packages\Domains\Interfaces\Repositories;

use Packages\Domains\Interfaces\Factories\NewsFactoryInterface;
use Packages\Domains\Entities\News;

interface NewsRepositoryInterface
{
    /**
     * NewsRepositoryのコンストラクタ
     *
     * @param NewsFactoryInterface $newsFactory ニュースファクトリ
     */
    public function __construct(NewsFactoryInterface $newsFactory);

    /**
     * ニュースを全件取得する
     *
     * @return array ニュースEntityの配列
     */
    public function findAll(): array;

    /**
     * ニュースIDからニュースを取得する
     *
     * @param string $id ニュースID
     * @return News|null ニュースEntity
     */
    public function find(string $id): ?News;

    /**
     * ニュースを保存する
     *
     * @param News $news ニュースEntity
     * @return void
     */
    public function save(News $news): void;

    /**
     * ニュースIDを生成する
     *
     * @return string ニュースID
     */
    public function generateId(): string;
}
