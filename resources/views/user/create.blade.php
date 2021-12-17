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
            <x-label for="email" :value="__('Email')" />
            <x-input id="email" class="block mt-1 w-1/2" type="email" name="email" required />
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="password" :value="__('Password')" />
            <x-input id="password" class="block mt-1 w-1/2" type="password" name="password" required autocomplete="new-password" />
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Retype password')" />
            <x-input id="password_confirmation" class="block mt-1 w-1/2" type="password" name="password_confirmation" required />
            @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
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
            <x-label for="role" :value="__('Kategori')" />
            <select id="role" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1" name="role" required>
                <option value="admin" selected>Admin</option>
                <option value="user">User</option>
            </select>
            @error('role') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-6">
            <x-button class="ml-3">
                {{ __('Create') }}
            </x-button>
        </div>
    </form>
@endsection
