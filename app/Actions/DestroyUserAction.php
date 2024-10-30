<?php

namespace App\Actions;

use App\Repositories\Interfaces\UserRepositoryInterface;

class DestroyUserAction
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function execute(int $id): void
    {
        $this->repository->destroy($id);
    }
}
