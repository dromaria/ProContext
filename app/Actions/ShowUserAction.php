<?php

namespace App\Actions;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ShowUserAction
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function execute(int $id): Model|User
    {
        return $this->repository->show($id);
    }
}
