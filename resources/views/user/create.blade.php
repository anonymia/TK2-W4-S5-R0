@extends('layouts.default')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('user.create') }}">
        @csrf

        <div>
            <x-label for="name" :value="__('Nama')" />
            <x-input id="name" class="block mt-1 w-1/2" type="text" name="name" required />
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="place_of_birth" :value="__('Tempat Lahir')" />
            <x-input id="place_of_birth" class="block mt-1 w-1/2" type="text" name="place_of_birth" required />
            @error('place_of_birth') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="date_of_birth" :value="__('Tanggal Lahir')" />
            <x-input id="date_of_birth" class="block mt-1 w-1/2" type="date" name="date_of_birth" required />
            @error('date_of_birth') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="gender" :value="__('Jenis Kelamin')" />
            <x-input id="gender" class="mt-1" value="0" type="radio" name="gender" required />Laki-Laki
            <x-input id="gender" class="mt-1" value="1" type="radio" name="gender" required />Perempuan
            @error('gender') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="password" :value="__('Password')" />
            <x-input id="password" class="block mt-1 w-1/2" type="password" name="password" required />
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="repeat_password" :value="__('Retype password')" />
            <x-input id="repeat_password" class="block mt-1 w-1/2" type="password" name="repeat_password" required />
            @error('repeat_password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="email" :value="__('Email')" />
            <x-input id="email" class="block mt-1 w-1/2" type="email" name="email" required />
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-6">
            <x-button class="ml-3">
                {{ __('Create') }}
            </x-button>
        </div>
    </form>
@endsection
