<?php

namespace App\Repositories;

use App\DTO\Pagination\PaginationDTO;
use App\DTO\User\UserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository implements UserRepositoryInterface
{

    public function index(PaginationDTO $paginationDTO): Collection
    {
        $offset = ($paginationDTO->page - 1) * $paginationDTO->limit;
        return User::offset($offset)->limit($paginationDTO->limit)->get();
    }

    public function store(UserDTO $userDTO): Model|User
    {
        if (User::where('email', $userDTO->email)->exists()){
            abort(422, 'The email has already been taken.');
        }
        return User::create($userDTO->toArray());
    }

    public function show(int $id): Model|User
    {
        try {
            return User::findOrFail($id);
        } catch (ModelNotFoundException) {
            throw new NotFoundHttpException("User with ID {$id} is not found");
        }
    }

    public function update(int $id, UserDTO $userDTO): Model|User
    {
        $user = $this->show($id);

        if (User::where('email', $userDTO->email)->where('id', '!=', $id)->exists()){
            abort(422, 'The email has already been taken.');
        }
        $user->update($userDTO->toArray());
        return $user;
    }

    public function destroy(int $id): void
    {
        $user = $this->show($id);
        $user->delete();
    }
}
