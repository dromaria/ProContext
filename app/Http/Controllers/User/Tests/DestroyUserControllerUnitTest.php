<?php

use App\Actions\User\DestroyUserAction;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\UnitTestCase;
use function Pest\Laravel\delete;

uses(UnitTestCase::class)
    ->group('unit', 'controller', 'user', 'destroy');

beforeEach(function (){
   $this->action = Mockery::mock(DestroyUserAction::class);
   $this->app->instance(DestroyUserAction::class, $this->action);
});

test('DELETE /users/{id}: 204', function (){

    $user = User::factory()->withId(1)->make();

    $this->action->expects('execute')->with($user->id)->andReturn($user);

    delete('api/users/'.$user->id)
        ->assertNoContent();
});

test('DELETE /users/{id}: 404', function (){

    $this->action->expects('execute')->andThrow(ModelNotFoundException::class);;

    delete('api/users/1')
        ->assertStatus(404);
});





