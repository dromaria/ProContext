<?php

namespace App\Actions;

use App\DTO\User\UserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UpdateUserAction
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function execute(int $id, UserDTO $userDTO): Model|User
    {
        return $this->repository->update($id, $userDTO);
    }
}
