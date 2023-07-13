<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Packages\Infrastructure\Repositories\EloquentTagRepository;
use Tests\TestCase;

class TagRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private readonly EloquentTagRepository $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new EloquentTagRepository();
    }

    public function test_指定したタグIDのタグEntityが取得できるか(): void {
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
}