@extends('layouts.app')
@section('title', 'Modifier formateur')
@section('content')

<div class="max-w-2xl mx-auto py-10 px-4">
    <div class="bg-white shadow-xl rounded-2xl p-8">
        <h1 class="text-3xl font-bold mb-8">Modifier le formateur</h1>
        <form action="{{ route('formateurs.update', $formateur->id) }}"
              method="POST">

            @csrf

            @method('PUT')
            <div>
                <label class="text-gray-600">
                    Spécialités :
                </label>
                @foreach($specialites as $specialite)

                <label class="flex items-center gap-2 mb-2">

                    <input
                        type="checkbox"
                        name="specialites[]"
                        value="{{ $specialite->id }}"
                        class="rounded"

                        {{ in_array(
                            $specialite->id,
                            old(
                                'specialites',
                                $formateur->specialites->pluck('id')->toArray()
                            )
                        ) ? 'checked' : '' }}

                    >

                    {{ $specialite->nom_specialite }}

                </label>
                @endforeach
            </div>
            <div>
                <label class="text-gray-600">
                    Nom formateur
                </label>
                <input
                    type="text"
                    name="nom_formateur"
                    value="{{ $formateur->nom_formateur }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-xl"
                >
            </div>
            <div>
                <label class="text-gray-600">
                    Prénom formateur
                </label>
                <input
                    type="text"
                    name="prenom_formateur"
                    value="{{ $formateur->prenom_formateur }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-xl"
                >
            </div>
            <div>
                <label class="text-gray-600">
                    Email
                </label>
                <input
                    type="text"
                    name="email"
                    value="{{ $formateur->email }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-xl"
                >
            </div>
            <div>
                <label class="text-gray-600">
                    Téléphone
                </label>
                <input
                    type="text"
                    name="telephone"
                    value="{{ $formateur->telephone }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-xl"
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