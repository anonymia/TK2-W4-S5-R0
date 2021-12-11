@extends('layouts.default')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="/user/{{ $user->id }}">
        @csrf
        {{ method_field('PUT') }}

        <div>
            <x-label for="name" :value="__('Nama')" />
            <x-input id="name" class="block mt-1 w-1/2" type="text" name="name" value="{{ $user->name }}" />
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="place_of_birth" :value="__('Tempat Lahir')" />
            <x-input id="place_of_birth" class="block mt-1 w-1/2" type="text" name="place_of_birth" value="{{ $user->place_of_birth }}" />
            @error('place_of_birth') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="date_of_birth" :value="__('Tanggal Lahir')" />
            <x-input id="date_of_birth" class="block mt-1 w-1/2" type="date" name="date_of_birth" value="{{ $user->date_of_birth }}" />
            @error('date_of_birth') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="gender" :value="__('Jenis Kelamin')" />
            <input id="gender" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1" value="0" type="radio" name="gender" {{ $user->gender == '0' ? 'checked' : '' }} />Laki-Laki
            <input id="gender" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1" value="1" type="radio" name="gender" {{ $user->gender == '1' ? 'checked' : '' }} />Perempuan
            @error('gender') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="password" :value="__('Password')" />
            <x-input id="password" class="block mt-1 w-1/2" type="password" name="password" />
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="repeat_password" :value="__('Retype password')" />
            <x-input id="repeat_password" class="block mt-1 w-1/2" type="password" name="repeat_password" />
            @error('repeat_password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="email" :value="__('Email')" />
            <x-input id="email" class="block mt-1 w-1/2" type="email" name="email" value="{{ $user->email }}" />
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-6">
            <x-button class="ml-3">
                {{ __('Update') }}
            </x-button>
        </div>
    </form>
@endsection
