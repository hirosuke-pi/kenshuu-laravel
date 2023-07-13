<?php

namespace Tests\Unit\Entities;

use Packages\Domains\Entities\Tag;
use Tests\TestCase;

class TagEntityTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_設定したタグIDを取得する事ができるか(): void
    {
        $tag = new Tag('123', 'Example Tag');
        $this->assertSame('123', $tag->getId());

        $tag = new Tag('test', 'Test Name');
        $this->assertSame('test', $tag->getId());
    }

    public function test_設定したタグ名を取得する事ができるか(): void
    {
        $tag = new Tag('123', 'Example Tag');
        $this->assertSame('Example Tag', $tag->getName());

        $tag = new Tag('test', 'Test Name');
        $this->assertSame('Test Name', $tag->getName());
    }
}
