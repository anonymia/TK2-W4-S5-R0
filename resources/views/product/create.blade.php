@extends('layouts.default')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('product.create') }}">
        @csrf

        <div>
            <x-label for="name" :value="__('Produk')" />
            <x-input id="name" class="block mt-1 w-1/2" type="text" name="name" required />
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="description" :value="__('Deskripsi')" />
            <x-input id="description" class="block mt-1 w-1/2" type="text" name="description" required />
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="buying_price" :value="__('Harga Beli')" />
            <x-input id="buying_price" class="block mt-1 w-1/2" type="number" name="buying_price" required />
            @error('buying_price') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="selling_price" :value="__('Harga Jual')" />
            <x-input id="selling_price" class="block mt-1 w-1/2" type="number" name="selling_price" required />
            @error('selling_price') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="picture" :value="__('Gambar')" />
            <x-input id="picture" class="block mt-1 w-1/2" type="file" accept="image/*" name="picture" required />
            @error('picture') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-6">
            <x-button class="ml-3">
                {{ __('Create') }}
            </x-button>
        </div>
    </form>
@endsection
