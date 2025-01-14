@extends('layouts.app')

@section('titulo')
    Inicia sesion en Devstagram
@endsection

@section('contenido')
    <div class="md:flex justify-center md:gap-10 items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen registro usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl ">
            <form method="POST" action="{{route('login')}}" novalidate>
                @csrf

                @if (session('mensaje'))
                <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >
                    {{session('mensaje')}}
                </p>
                @endif

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        email
                    </label>
                    <input 
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu email"
                        class="border p-3 w-full rounded-lg
                        @error('email')
                         border-red-500    
                        @enderror"
                        value="{{old('email')}}"
                    />
                    @error('email')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >
                        {{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        password
                    </label>
                    <input 
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Contraseña"
                        class="border p-3 w-full rounded-lg
                        @error('name')
                         border-red-500    
                        @enderror"
                    />
                    @error('password')
                        <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >
                        {{$message}}</p>
                    @enderror
                </div>

                <div class=" mb-5">
                    <input type="checkbox" name="remember"><label class=" m-1 text-sm text-gray-600">Recuerdame</label>
                </div>

                <input 
                    type="submit"
                    value="Iniciar Sesion"
                    class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3
                     text-white rounded-lg"
                >
            </form>
        </div>

    </div>
@endsection