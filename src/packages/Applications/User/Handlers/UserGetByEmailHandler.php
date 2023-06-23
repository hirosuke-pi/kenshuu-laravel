<?php

namespace Packages\Applications\User\Handlers;

use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\Responses\UserGetResponse;
use Packages\Applications\User\UseCases\UserGetByEmailUseCase;
use Packages\Domains\Interfaces\Repositories\UserRepository;

final class UserGetByEmailHandler implements UserGetByEmailUseCase
{
    public function __construct(
        private readonly UserRepository $repository
    ) {}

    public function handle(UserGetByEmailRequest $request): UserGetResponse
    {
        return new UserGetResponse(
            user: $this->repository->find($request->getUserId())
        );
    }
}
