<?php

use App\Actions\User\UpdateUserAction;
use App\DTO\User\UserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Tests\UnitTestCase;

uses(UnitTestCase::class)
    ->group('unit', 'action', 'user', 'update');

beforeEach(function (){
   $this->repository = Mockery::mock(UserRepositoryInterface::class);
   $this->action = new UpdateUserAction($this->repository);
});

test('user action success with update', function () {

    $user = User::factory()->withId(1)->make();
    $userDTO = new UserDTO();

    $this->repository->expects('update')->with($user->id, $userDTO)->andReturn($user);
    $response = $this->action->execute($user->id, $userDTO);

    expect($response)->toEqual($user);
});

