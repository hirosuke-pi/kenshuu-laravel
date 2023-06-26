<?php

namespace Packages\Applications\User\UseCases;

use Packages\Applications\User\Requests\UserCreateRequest;
use Packages\Applications\User\Responses\UserCreateResponse;
use Packages\Domains\Interfaces\Repositories\UserRepository;

interface UserCreateUseCase
{
    public function __construct(UserRepository $repository);
    public function handle(UserCreateRequest $request): UserCreateResponse;
}
