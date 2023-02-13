@extends('layout')

@section('body')
    <!-- Modal toggle -->
    <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        Toggle modal
    </button>

    @foreach ($groups as $group)
        <a href="/class-section/{{ $group['id'] }}/class">
            <div class="bg-white w-64 h-64 relative">
                <div>{{ $group['nome'] }}</div>
                <div>{{ $group['corso'] }}</div>
                <a href="/class-section/delete/{{ $group['id'] }}" class="absolute right-0 bottom-0 bg-red-600">delete</a>
            </div>
        </a>
    @endforeach

    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Crea nuova classe</h3>
                    <form class="space-y-6" action="/class-section/create" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome
                                classe</label>
                            <input type="text" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>
                        <div>
                            <label for="corso" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Corso
                                d'appartenenza</label>
                            <select name="course_ex">
                                @foreach ($courses as $course)
                                    <option value="{{ $course['id'] }}">{{ $course['nome'] }}</option>
                                @endforeach
                                <option value="0">Other</option>
                            </select>
                            <input type="text" name="course"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        </div>
                        <div>
                            <label for="docenti"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleziona i
                                docenti</label>
                            <select id="teacher" multiple multiselect-search="true" multiselect-max-items="3">
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher['id'] }}">{{ $teacher['name'] }} {{ $teacher['surname'] }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="teacher">
                        </div>
                        <div>
                            <label for="studenti"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleziona gli
                                studenti</label>
                            <select id="student" multiple multiselect-search="true" multiselect-max-items="3">
                                @foreach ($students as $student)
                                    <option value="{{ $student['id'] }}">{{ $student['name'] }} {{ $student['surname'] }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="student">
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
        $('#student').on('change', function() {
            $('input[name="student"]').val($('#student').val().toString());
        });
        $('#teacher').on('change', function() {
            $('input[name="teacher"]').val($('#teacher').val().toString());
        });
    </script>
@endsection
