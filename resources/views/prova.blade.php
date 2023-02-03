@extends('layout')

@section('body')
    <h1 class="text-7xl font-bold text-violet-700">
        RANKO con prova
    </h1>
    {{ $user }}

    <label>
        Multi-select
        <input mbsc-input id="my-input" data-dropdown="true" data-tags="true" />
    </label>
    <select id="multiple-select" multiple multiselect-search="true" style="width: 500px">
        <option value="1">Books</option>
        <option value="2">Movies, Music & Games</option>
        <option value="3">Electronics & Computers</option>
        <option value="4">Home, Garden & Tools</option>
        <option value="5">Health & Beauty</option>
        <option value="6">Toys, Kids & Baby</option>
        <option value="7">Clothing & Jewelry</option>
        <option value="8">Sports & Outdoors</option>
    </select>
@endsection
