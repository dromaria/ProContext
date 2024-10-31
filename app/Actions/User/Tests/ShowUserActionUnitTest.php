<?php

use App\Actions\User\ShowUserAction;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Tests\UnitTestCase;

uses(UnitTestCase::class)
    ->group('unit', 'action', 'user', 'show');

beforeEach(function (){
   $this->repository = Mockery::mock(UserRepositoryInterface::class);
   $this->action = new ShowUserAction($this->repository);
});

test('user action success with show', function () {

    $user = User::factory()->withId(1)->make();

    $this->repository->expects('show')->andReturn($user);
    $response = $this->action->execute($user->id);

    expect($response)->toEqual($user);
});

