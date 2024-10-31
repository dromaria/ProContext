<?php

use App\Actions\User\IndexUserAction;
use App\DTO\Pagination\PaginationDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Tests\UnitTestCase;

uses(UnitTestCase::class)
    ->group('unit', 'action', 'user', 'index');

beforeEach(function (){
   $this->repository = Mockery::mock(UserRepositoryInterface::class);
   $this->action = new IndexUserAction($this->repository);
});

test('user action success with index', function () {

    $user = User::factory()->withId(1)->make();
    $paginationDTO = new PaginationDTO();

    $this->repository->expects('index')->with($paginationDTO)->andReturn(collect([$user]));
    $response = $this->action->execute($paginationDTO);

    expect($response)->toEqual(collect([$user]));
});

