<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(RouteServiceProvider::HOME, navigate: true);
};

?>

<div>
    <form wire:submit="register">
        
        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- role -->
        <div>
            <x-text-input wire:model="role" id="role" class="block mt-1 w-full" type="hidden" value='role' name="role" required autofocus autocomplete="role" />
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>
        <!-- premission_status -->
        <div>
            <x-text-input wire:model="premission_status" id="premission_status" class="block mt-1 w-full" type="hidden" value='inactive' name="premission_status" required autofocus autocomplete="premission_status" />
            <x-input-error :messages="$errors->get('premission_status')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input wire:model="nom" id="nom" class="block mt-1 w-full" type="text" name="nom" required autofocus autocomplete="nom" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- prenom -->
        <div>
            <x-input-label for="prenom" :value="__('prenom')" />
            <x-text-input wire:model="prenom" id="prenom" class="block mt-1 w-full" type="text" name="prenom" required autofocus autocomplete="prenom" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>
        <!-- tel -->
        <div>
            <x-input-label for="tel" :value="__('tel')" />
            <x-text-input wire:model="tel" id="tel" class="block mt-1 w-full" type="text" name="tel" required autofocus autocomplete="tel" />
            <x-input-error :messages="$errors->get('tel')" class="mt-2" />
        </div>
        <!-- adresse -->
        <div>
            <x-input-label for="adresse" :value="__('adresse')" />
            <x-text-input wire:model="adresse" id="adresse" class="block mt-1 w-full" type="text" name="adresse" required autofocus autocomplete="adresse" />
            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
        </div>
        <!-- diplome -->
        <div>
            <x-input-label for="diplome" :value="__('diplome')" />
            <x-text-input wire:model="diplome" id="diplome" class="block mt-1 w-full" type="text" name="diplome" required autofocus autocomplete="diplome" />
            <x-input-error :messages="$errors->get('diplome')" class="mt-2" />
        </div>
        <!-- depertement -->
        <div>
            <x-input-label for="dep_id" :value="__('depertement')" />
            <x-text-input wire:model="dep_id" id="diplome" class="block mt-1 w-full" type="text" name="dep_id" required autofocus autocomplete="dep_id" />
            {{-- {!! Form::select('categorie_id', App\Models\Departements::pluck('nom', 'dep_id'), null, ['class' => 'form-control select', 'placeholder' => '-- Choose category --', 'dep_id' => 'dep_id', 'required']) !!}
            <x-input-error :messages="$errors->get('dep_id')" class="mt-2" />
        </div> --}}



        

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
