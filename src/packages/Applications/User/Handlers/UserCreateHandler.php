<?php

namespace Packages\Applications\User\Handlers;

use DateTime;
use Packages\Applications\User\Requests\UserCreateRequest;
use Packages\Applications\User\Responses\UserCreateResponse;
use Packages\Applications\User\UseCases\UserCreateUseCase;
use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Repositories\UserRepository;

final class UserCreateHandler implements UserCreateUseCase
{
    public function __construct(
        private readonly UserRepository $repository
    ) {}

    public function handle(UserCreateRequest $request): UserCreateResponse
    {
        $user = new User(
            id: $this->repository->generateId(),
            email: $request->getEmail(),
            name: $request->getName(),
            password: $request->getPassword(),
            profileImagePath: $request->getProfileImagePath(),
            createdAt: (new DateTime())->format(DateTime::ATOM)
        );
        $this->repository->save($user);

        return new UserCreateResponse(
            user: $user
        );
    }
}
