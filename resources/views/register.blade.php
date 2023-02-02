@extends('layout')

@section('body')
<h1 class="ml-20 my-10 text-4xl font-bold text-red-700">Registrazione</h1>
<form action="/register" method="POST" class="flex flex-col gap-2 w-52 ml-20">
    @csrf
    <input type="text" name="name" placeholder="Nome" value="{{ old('name') }}" class="border-2 p-1 border-red-700 rounded-md h-12">
    @error('name')
        {{ $message }}
    @enderror
    <input type="text" name="surname" placeholder="surname" value="{{ old('name') }}" class="border-2 p-1 border-red-700 rounded-md h-12">
    @error('surname')
        {{ $message }}
    @enderror
    <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" class="border-2 p-1 border-red-700 rounded-md h-12">
    @error('email')
        {{ $message }}
    @enderror
    <input type="password" name="password" placeholder="Password" class="border-2 p-1 border-red-700 rounded-md h-12">
    <input type="password" name="password_confirmation" placeholder="Conferma Password" class="border-2 p-1 border-red-700 rounded-md h-12">
    <input type="submit" value="Rester-in" class="hover:bg-red-600 p-3 bg-red-500 rounded text-white">
    <a href="/login" class="p-3 rounded">login</a>
</form>
@endsection
