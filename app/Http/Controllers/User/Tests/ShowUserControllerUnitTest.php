<?php

use App\Actions\User\ShowUserAction;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\UnitTestCase;
use function Pest\Laravel\get;

uses(UnitTestCase::class)
    ->group('unit', 'controller', 'user', 'show');

beforeEach(function (){
   $this->action = Mockery::mock(ShowUserAction::class);
   $this->app->instance(ShowUserAction::class, $this->action);
});

test('GET /users/{id}: 200', function (){

    $user = User::factory()->withId(1)->make();

    $this->action->expects('execute')->with($user->id)->andReturn($user);

    get('api/users/'.$user->id)
        ->assertOk()
        ->assertJson([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'age' => $user->age,
            ]
        ]);
});

test('GET /users/{id}: 404', function (){

    $this->action->expects('execute')->andThrow(ModelNotFoundException::class);;

    get('api/users/1')
        ->assertStatus(404);
});





