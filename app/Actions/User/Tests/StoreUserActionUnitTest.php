<?php

use App\Actions\User\StoreUserAction;
use App\DTO\User\UserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Tests\UnitTestCase;

uses(UnitTestCase::class)
    ->group('unit', 'action', 'user', 'store');

beforeEach(function (){
   $this->repository = Mockery::mock(UserRepositoryInterface::class);
   $this->action = new StoreUserAction($this->repository);
});

test('user action success with store', function () {

    $user = User::factory()->withId(1)->make();
    $userDTO = new UserDTO();

    $this->repository->expects('store')->with($userDTO)->andReturn($user);
    $response = $this->action->execute($userDTO);

    expect($response)->toEqual($user);
});

