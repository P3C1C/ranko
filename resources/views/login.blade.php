@extends('layout')

@section('body')
    <h1 class="text-7xl font-bold text-violet-700">
        RANKO
    </h1>
    <form action="/login" method="POST">
        @csrf
        <input type="text" name="email" class="bg-gray-300 rounded-3xl px-3 py-1">
        @error('email')
            {{ $message }}
        @enderror
        <input type="password" name="password" class="bg-gray-300 rounded-3xl px-3 py-1">

        <input type="submit" value="Accedi" class="bg-gray-300 rounded-3xl px-3 py-1 font-bold">
    </form>
    <a href="/register">registrati</a>
@endsection
