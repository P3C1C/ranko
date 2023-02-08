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
                    <td class="border border-slate-600 py-2">
                        <input id="name-{{ $guest['id'] }}" type="text" value="{{ $guest['name'] }}">
                    </td>
                    <td class="border border-slate-600">
                        <input id="surname-{{ $guest['id'] }}" type="text" value="{{ $guest['surname'] }}">
                    </td>
                    <td class="border border-slate-600">
                        <input id="email-{{ $guest['id'] }}" type="text" value="{{ $guest['email'] }}">
                    </td>
                    <td class="border border-slate-600">
                        <select name="role" id="role-{{ $guest['id'] }}">
                            <option value="guest" {{ $guest['role'] == 'guest' ? 'select' : '' }}>Guest</option>
                            <option value="teacher" {{ $guest['role'] == 'teacher' ? 'select' : '' }}>Teacher</option>
                            <option value="student" {{ $guest['role'] == 'student' ? 'select' : '' }}>Student</option>
                        </select>
                    </td>
                    <td>
                        <input id="b-{{ $guest['id'] }}" onclick="update(this)" type="button" value="Conferma"
                            class="bg-red-600 p-1 rounded-full hover:bg-red-500">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
<script>
    function update(_self) {
        let id = _self['id'].match(/\d+/)[0];
        let data = '{"name":"' + $("#name-" + id).val() + '","surname":"' + $("#surname-" + id).val() + '","email":"' +
            $("#email-" + id).val() + '","role":"' + $("#role-" + id).val() + '",}';
        console.log(data);
        $.ajax({
            type: 'POST',
            url: 'updaterole',
            data: data,
            success: function() {
                console.log('success');
            }
        });
    };
</script>
