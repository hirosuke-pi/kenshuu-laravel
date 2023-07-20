<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;
use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;

use App\Models\Post as PostModel;
use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;
use Packages\Infrastructure\Factories\RepositoryNewsFactory;

final class EloquentNewsRepository implements NewsRepositoryInterface
{
    private const PREFIX = 'news';
    private readonly RepositoryNewsFactory $newsFactory;

    /**
     * NewsRepositoryのコンストラクタ
     *
     * @param TagRepositoryInterface $tagRepository タグリポジトリ
     * @param ImageRepositoryInterface $imageRepository 画像リポジトリ
     */
    public function __construct(
        private readonly TagRepositoryInterface $tagRepository,
        private readonly ImageRepositoryInterface $imageRepository,
        private readonly UserRepositoryInterface $userRepository,
    ) {
        $this->newsFactory = new RepositoryNewsFactory(
            userRepository: $this->userRepository,
            tagRepository: $this->tagRepository,
            imageRepository: $this->imageRepository
        );
    }

    /**
     * ニュースを全件取得する
     *
     * @return array|null ニュースEntityの配列
     */
    public function findAll(): ?array
    {
        $posts = PostModel::whereNull('deleted_at')->get();
        if($posts->isEmpty()) return null;

        $newsEntities = [];
        foreach($posts as $post) {
            $newsEntities[] = $this->newsFactory->createWithUserId(
                id: $post->id,
                userId: $post->user_id,
                title: $post->title,
                body: $post->body,
                createdAt: $post->created_at,
                updatedAt: $post->updated_at,
            );
        }

        return $newsEntities;
    }

    /**
     * ニュースを取得する
     *
     * @param string $id ニュースID
     * @return News|null ニュースEntity
     */
    public function find(string $id): ?News
    {
        $post = PostModel::whereNull('deleted_at')->find($id);
        if (is_null($post)) {
            return null;
        }

        return $this->newsFactory->createWithUserId(
            id: $post->id,
            userId: $post->user_id,
            title: $post->title,
            body: $post->body,
            createdAt: $post->created_at,
            updatedAt: $post->updated_at,
        );
    }

    /**
     * ユーザーIDに紐づくニュースを取得する
     *
     * @param User $user ユーザーエンティティ
     * @return array|null ニュースEntityの配列
     */
    public function findByUser(User $user): ?array {
        $posts = PostModel::where('user_id', $user->getId())->whereNull('deleted_at')->get();
        if($posts->isEmpty()) {
            return null;
        }

        $newsEntities = [];
        foreach($posts as $post) {
            $newsEntities[] = $this->newsFactory->create(
                id: $post->id,
                author: $user,
                title: $post->title,
                body: $post->body,
                createdAt: $post->created_at,
                updatedAt: $post->updated_at,
            );
        }

        return $newsEntities;
    }

    /**
     * ニュースを保存する
     *
     * @param News $news ニュースEntity
     * @return bool 保存結果
     */
    public function save(News $news): bool
    {
        $post = PostModel::find($news->getId()) ?? new PostModel();
        $post->id = $news->getId();
        $post->user_id = $news->getAuthor()->getId();
        $post->title = $news->getTitle();
        $post->body = $news->getBody();
        $post->created_at = $news->getCreatedAt();
        $post->updated_at = $news->getUpdatedAt();
        $result['news'] = $post->save();

        foreach($news->getTags() as $tag) {
            $result[$tag->getId()] = $this->tagRepository->saveWithPostId($tag, $news->getId());
        }

        foreach($news->getAllImages() as $image) {
            $result[$image->getId()] = $this->imageRepository->save($image, $news->getId());
        }

        return !in_array(false, $result, true);
    }

    /**
     * ニュースIDを生成する
     *
     * @return string ニュースID
     */
    public function generateId(): string
    {
        return self::PREFIX .'-'. uniqid(mt_rand());
    }
}
