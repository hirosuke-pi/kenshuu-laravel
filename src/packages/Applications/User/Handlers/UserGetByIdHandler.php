<?php

namespace Packages\Applications\User\Handlers;

use Packages\Applications\User\Requests\UserGetByIdRequest;
use Packages\Applications\User\Responses\UserGetResponse;
use Packages\Applications\User\UseCases\UserGetByIdUseCase;
use Packages\Domains\Interfaces\Repositories\UserRepository;

final class UserGetByIdHandler implements UserGetByIdUseCase
{
    public function __construct(
        private readonly UserRepository $repository
    ) {}

    public function handle(UserGetByIdRequest $request): UserGetResponse
    {
        return new UserGetResponse(
            user: $this->repository->find($request->getUserId())
        );
    }
}
