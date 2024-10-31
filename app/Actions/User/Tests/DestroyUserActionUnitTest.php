<?php

use App\Actions\User\DestroyUserAction;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Tests\UnitTestCase;

uses(UnitTestCase::class)
    ->group('unit', 'action', 'user', 'destroy');

beforeEach(function (){
   $this->repository = Mockery::mock(UserRepositoryInterface::class);
   $this->action = new DestroyUserAction($this->repository);
});

test('user action success with destroy', function () {

    $user = User::factory()->withId(1)->make();

    $this->repository->expects('destroy')->andReturnNull();
    $response = $this->action->execute($user->id);

    expect($response)->toBeNull();
});

