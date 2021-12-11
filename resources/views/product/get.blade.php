@extends('layouts.default')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="/product/{{ $product->id }}">
        @csrf
        {{ method_field('PUT') }}

        <div>
            <x-label for="name" :value="__('Produk')" />
            <x-input id="name" class="block mt-1 w-1/2" type="text" name="name" value="{{ $product->name }}" required />
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="description" :value="__('Deskripsi')" />
            <x-input id="description" class="block mt-1 w-1/2" type="text" name="description" value="{{ $product->description }}" required />
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="buying_price" :value="__('Harga Beli')" />
            <x-input id="buying_price" class="block mt-1 w-1/2" type="number" name="buying_price" value="{{ $product->buying_price }}" required />
            @error('buying_price') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="selling_price" :value="__('Harga Jual')" />
            <x-input id="selling_price" class="block mt-1 w-1/2" type="number" name="selling_price" value="{{ $product->selling_price }}" required />
            @error('selling_price') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="picture" :value="__('Gambar')" />
            <x-input id="picture" class="block mt-1 w-1/2" type="file" accept="image/*" name="picture" />
            @error('picture') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-6">
            <x-button class="ml-3">
                {{ __('Update') }}
            </x-button>
        </div>
    </form>
@endsection
