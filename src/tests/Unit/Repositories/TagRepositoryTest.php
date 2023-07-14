<?php

namespace Tests\Unit\Repositories;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Packages\Infrastructure\Repositories\EloquentImageRepository;
use Packages\Infrastructure\Repositories\EloquentNewsRepository;
use Packages\Infrastructure\Repositories\EloquentTagRepository;
use Packages\Infrastructure\Repositories\EloquentUserRepository;
use Tests\TestCase;

class TagRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private readonly EloquentTagRepository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $userRepository = new EloquentUserRepository();
        $tagRepository = new EloquentTagRepository();
        $imageRepository = new EloquentImageRepository();

        $newsRepository = new EloquentNewsRepository($tagRepository, $imageRepository, $userRepository);

        $this->repository = new EloquentTagRepository();

        $tag = new Tag();
        $tag->create(['id' => '1',  'tag_name' => 'テクノロジー']);
        $tag->create(['id' => '2',  'tag_name' => 'モバイル']);
        $tag->create(['id' => '3',  'tag_name' => 'アプリ']);
        $tag->create(['id' => '4',  'tag_name' => 'エンタメ']);
        $tag->create(['id' => '5',  'tag_name' => 'ビューティー']);
        $tag->create(['id' => '6',  'tag_name' => 'ファッション']);
        $tag->create(['id' => '7',  'tag_name' => 'ライフスタイル']);
        $tag->create(['id' => '8',  'tag_name' => 'ビジネス']);
        $tag->create(['id' => '9',  'tag_name' => 'グルメ']);
        $tag->create(['id' => '10', 'tag_name' => 'スポーツ']);
    }

    public function test_指定したタグIDのタグTagEntityが取得できるか(): void {
        $tag = $this->repository->find('1');
        $this->assertSame('1', $tag->getId());
        $this->assertSame('テクノロジー', $tag->getName());

        $tag = $this->repository->find('5');
        $this->assertSame('5', $tag->getId());
        $this->assertSame('ビューティー', $tag->getName());

        $tag = $this->repository->find('3');
        $this->assertSame('3', $tag->getId());
        $this->assertSame('アプリ', $tag->getName());
    }

    public function test_指定したタグIDが存在しなかった場合、nullを返す(): void {
        $tag = $this->repository->find('0');
        $this->assertNull($tag);

        $tag = $this->repository->find('11');
        $this->assertNull($tag);

        $tag = $this->repository->find('dfgs');
        $this->assertNull($tag);

        $tag = $this->repository->find('-8');
        $this->assertNull($tag);
    }

    public function test_指定した複数のタグIDから、それに対応するTagEntityの配列を取得できるか(): void {
        $tag = $this->repository->findByIds([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
        $this->assertCount(10, $tag);

        $tag = $this->repository->findByIds([4, 3, 5, 9]);
        $this->assertCount(4, $tag);

        $tag = $this->repository->findByIds([2]);
        $this->assertCount(1, $tag);

        $tag = $this->repository->findByIds([]);
        $this->assertCount(0, $tag);

        $tag = $this->repository->findByIds([-1, 4, 2, 99]);
        $this->assertCount(2, $tag);
    }

    public function test_全てのタグを取得する事ができるか(): void {
        $tags = $this->repository->findAll();
        $this->assertCount(10, $tags);
    }

    public function test_タグIDを生成できるか(): void {
        $tagId = $this->repository->generateId();
        $this->assertIsString($tagId);
    }
}
