@extends('layout')

@section('body')
    <form action="/login" method="POST" class="w-1/3 ml-20 mt-64 h-auto">
        <h1 class="text-7xl font-bold text-[#0083C9]">
            RANKO
        </h1>
        @csrf
        <div class="flex flex-col mt-6">
            <label>NOME UTENTE</label>
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
            <input type="submit" value="ACCEDI" class="bg-[#004266] rounded-full px-20 py-4 text-white">
            <a href="/register" class="bg-[#ccedff] rounded-full px-20 py-4">REGISTRATI</a>
        </div>
    </form>
@endsection
