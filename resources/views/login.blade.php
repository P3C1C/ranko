@extends('layout')

@section('body')
    <div class="flex justify-center items-center w-1/2 h-screen border-2 border-red-600">
        <form action="/login" method="POST" class="h-auto">
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
    </div>
    <div class="absolute bottom-0 right-0 w-1/2 aspect-square bg-red border-[50px] rounded-full border-red-600">
        <img src="{{ asset('/assets/logo/logo.gif')}}" alt="">
    </div>
@endsection
