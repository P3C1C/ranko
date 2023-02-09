@extends('layout')

@section('body')
    <table class="table-auto border border-collapse border-slate-500">
        <thead>
            <tr class="bg-slate-500">
                <th class="border border-slate-600 px-10 py-2">Nome</th>
                <th class="border border-slate-600 px-10">Cognome</th>
                <th class="border border-slate-600 px-10">Email</th>
                <th class="border border-slate-600 px-10">role</th>
                <th class="border border-slate-600 px-10">opzioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($guests as $guest)
                <tr class="bg-slate-300">
                    <form action="/guest-section/updaterole/{{ $guest['id'] }}" method="POST">
                        @csrf
                        <td class="border border-slate-600 py-2">
                            <input id="name-{{ $guest['id'] }}" type="text" name="name" value="{{ $guest['name'] }}">
                        </td>
                        <td class="border border-slate-600">
                            <input id="surname-{{ $guest['id'] }}" type="text" name="surname" value="{{ $guest['surname'] }}">
                        </td>
                        <td class="border border-slate-600">
                            <input id="email-{{ $guest['id'] }}" type="text" name="email" value="{{ $guest['email'] }}">
                        </td>
                        <td class="border border-slate-600">
                            <select name="role" id="role-{{ $guest['id'] }}">
                                <option value="guest" {{ $guest['role'] == 'guest' ? 'select' : '' }}>Guest</option>
                                <option value="teacher" {{ $guest['role'] == 'teacher' ? 'select' : '' }}>Teacher</option>
                                <option value="student" {{ $guest['role'] == 'student' ? 'select' : '' }}>Student</option>
                            </select>
                            <input id="materia-{{ $guest['id'] }}" name="materia" class="hidden" type="text" value="niente">
                        </td>
                        <td>
                            {{-- id="b-{{ $guest['id'] }}" --}}
                            <input type="submit" value="Conferma"
                                class="btn-submit bg-red-600 p-1 rounded-full hover:bg-red-500">
                        </td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
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
