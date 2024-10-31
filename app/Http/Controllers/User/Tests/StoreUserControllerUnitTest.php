<?php

use App\Actions\User\StoreUserAction;
use App\DTO\User\UserDTO;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\UnitTestCase;
use function Pest\Laravel\post;

uses(UnitTestCase::class)
    ->group('unit', 'controller', 'user', 'store');

beforeEach(function (){
   $this->action = Mockery::mock(StoreUserAction::class);
   $this->app->instance(StoreUserAction::class, $this->action);
});

test('POST /users/: 201', function (){

    $user = User::factory()->withId(1)->make();

    $userDTO = new UserDTO([
        'name' => $user->name,
        'email' => $user->email,
        'age' => $user->age,
    ]);

    $this->action->expects('execute')->with(Mockery::mustBe($userDTO))->andReturn($user);

    post('api/users/',
        [
            'name' => $user->name,
            'email' => $user->email,
            'age' => $user->age,
        ]
    )->assertCreated()
        ->assertJson([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'age' => $user->age,
            ]
        ]);
});

test('POST /users/: 422', function (array $request){

    $this->action->expects('execute')->never();

    post('api/users/', $request)->assertStatus(422);

})->with([
        'empty data' => [
            []
        ],
        'empty name' => [
            [
                'email' => fake()->safeEmail(),
                'age' => fake()->numberBetween(1,200),
            ]
        ],
        'empty email' => [
            [
                'name' => fake()->name(),
                'age' => fake()->numberBetween(1,200),
            ]
        ],
        'empty age' => [
            [
                'name' => fake()->name(),
                'email' => fake()->safeEmail(),
            ]
        ],
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



