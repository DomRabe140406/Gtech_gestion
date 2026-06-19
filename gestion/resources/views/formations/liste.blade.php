@extends('layouts.app')

@section('title', 'Liste des formations')

@section('content')

<div class="max-w-5xl mx-auto py-10 px-4">

    <h1 class="text-3xl font-bold mb-5">
        Liste des formations
    </h1>

    {{-- MESSAGE SUCCESS --}}
    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">

            {{ session('success') }}

        </div>

    @endif

    <a href="{{ route('formations.create') }}"
    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700  duration-300 text-white px-4 py-2 rounded-lg shadow mb-2">

        <i class="fa-solid fa-plus"></i>
        Ajouter une formation

    </a>

    <!-- Barre de recherche -->
    <div class="flex justify-between items-center mb-6">
        <form action="{{ route('formations.index') }}" method="GET" class="flex">
            <input
                type="text"
                name="search"
                placeholder="Rechercher une formation..."
                value="{{ request('search') }}"
                class="w-72 px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 rounded-r-lg hover:bg-blue-700"
            >
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>

    </div>

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-300">

                <tr>

                    <th class="p-4 text-left">
                        Formation
                    </th>

                    <th class="p-4 text-left">
                        Statut
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

                            {{ $formation->nom_formation }}

                        </td>

                        <td class="p-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                @switch($formation->statut)
                                    @case('en_inscription')
                                        bg-blue-100 text-blue-800
                                        @break

                                    @case('en_cours')
                                        bg-orange-100 text-orange-800
                                        @break

                                    @case('termine')
                                        bg-green-100 text-green-800
                                        @break

                                    @default
                                        bg-gray-100 text-gray-800
                                @endswitch">
                                {{ ucfirst(str_replace('_', ' ', $formation->statut)) }}
                            </span>
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
    <!-- Pagination -->
    <div class="mt-6">
        {{ $formations->links() }}
    </div>

</div>

@endsection