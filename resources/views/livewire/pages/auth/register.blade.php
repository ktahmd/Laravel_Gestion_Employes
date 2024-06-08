<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>registre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

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
    'password' => '',
    'password_confirmation' => ''
]);

rules([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'diplome' => ['required', 'string', 'max:255'],
            'specialite' => ['required', 'string', 'max:255'],
            'dep_id' => ['required', 'exists:departements,id'],
            'image' => ['image', 'max:2048'],
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
    <form action="{{ route('register.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Username -->
        
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <div class="input-group">
                <span class=" block mt-1 input-group-text" id="inputGroupPrepend2">@</span>
                <x-text-input wire:model="username" id="username" class="block mt-1 form-control" type="text" name="username" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                
              </div>
            
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 form-control" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- role -->
        <div >
            <x-text-input wire:model="role" id="role" class="block mt-1 form-control" type="hidden" value='role' name="role" required autofocus autocomplete="role" />
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>
        <!-- premission_status -->
        <div>
            <x-text-input wire:model="premission_status" id="premission_status" class="block mt-1 form-control" type="hidden" value='inactive' name="premission_status" required autofocus autocomplete="premission_status" />
            <x-input-error :messages="$errors->get('premission_status')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input wire:model="nom" id="nom" class="block mt-1 form-control" type="text" name="nom" required autofocus autocomplete="nom" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- prenom -->
        <div class="mt-4">
            <x-input-label for="prenom" :value="__('prenom')" />
            <x-text-input wire:model="prenom" id="prenom" class="block mt-1 form-control" type="text" name="prenom" required autofocus autocomplete="prenom" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>
        {{-- img --}}
        <div class="mt-4">
            <x-input-label for="image" :value="__('Choisir une image:')" />
            <input id="image" type="file" name="image" class="block mt-1 w-full form-control" >

        </div>
        
        <!-- tel -->
        <div class="mt-4">
            <x-input-label for="tel" :value="__('tel')" />
            <x-text-input wire:model="tel" id="tel" class="block mt-1 form-control" type="text" name="tel" required autofocus autocomplete="tel" />
            <x-input-error :messages="$errors->get('tel')" class="mt-2" />
        </div>
        <!-- adresse -->
        <div class="mt-4">
            <x-input-label for="adresse" :value="__('adresse')" />
            <x-text-input wire:model="adresse" id="adresse" class="block mt-1 form-control" type="text" name="adresse" required autofocus autocomplete="adresse" />
            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
        </div>
        <!-- diplome -->
        <div class="mt-4"> 
            <x-input-label for="diplome" :value="__('diplome')" />
            <x-text-input wire:model="diplome" id="diplome" class="block mt-1 form-control" type="text" name="diplome" required autofocus autocomplete="diplome" />
            <x-input-error :messages="$errors->get('diplome')" class="mt-2" />
        </div>
         <!-- diplome -->
         <div class="mt-4"> 
            <x-input-label for="specialite" :value="__('specialite')" />
            <x-text-input wire:model="specialite" id="specialite" class="block mt-1 form-control" type="text" name="specialite" required autofocus autocomplete="specialite" />
            <x-input-error :messages="$errors->get('specialite')" class="mt-2" />
        </div>
        <!-- depertement -->
        <div class="mt-4">
            <x-input-label for="dep_id" :value="__('depertement')" />
            
            {!! Form::select(
                'dep_id', 
                App\Models\Departements::pluck('nom', 'id'), 
                null, 
                [
                    'class' => 'block mt-1 form-select', 
                    'placeholder' => '-- Choisir Departement --', 
                    'id' => 'dep_id', 
                    'required', 
                    
                ]
            ) !!}
            
            <x-input-error :messages="$errors->get('dep_id')" class="mt-2" />
        </div>



        

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 form-control"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 form-control"
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
    
</body>
</html>
