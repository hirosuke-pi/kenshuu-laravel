<?php

namespace Packages\Applications\News\UseCases;

use Packages\Applications\News\Requests\NewsGetAllRequest;
use Packages\Applications\News\Responses\NewsGetAllResponse;

interface NewsGetAllUseCase
{
    public function handle(NewsGetAllRequest $request): NewsGetAllResponse;
}
