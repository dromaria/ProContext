<?php

use App\Actions\User\UpdateUserAction;
use App\DTO\User\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Tests\UnitTestCase;
use function Pest\Laravel\put;

uses(UnitTestCase::class)
    ->group('unit', 'controller', 'user', 'update');

beforeEach(function (){
   $this->action = Mockery::mock(UpdateUserAction::class);
   $this->app->instance(UpdateUserAction::class, $this->action);
});

test('PUT /users/{id}: 200', function (){

    $user = User::factory()->withId(1)->make();

    $userDTO = new UserDTO([
        'name' => $user->name,
        'email' => $user->email,
        'age' => $user->age,
    ]);

    $this->action->expects('execute')->with($user->id, Mockery::mustBe($userDTO))->andReturn($user);

    put('api/users/'.$user->id,
        [
            'name' => $user->name,
            'email' => $user->email,
            'age' => $user->age,
        ]
    )->assertOk()
        ->assertJson([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'age' => $user->age,
            ]
        ]);
});

test('PUT /users/{id}: 404', function (){

    $this->action->expects('execute')->andThrow(ModelNotFoundException::class);;

    put('api/users/1')
        ->assertStatus(404);
});

test('PUT /users/{id}: 422', function (array $request){


    $this->action->expects('execute')->never();

    put('api/users/1', $request)->assertStatus(422);

})->with([
        'invalid name' => [
            [
                'name' => Str::random(256),
                'email' => fake()->safeEmail(),
                'age' => fake()->numberBetween(1,200),
            ]
        ],
        'invalid email' => [
            [
                'name' => fake()->name(),
                'email' => fake()->word,
                'age' => fake()->numberBetween(1,200),
            ]
        ],
        'invalid age' => [
            [
                'name' => fake()->name(),
                'email' => fake()->word,
                'age' => 0,
            ]
        ],
    ]
);






