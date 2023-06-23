<?php

namespace Packages\Applications\News\Handlers;

use Packages\Applications\News\Requests\NewsGetAllRequest;
use Packages\Applications\News\UseCases\NewsGetAllUseCase;
use Packages\Applications\News\Responses\NewsGetAllResponse;
use Packages\Domains\Interfaces\Repositories\NewsRepository;

final class NewsGetAllHandler implements NewsGetAllUseCase
{
    public function __construct(
        private readonly NewsRepository $repository
    ) {}

    public function handle(NewsGetAllRequest $request): NewsGetAllResponse
    {
        return new NewsGetAllResponse(
            newsEntities: $this->repository->findAll()
        );
    }
}
