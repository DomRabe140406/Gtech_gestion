@extends('layouts.app')
@section('title', 'Modifier formateur')
@section('content')

<div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">

    <div class="max-w-2xl mx-auto py-10 px-4">

        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-8 border border-transparent dark:border-gray-700">

            <h1 class="text-3xl font-bold mb-8 text-gray-800 dark:text-gray-100">
                Modifier le formateur
            </h1>

            <form action="{{ route('formateurs.update', $formateur->id) }}" method="POST" class="space-y-5">

                @csrf
                @method('PUT')

                <div>
                    <label class="flex items-center gap-2 mb-3 font-medium text-gray-600 dark:text-gray-300">
                        <i class="fas fa-star text-blue-500 dark:text-blue-400 text-sm"></i>
                        Spécialités :
                    </label>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">

                        @foreach($specialites as $specialite)

                            <label class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700
                                          text-gray-700 dark:text-gray-200 cursor-pointer transition-colors">

                                <input type="checkbox" name="specialites[]" value="{{ $specialite->id }}"
                                       class="rounded border-gray-300 dark:border-gray-600 text-blue-500 dark:bg-gray-900 focus:ring-blue-400 dark:focus:ring-blue-500"

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
                </div>

                <div>
                    <label class="flex items-center gap-2 mb-2 font-medium text-gray-600 dark:text-gray-300">
                        <i class="fas fa-user text-blue-500 dark:text-blue-400 text-sm"></i>
                        Nom formateur
                    </label>
                    <input type="text" name="nom_formateur" value="{{ $formateur->nom_formateur }}"
                        class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                               focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                </div>

                <div>
                    <label class="flex items-center gap-2 mb-2 font-medium text-gray-600 dark:text-gray-300">
                        <i class="fas fa-id-card text-blue-500 dark:text-blue-400 text-sm"></i>
                        Prénom formateur
                    </label>
                    <input type="text" name="prenom_formateur" value="{{ $formateur->prenom_formateur }}"
                           class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                           focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                </div>

                <div>
                    <label class="flex items-center gap-2 mb-2 font-medium text-gray-600 dark:text-gray-300">
                        <i class="fas fa-envelope text-blue-500 dark:text-blue-400 text-sm"></i>
                        Email
                    </label>
                    <input type="text" id="email" name="email" value="{{ $formateur->email }}"
                        class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                               focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                </div>

                <div>
                    <label class="flex items-center gap-2 mb-2 font-medium text-gray-600 dark:text-gray-300">
                        <i class="fas fa-phone text-blue-500 dark:text-blue-400 text-sm"></i>
                        Téléphone
                    </label>
                    <input type="text" id="telephone" name="telephone" value="{{ $formateur->telephone }}"
                           class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                           focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                </div>

                <div class="flex justify-between pt-4">

                    <button type="button" onclick="annulerModificationFormateur()"
                            class="bg-gray-100  hover:bg-red-500 dark:hover:bg-red-600 text-gray-600  hover:text-white dark:bg-red-900/40 dark:text-red-300
                            px-6 py-3 rounded-xl transition-colors duration-300 shadow font-medium flex items-center gap-2 cursor-pointer">
                        <i class="fas fa-xmark text-sm"></i>
                        Annuler
                    </button>

                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600  dark:hover:bg-blue-500 text-white px-6 py-3 rounded-xl transition-colors duration-300 shadow
                            font-medium flex items-center gap-2 cursor-pointer dark:bg-blue-900/40 dark:text-blue-300">
                        <i class="fas fa-check text-sm"></i>
                        Modifier
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
<script>
    function annulerModificationFormateur()
    {
        let confirmation = confirm("Voulez-vous annuler la modification ?");

        if (confirmation) {
            window.location.href = "{{ route('formateurs.index') }}";
        }
    }
</script>