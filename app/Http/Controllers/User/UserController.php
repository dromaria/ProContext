<?php

namespace App\Http\Controllers\User;

use App\Actions\User\DestroyUserAction;
use App\Actions\User\IndexUserAction;
use App\Actions\User\ShowUserAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\DTO\Pagination\PaginationDTO;
use App\DTO\User\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pagination\PaginationRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

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

    public function store(StoreUserRequest $request, StoreUserAction $action): JsonResponse
    {
        $userDTO = new UserDTO([
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'age' => $request->getAge(),
        ]);

        $user = $action->execute($userDTO);

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function show(int $id, ShowUserAction $action): UserResource
    {
        $user = $action->execute($id);

        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, int $id, UpdateUserAction $action): UserResource
    {
        $userDTO = new UserDTO($request->validated());

        $user = $action->execute($id, $userDTO);

        return new UserResource($user);
    }

    public function destroy(int $id, DestroyUserAction $action): Response
    {
        $action->execute($id);

        return response()->noContent();
    }
}
