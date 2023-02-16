@extends('layout')

@section('body')
    <div class="flex justify-between items-center border-red-600 border-2 px-10">
        <div>
            <a href="/">
                <img src="{{asset('/images/2.png')}}" alt="logo" class="h-20">
            </a>
        </div>
        <div class="flex items-center">
            <div>
                Ciao,&nbsp<span class="font-bold">{{Auth::user()->name}} {{Auth::user()->surname}}</span>
            </div>
            <a href="/logout" class="block ml-3 px-5 py-2 bg-red-600 text-white font-bold rounded">LOG OUT</a>
        </div>
    </div>
     
    @if (Auth::user()->role == 'coordinator')
        <div class="flex flex-col justify-center items-center">
            <div class="font-bold text-6xl pt-5">Home</div>
            <div class="pt-5">Assegna il ruolo agli ospiti, crea o modifica le classi, i professori e gli studenti</div>
        </div>
        <div class="flex flex-col justify-center items-center pt-20">
            <div class="flex w-screen justify-center">
                <a href="/guest-section" class="flex justify-center items-center w-[20%] h-[10%] mr-5 py-10 bg-[#ccedff] rounded-3xl text-3xl font-bold">Ospiti</a>
                <a href="/class-section" class="flex justify-center items-center w-[20%] h-[10%] ml-5 py-10 bg-[#66c9ff] rounded-3xl text-3xl font-bold">Classi</a>
            </div>
            <div class="flex w-screen justify-center mt-5">
                <a href="/teacher-section" class="flex justify-center items-center w-[20%] h-[10%] mr-5 py-10 bg-[#0085cc] rounded-3xl text-3xl font-bold text-white">Docenti</a>
                <a href="/student-section" class="flex justify-center items-center w-[20%] h-[10%] ml-5 py-10 bg-[#004266] rounded-3xl text-3xl font-bold text-white">Studenti</a>
            </div>
        </div>
    @elseif (Auth::user()->role == 'teacher')
        <h1>I'm a teacher</h1>
    @elseif (Auth::user()->role == 'student')
        <h1>I'm a student</h1>
    @else
        <div class="flex flex-col justify-center items-center pt-20">
            <img src="{{ asset('/images/rick-roll-rick-rolled.gif') }}" alt="">
            <h1 class="text-3xl font-bold text-[#004266] text-center pt-5">
                Sei in attesa che il cordinatore <br> ti dia un ruolo
            </h1>
        </div>
    @endif
@endsection
