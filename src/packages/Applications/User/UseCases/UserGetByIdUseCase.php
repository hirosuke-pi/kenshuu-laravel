<?php

namespace Packages\Applications\User\UseCases;

use Packages\Applications\User\Requests\UserGetByIdRequest;
use Packages\Applications\User\Responses\UserGetResponse;

interface UserGetByIdUseCase
{
    public function handle(UserGetByIdRequest $request): UserGetResponse;
}
