@extends('layout')

@section('body')
    <table class="table-auto border border-collapse border-slate-500">
        <thead>
            <tr class="bg-slate-500">
                <th class="border border-slate-600 px-10 py-2">Nome</th>
                <th class="border border-slate-600 px-10">Cognome</th>
                <th class="border border-slate-600 px-10">Email</th>
                <th class="border border-slate-600 px-10">1° valutazione</th>
                <th class="border border-slate-600 px-10">2° valutazione</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr class="bg-slate-300">
                    @csrf
                    <td class="border border-slate-600 py-2">
                        <input id="name-{{ $student['id'] }}" type="text" name="name" value="{{ $student['name'] }}">
                    </td>
                    <td class="border border-slate-600">
                        <input id="surname-{{ $student['id'] }}" type="text" name="surname"
                            value="{{ $student['surname'] }}">
                    </td>
                    <td class="border border-slate-600">
                        <input id="email-{{ $student['id'] }}" type="text" name="email"
                            value="{{ $student['email'] }}">
                    </td>
                    <td class="border border-slate-600">
                        Non inviata
                    </td>
                    <td class="border border-slate-600">
                        Non inviata
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal toggle -->
    <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        Pubblica Valutazione
    </button>

    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Crea nuova valutazione</h3>
                    <form class="space-y-6" action="/class-section/{{ $idgroup }}/create-request" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome
                                valutazione</label>
                            <input type="text" name="nome"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit"
                                class="w-1/2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Crea</button>
                            <button type="button"
                                class="w-1/2 bg-blue-100 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                data-modal-hide="authentication-modal">
                                Annulla
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
