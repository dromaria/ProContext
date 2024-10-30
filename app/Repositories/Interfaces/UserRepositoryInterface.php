<?php

namespace App\Repositories\Interfaces;

use App\DTO\Pagination\PaginationDTO;
use App\DTO\User\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function index(PaginationDTO $paginationDTO): Collection;

    public function store(UserDTO $userDTO): Model|User;

    public function show(int $id): Model|User;

    public function update(int $id, UserDTO $userDTO): Model|User;

    public function destroy(int $id): void;
}
