@extends('layout')

@section('body')
    <div class="flex justify-between items-center border-red-600 border-2 px-10">
        <div>
            <img src="{{asset('/images/2.png')}}" alt="logo" class="h-20">
        </div>
        <div class="flex items-center">
            <div>
                Ciao,&nbsp<span class="font-bold">{{Auth::user()->name}} {{Auth::user()->surname}}</span>
            </div>
            <a href="/logout" class="block ml-3 px-5 py-2 bg-red-600 text-white font-bold rounded">Log out</a>
        </div>
    </div>
    <div class="flex flex-col justify-center items-center">
        <div class="font-bold text-6xl pt-5">Docenti</div>
        <div class="pt-5">Aggiungi, modifica o elimina docenti</div>
    </div>
    <div class="flex justify-center pt-5">
        <div class="w-[90%] flex justify-end">
            <!-- Modal toggle -->
            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Aggiungi docente
            </button>
        </div>
    </div>
    <div class="flex justify-center pt-5">
        <div class="w-[90%] p-10 bg-white rounded-3xl">
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="w-[15%] pr-2 py-2 text-left">COGNOME</th>
                        <th class="w-[15%] pr-2 text-left">NOME</th>
                        <th class="w-[15%] pr-2 text-left">EMAIL</th>
                        <th class="w-[15%] pr-2 text-left">MATERIA</th>
                        <th class="w-[15%] pr-2 text-left">OPZIONI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr class="border-b-2 border-black">
                            <form action="/teacher-section/update/{{ $teacher['id'] }}" method="POST">
                                @csrf
                                <td class="pr-2 pt-2 pb-4">
                                    <input id="surname-{{ $teacher['id'] }}" type="text" name="surname"
                                        value="{{ $teacher['surname'] }}"
                                        class="w-full">
                                </td>
                                <td class="pr-2 pt-2 pb-4">
                                    <input id="name-{{ $teacher['id'] }}" type="text" name="name"
                                        value="{{ $teacher['name'] }}"
                                        class="w-full">
                                </td>
                                <td class="pr-2 pt-2 pb-4">
                                    <input id="email-{{ $teacher['id'] }}" type="text" name="email"
                                        value="{{ $teacher['email'] }}"
                                        class="w-full">
                                </td>
                                <td class="pr-2 pt-2 pb-4">
                                    <input id="materia-{{ $teacher['id'] }}" type="text" name="materia"
                                        value="{{ $teacher['materia'] }}"
                                        class="w-full">
                                </td>
                                <td class="pt-2 pb-4">
                                    {{-- id="b-{{ $guest['id'] }}" --}}
                                    <input type="submit" value="CONFERMA"
                                        class="btn-submit px-4 py-2 rounded-full bg-green-600 text-white cursor-pointer">
                                    <a href="/teacher-section/delete/{{ $teacher['id'] }}"
                                        class="btn-submit px-4 py-2 rounded-full text-white bg-red-600">
                                        ELIMINA
                                    </a>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Aggiungi nuovo docente</h3>
                    <form class="space-y-6" action="/teacher-section/create" method="POST">
                        @csrf
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                            <input type="text" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>
                        <div>
                            <label for="surname"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cognome</label>
                            <input type="text" name="surname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>
                        <div>
                            <label for="materia"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Materia</label>
                            <input type="text" name="materia"
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

    <script>
        $('select[name="role"]').on('change', function() {
            let id = this.id.match(/\d+/)[0];
            if (this.value == "teacher") {
                $('#materia-' + id).removeClass('hidden');
                $('#materia-' + id).val('');
            } else {
                $('#materia-' + id).addClass('hidden');
                $('#materia-' + id).val('niente');
            }
        });
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        // $('.btn-submit').on('click', function(e) {
        //     e.preventDefault();
        //     var id = e.currentTarget.id.match(/\d+/)[0];
        //     let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //     $.ajax({
        //         type: 'POST',
        //         url: '/coordinator/updaterole/' + id,
        //         data: {
        //             _token: CSRF_TOKEN,
        //             name: $("#name-" + id).val(),
        //             surname: $("#surname-" + id).val(),
        //             email: $("#email-" + id).val(),
        //             role: $("#role-" + id).val(),
        //         },
        //         success: function(data) {
        //             console.log(data);
        //         }
        //     });
        // });
    </script>
@endsection
