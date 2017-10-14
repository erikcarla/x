<?php
namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;

use App\Models\User;
use App\Models\Guest;
use Auth;

class ActivateControllerTest extends \AbControllerTest
{
    public function test_index()
    {
        $guest = factory(Guest::class)->create();

        $path = route('activate', ['token' => $guest->token]);
        $response = $this->call('GET', $path);

        $response->assertStatus(200);
        $response->assertViewHas('token');
        $this->assertEquals('auth.activation', $response->original->getName());
    }

    public function test_index_when_invalid_token()
    {
        $path = route('activate', ['token' => 'invalid']);
        $response = $this->call('GET', $path);

        $response->assertRedirect('/');
    }

    public function test_store()
    {
        $guest = factory(Guest::class)->create();
        $validInput = [];
        $validInput['password'] = $validInput['password_confirmation'] = str_random(10);
        $validInput['token'] = $guest->token;

        $path = route('activate.store');
        $response = $this->call('POST', $path, $validInput);

        $user = User::where('name', $guest->name)->first();
        $guestShouldBeDeleted = Guest::find($guest->id);
        $this->assertNotNull($user);
        $this->assertNull($guestShouldBeDeleted);
        $response->assertRedirect('/');
    }

    public function test_store_when_token_is_invalid()
    {
        $validInput['password'] = $validInput['password_confirmation'] = str_random(10);
        $validInput['token'] = rand();

        Auth::shouldReceive('login')->never();
        Auth::shouldIgnoreMissing();

        $path = route('activate.store');
        $response = $this->call('POST', $path, $validInput);

        $response->assertRedirect('/');
    }
}
