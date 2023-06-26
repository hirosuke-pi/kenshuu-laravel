<?php

namespace Packages\Applications\News\UseCases;

use Packages\Applications\News\Requests\NewsGetAllRequest;
use Packages\Applications\News\Responses\NewsGetAllResponse;
use Packages\Domains\Interfaces\Repositories\NewsRepository;

interface NewsGetAllUseCase
{
    public function __construct(NewsRepository $repository);
    public function handle(NewsGetAllRequest $request): NewsGetAllResponse;
}
