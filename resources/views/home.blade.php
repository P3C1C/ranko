@extends('layout')

@section('body')
<div class="flex justify-between">
    <div><img src="{{asset('/images/2.png')}}" alt="logo" class="h-20"></div>
    <div class="flex">
        <div class="flex">ciao, <div class="font-bold">{{Auth::user()->name}} {{Auth::user()->surname}}</div></div>
        <a href="/logout">log out</a>
    </div>
</div>
    {{-- <select id="multiple-select" multiple multiselect-search="true" style="width: 500px">
        <option value="1">Books</option>
        <option value="2">Movies, Music & Games</option>
        <option value="3">Electronics & Computers</option>
        <option value="4">Home, Garden & Tools</option>
        <option value="5">Health & Beauty</option>
        <option value="6">Toys, Kids & Baby</option>
        <option value="7">Clothing & Jewelry</option>
        <option value="8">Sports & Outdoors</option>
    </select> --}}
    @if (Auth::user()->role == 'coordinator')
        <a href="/guest-section" class="p-11">Ospiti</a>
        <a href="#" class="p-11">Classi</a>
        <a href="#" class="p-11">Studenti</a>
        <a href="#" class="p-11">Docenti</a>
    @elseif (Auth::user()->role == 'teacher')
        <h1>prova</h1>
    @elseif (Auth::user()->role == 'student')
        <h1>student</h1>
    @else
        <h1 class="text-7xl font-bold text-violet-700">
            Sei in attesa che il cordinatore ti dia un ruolo
        </h1>
    @endif
@endsection
