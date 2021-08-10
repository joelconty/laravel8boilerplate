<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_current_profile_information_is_available()
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(UpdateProfileInformationForm::class);

        $this->assertEquals($user->username, $component->state['username']);
        $this->assertEquals($user->firstname, $component->state['firstname']);
        $this->assertEquals($user->lastname, $component->state['lastname']);
        $this->assertEquals($user->email, $component->state['email']);
    }

    public function test_profile_information_can_be_updated()
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdateProfileInformationForm::class)
                ->set('state', [
                    'username' => 'Test Name',
                    'firstname' => 'John',
                    'lastname' => 'Doe',
                    'email' => 'test@example.com'
                ])
                ->call('updateProfileInformation');

        $this->assertEquals('Test Name', $user->fresh()->username);
        $this->assertEquals('John', $user->fresh()->firstname);
        $this->assertEquals('Doe', $user->fresh()->lastname);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }
}
