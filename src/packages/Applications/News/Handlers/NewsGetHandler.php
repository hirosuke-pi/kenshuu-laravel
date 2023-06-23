<?php

namespace Packages\Applications\News\Handlers;

use Packages\Applications\News\Requests\NewsGetRequest;
use Packages\Applications\News\Responses\NewsGetResponse;
use Packages\Applications\News\UseCases\NewsGetUseCase;
use Packages\Domains\Interfaces\Repositories\NewsRepository;

final class NewsGetHandler implements NewsGetUseCase
{
    public function __construct(
        private readonly NewsRepository $repository
    ) {}

    public function handle(NewsGetRequest $request): NewsGetResponse
    {
        return new NewsGetResponse(
            news: $this->repository->find($request->getNewsId())
        );
    }
}
