<?php

namespace Packages\Applications\News\UseCases;

use Packages\Applications\News\Requests\NewsGetRequest;
use Packages\Applications\News\Responses\NewsGetResponse;

interface NewsGetUseCase
{
    public function handle(NewsGetRequest $request): NewsGetResponse;
}
