@extends('layouts.app')
@section('title', 'Modifier formation')
@section('content')

<div class="max-w-2xl mx-auto py-10 px-4">
    <div class="bg-white shadow-xl rounded-2xl p-8">
        <h1 class="text-3xl font-bold mb-8">Modifier la formation</h1>
        <form action="{{ route('liste.update', $formation->id) }}"
              method="POST">

            @csrf

            @method('PUT')
            <div>
                <label class="text-gray-600">
                    Référence
                </label>
                <input
                    type="text"
                    name="ref_formation"
                    value="{{ $formation->ref_formation }}"
                    class="w-full mt-2 p-3 border rounded-xl"
                >
            </div>
            <div>
                <label class="text-gray-600">
                    Nom formation
                </label>
                <input
                    type="text"
                    name="nom_formation"
                    value="{{ $formation->nom_formation }}"
                    class="w-full mt-2 p-3 border rounded-xl"
                >
            </div>
                        <div>
                <label class="text-gray-600">
                    Date de début
                </label>
                <input
                    type="date"
                    name="date_debut"
                    value="{{ $formation->date_debut }}"
                    class="w-full mt-2 p-3 border rounded-xl"
                >
            </div>

            <button
                type="submit"
                cursor="pointer"
                class="mt-6 bg-blue-500 text-white px-6 py-3 rounded-xl">
                Modifier
            </button>
        </form>
    </div>
</div>

@endsection