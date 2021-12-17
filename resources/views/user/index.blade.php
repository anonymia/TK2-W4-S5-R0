@extends('layouts.default')

@section('content')
    <h1>Web Programming</h1>
    <h3>OS1 - 2112 - TICA - TK2-W4-S5-R0</h3>
    <br>
    <h2>Aplikasi Pendataan Produk - Team 2</h2>
    <br>

    <x-table>
        <x-slot name="header">
            <x-table-column>Nama</x-table-column>
            <x-table-column>TTL</x-table-column>
            <x-table-column>Jenis Kelamin</x-table-column>
            <x-table-column>Kategori</x-table-column>
            <x-table-column>Email</x-table-column>
            <x-table-column>Password Hash</x-table-column>
            @canany(['update', 'delete'])
            <x-table-column></x-table-column>
            @endcanany
        </x-slot>

        @foreach($users as $user)
            <tr>
                <x-table-column>{{ $user->name }}</x-table-column>
                <x-table-column>{{ $user->place_of_birth }}, {{ $user->date_of_birth }}</x-table-column>
                <x-table-column>{{ $user->gender == '0' ? 'Laki-Laki' : 'Perempuan' }}</x-table-column>
                <x-table-column>{{ $user->role == 'admin' ? 'Admin' : 'User' }}</x-table-column>
                <x-table-column>{{ $user->email }}</x-table-column>
                <x-table-column>{{ $user->password }}</x-table-column>
                @canany(['update', 'delete'])
                <x-table-column>
                    @can('update')
                    <form action="/user/{{ $user->id }}">
                        <div>
                            <x-button class="ml-3">
                                {{ __('Edit') }}
                            </x-button>
                        </div>
                    </form>
                    @endcan
                    @can('delete')
                    <form method="POST" action="/user/{{ $user->id }}">
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
    <form action="/user/create">
        <div class="mt-6">
            <x-button class="ml-3">
                {{ __('Create') }}
            </x-button>
        </div>
    </form>
    @endcan
@endsection
