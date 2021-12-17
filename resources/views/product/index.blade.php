@extends('layouts.default')

@section('content')
    <h1>Web Programming</h1>
    <h3>OS1 - 2112 - TICA - TK2-W4-S5-R0</h3>
    <br>
    <h2>Aplikasi Pendataan Produk - Team 2</h2>
    <br>

    <x-table>
        <x-slot name="header">
            <x-table-column>Produk</x-table-column>
            <x-table-column>Deskripsi</x-table-column>
            <x-table-column>Harga Beli</x-table-column>
            <x-table-column>Harga Jual</x-table-column>
            <x-table-column>Gambar</x-table-column>
            @canany(['update', 'delete'])
            <x-table-column></x-table-column>
            @endcanany
        </x-slot>

        @foreach($products as $product)
            <tr>
                <x-table-column>{{ $product->name }}</x-table-column>
                <x-table-column>{{ $product->description }}</x-table-column>
                <x-table-column>{{ $product->buying_price }}</x-table-column>
                <x-table-column>{{ $product->selling_price }}</x-table-column>
                <x-table-column><img style="width: 40vw;" src="{{ $product->picture }}"></x-table-column>
                @canany(['update', 'delete'])
                <x-table-column>
                    @can('update')
                    <form action="/product/{{ $product->id }}">
                        <div>
                            <x-button class="ml-3">
                                {{ __('Edit') }}
                            </x-button>
                        </div>
                    </form>
                    @endcan
                    @can('delete')
                    <form method="POST" action="/product/{{ $product->id }}">
                        @csrf
                        {{ method_field('DELETE') }}

                        <div class="mt-1">
                            <x-button class="ml-3">
                                {{ __('Delete') }}
                            </x-button>
                        </div>
                    </form>
                    @endcan
                </x-table-column>
                @endcanany
            </tr>
        @endforeach
    </x-table>

    @can('create')
    <form action="/product/create">
        <div class="mt-6">
            <x-button class="ml-3">
                {{ __('Create') }}
            </x-button>
        </div>
    </form>
    @endcan
@endsection
