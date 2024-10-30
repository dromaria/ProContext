<?php

namespace App\Http\Controllers;

use App\Actions\DestroyUserAction;
use App\Actions\IndexUserAction;
use App\Actions\ShowUserAction;
use App\Actions\StoreUserAction;
use App\Actions\UpdateUserAction;
use App\DTO\Pagination\PaginationDTO;
use App\DTO\User\UserDTO;
use App\Http\Requests\Pagination\PaginationRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserController extends Controller
{
    public function index(PaginationRequest $request, IndexUserAction $action): ResourceCollection
    {
        $paginationDTO = new PaginationDTO([
            'limit' => $request->getLimit(),
            'page' => $request->getPage(),
        ]);

        $users = $action->execute($paginationDTO);

        return UserResource::collection($users);
    }

    public function store(StoreUserRequest $request, StoreUserAction $action): UserResource
    {
        $userDTO = new UserDTO([
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'age' => $request->getAge(),
        ]);

        $user = $action->execute($userDTO);

        return new UserResource($user);
    }

    public function show(int $id, ShowUserAction $action): UserResource
    {
        $user = $action->execute($id);

        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, int $id, UpdateUserAction $action)
    {
        $userDTO = new UserDTO($request->validated());

        $user = $action->execute($id, $userDTO);

        return new UserResource($user);
    }

    public function destroy(int $id, DestroyUserAction $action)
    {
        $action->execute($id);

        return response()->noContent();
    }
}
