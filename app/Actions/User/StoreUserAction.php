<?php

namespace App\Actions\User;

use App\DTO\User\UserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class StoreUserAction
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function execute(UserDTO $userDTO): Model|User
    {
        return $this->repository->store($userDTO);
    }
}
