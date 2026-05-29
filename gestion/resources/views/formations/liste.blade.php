@extends('layouts.app')

@section('title', 'Liste des formations')

@section('content')

<div class="max-w-5xl mx-auto py-10 px-4">

    <h1 class="text-3xl font-bold mb-8">
        Liste des formations
    </h1>

    {{-- MESSAGE SUCCESS --}}
    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">

            {{ session('success') }}

        </div>

    @endif

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-300">

                <tr>

                    <th class="p-4 text-left">
                        ID
                    </th>

                    <th class="p-4 text-left">
                        Formation
                    </th>

                    <th class="p-4 text-center">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($formations as $formation)

                    <tr class="border-b border-gray-100 transition duration-300 hover:bg-gray-100">

                        <td class="p-4">

                            {{ $formation->id }}

                        </td>

                        <td class="p-4">

                            {{ $formation->nom_formation }}

                        </td>

                        <td class="p-4">

                            <div class="flex justify-center gap-4">

                                {{-- MODIFIER --}}
                                <a href="{{ route('liste.edit', $formation->id) }}"
                                   class="text-blue-500 hover:text-blue-700 text-xl">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                {{-- SUPPRIMER --}}
                                <form action="{{ route('liste.destroy', $formation->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Supprimer cette formation ?')">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            style="cursor: pointer;"
                                            class="text-red-500 hover:text-red-700 text-xl">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection