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
        <div class="font-bold text-6xl pt-5">Ospiti</div>
        <div class="pt-5">Assegna ruoli e registra gli ospiti</div>
    </div>
    <div class="flex justify-center pt-20">
        <div class="w-[90%] p-10 bg-white rounded-3xl">
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="w-[15%] pr-2 py-2 text-left">COGNOME</th>
                        <th class="w-[15%] pr-2 text-left">NOME</th>
                        <th class="w-[20%] pr-2 text-left">EMAIL</th>
                        <th class="w-[30%] pr-2 text-left">RUOLO</th>
                        <th class="w-[20%] pr-2 text-left">OPZIONI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guests as $guest)
                        <tr class="border-b-2 border-black">
                            <form action="/guest-section/updaterole/{{ $guest['id'] }}" method="POST">
                                @csrf
                                <td class="pr-2 pt-2 pb-4">
                                    <input id="surname-{{ $guest['id'] }}" type="text" name="surname"
                                        value="{{ $guest['surname'] }}"
                                        class="w-full">
                                </td>
                                <td class="pr-2 pt-2 pb-4">
                                    <input id="name-{{ $guest['id'] }}" type="text" name="name"
                                        value="{{ $guest['name'] }}"
                                        class="w-full">
                                </td>
                                <td class="pr-2 pt-2 pb-4">
                                    <input id="email-{{ $guest['id'] }}" type="text" name="email"
                                        value="{{ $guest['email'] }}"
                                        class="w-full">
                                </td>
                                <td class="pr-2 pt-2 pb-4">
                                    <select name="role" id="role-{{ $guest['id'] }}">
                                        <option value="guest" {{ $guest['role'] == 'guest' ? 'select' : '' }}>Ospite</option>
                                        <option value="teacher" {{ $guest['role'] == 'teacher' ? 'select' : '' }}>Docente</option>
                                        <option value="student" {{ $guest['role'] == 'student' ? 'select' : '' }}>Studente</option>
                                    </select>
                                    <input id="materia-{{ $guest['id'] }}" name="materia" type="text" placeholder="Materia" class="hidden bg-[#e5f6ff] text-center rounded">
                                </td>
                                <td class="pt-2 pb-4">
                                    {{-- id="b-{{ $guest['id'] }}" --}}
                                    <input type="submit" value="REGISTRA"
                                        class="btn-submit px-4 py-2 rounded-full bg-green-600 text-white cursor-pointer">
                                    <a href="/guest-section/delete/{{ $guest['id'] }}"
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
