<?php

namespace Packages\Applications\User\UseCases;

use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\Responses\UserGetResponse;

interface UserGetByEmailUseCase
{
    public function handle(UserGetByEmailRequest $request): UserGetResponse;
}
