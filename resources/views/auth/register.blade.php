@extends('client.layouts.app')
@section('title', 'Register')
@section('content')
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />

            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Mobile No')" />

            <x-text-input id="phone" class="block mt-1 w-full" type="numeric" name="phone" :value="old('phone')"
                required />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />

            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                required />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Gender')" />
            <div class="mt-4">
                {{-- <select name="gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="fe-male">Female</option>
                    </select> --}}
                <input type="radio" id="gender" name="gender" value="male">
                <label for="male">Male</label>
                <input type="radio" id="gender" name="gender" value="fe-male">
                <label for="fe-male">Female</label>
                <input type="radio" id="gender" name="gender" value="unspecified">
                <label for="unspecified">Unspecified</label><br>
            </div>
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
                required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
@endsection
