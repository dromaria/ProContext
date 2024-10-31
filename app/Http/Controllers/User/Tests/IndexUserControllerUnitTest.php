<?php

use App\Actions\User\IndexUserAction;
use App\DTO\Pagination\PaginationDTO;
use App\Models\User;
use Tests\UnitTestCase;
use function Pest\Laravel\get;

uses(UnitTestCase::class)
    ->group('unit', 'controller', 'user', 'index');

beforeEach(function (){
   $this->action = Mockery::mock(IndexUserAction::class);
   $this->app->instance(IndexUserAction::class, $this->action);
});

test('GET /users/: 200', function (){

    $user = User::factory()->withId(1)->make();

    $paginationDTO = new PaginationDTO(['limit' => 10, 'page' => 1]);

    $this->action->expects('execute')->with(Mockery::mustBe($paginationDTO))->andReturn(collect([$user]));

    get('api/users/')
        ->assertOk()
        ->assertJson([
            'data' => [
                [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'age' => $user->age,
                ]
            ]
        ]);
});
