@extends('layout')

@section('body')
    <form action="/register" method="POST" class="w-1/3 ml-20 mt-64 h-auto">
        <h1 class="text-7xl font-bold text-[#0083C9]">
            RANKO
        </h1>
        @csrf
        <div class="flex flex-col mt-6">
            <label>NOME</label>
            <input type="text" name="name" class="rounded-3xl px-3 py-1 outline-none mt-2">
        </div>
        @error('name')
            {{ $message }}
        @enderror
        <div class="flex flex-col mt-6">
            <label>COGNOME</label>
            <input type="text" name="surname" class="rounded-3xl px-3 py-1 outline-none mt-2">
        </div>
        @error('surname')
            {{ $message }}
        @enderror
        <div class="flex flex-col mt-6">
            <label>EMAIL</label>
            <input type="text" name="email" class="rounded-3xl px-3 py-1 outline-none mt-2">
        </div>
        @error('email')
            {{ $message }}
        @enderror
        <div class="flex flex-col mt-4">
            <label>PASSWORD</label>
            <input type="password" name="password" class="rounded-3xl px-3 py-1 outline-none mt-2">
        </div>
        <div class="flex gap-2 flex-col md:flex-row mt-12">
            <input type="submit" value="REGISTRATI" class="bg-[#004266] rounded-full px-20 py-4 text-white">
            <a href="/login" class="bg-[#ccedff] rounded-full px-20 py-4">LOG IN</a>
        </div>
    </form>
    {{-- <select name="role" class="border-2 p-1 border-red-700 rounded-md h-12">
            <option value="coordinator">Coordinatore</option>
            <option value="guest">guest</option>
        </select>
        @error('role')
            {{ $message }}
        @enderror --}}
@endsection
