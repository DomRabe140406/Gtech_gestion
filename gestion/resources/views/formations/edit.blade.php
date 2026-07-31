@extends('layouts.app')
@section('title', 'Modifier formation')
@section('content')

<div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">

    <div class="max-w-2xl mx-auto py-10 px-4">

        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-8 border border-transparent dark:border-gray-700">

            <h1 class="text-3xl font-bold mb-8 text-gray-800 dark:text-gray-100">
                Modifier la formation
            </h1>

            <form action="{{ route('liste.update', $formation->id) }}" method="POST" class="space-y-5">

                @csrf
                @method('PUT')

                <div>
                    <label class="flex items-center gap-2 mb-2 font-medium text-gray-600 dark:text-gray-300">
                        <i class="fas fa-hashtag text-blue-500 dark:text-blue-400 text-sm"></i>
                        Référence
                    </label>
                    <input type="text" name="ref_formation" value="{{ $formation->ref_formation }}"
                           class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                                  focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                </div>

                <div>
                    <label class="flex items-center gap-2 mb-2 font-medium text-gray-600 dark:text-gray-300">
                        <i class="fas fa-book text-blue-500 dark:text-blue-400 text-sm"></i>
                        Nom formation
                    </label>
                    <input type="text" name="nom_formation" value="{{ $formation->nom_formation }}"
                           class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                           focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                </div>

                <div>
                    <label class="flex items-center gap-2 mb-2 font-medium text-gray-600 dark:text-gray-300">
                        <i class="fas fa-calendar text-blue-500 dark:text-blue-400 text-sm"></i>
                        Date de début
                    </label>
                    <input type="date" name="date_debut" value="{{ $formation->date_debut }}"
                        class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                               focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors [color-scheme:light] dark:[color-scheme:dark]">
                </div>

                <div>
                    <label class="flex items-center gap-2 mb-2 font-medium text-gray-600 dark:text-gray-300">
                        <i class="fas fa-list-check text-blue-500 dark:text-blue-400 text-sm"></i>
                        Statut
                    </label>
                    <select name="statut"
                            class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                               focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">

                        <option value="en_inscription" {{ $formation->statut == 'en_inscription' ? 'selected' : '' }}>
                            En inscription
                        </option>

                        <option value="en_cours" {{ $formation->statut == 'en_cours' ? 'selected' : '' }}>
                            En cours
                        </option>

                        <option value="termine" {{ $formation->statut == 'termine' ? 'selected' : '' }}>
                            Terminé
                        </option>

                    </select>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500 text-white px-6 py-3 rounded-xl transition-colors duration-300 shadow
                               font-medium flex items-center gap-2 cursor-pointer">
                        <i class="fas fa-check text-sm"></i>
                        Modifier
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>
@endsection