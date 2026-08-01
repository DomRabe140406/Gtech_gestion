@extends('layouts.app')
@section('title', 'Mon profil')
@section('content')

<div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300 py-10 px-4">

    <div class="max-w-2xl mx-auto">

        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-8 flex items-center gap-3">
            <i class="fas fa-user-gear text-blue-500 dark:text-blue-400"></i>
            Paramètres du compte
        </h1>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300 border border-green-200 dark:border-green-800">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profil.update') }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- INFOS GÉNÉRALES -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700
                        shadow-sm p-6">

                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-5">
                    Informations générales
                </h2>

                <div class="space-y-4">

                    <div>
                        <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                            <i class="fas fa-user text-blue-500 dark:text-blue-400 text-sm"></i>
                            Nom
                        </label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl
                                      bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                                      focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                                      transition-colors">
                        @error('name')
                            <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                            <i class="fas fa-envelope text-blue-500 dark:text-blue-400 text-sm"></i>
                            Email
                        </label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl
                                      bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                                      focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                                      transition-colors">
                        @error('email')
                            <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

            </div>

            <!-- CHANGEMENT DE MOT DE PASSE -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700
                        shadow-sm p-6">

                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-1">
                    Changer le mot de passe
                </h2>
                <p class="text-sm text-gray-400 dark:text-gray-500 mb-5">
                    Laisse ces champs vides si tu ne veux pas changer de mot de passe.
                </p>

                <div class="space-y-4">

                    <div>
                        <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                            <i class="fas fa-lock text-blue-500 dark:text-blue-400 text-sm"></i>
                            Mot de passe actuel
                        </label>
                        <input type="password" name="current_password"
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl
                                      bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                                      focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                                      transition-colors">
                        @error('current_password')
                            <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                            <i class="fas fa-key text-blue-500 dark:text-blue-400 text-sm"></i>
                            Nouveau mot de passe
                        </label>
                        <input type="password" name="new_password"
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl
                                      bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                                      focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                                      transition-colors">
                        @error('new_password')
                            <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                            <i class="fas fa-key text-blue-500 dark:text-blue-400 text-sm"></i>
                            Confirmer le nouveau mot de passe
                        </label>
                        <input type="password" name="new_password_confirmation"
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl
                                      bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                                      focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                                      transition-colors">
                    </div>

                </div>

            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500
                               text-white px-6 py-3 rounded-xl transition-colors duration-300
                               font-medium flex items-center gap-2">
                    <i class="fas fa-check text-sm"></i>
                    Enregistrer les modifications
                </button>
            </div>

        </form>

    </div>

</div>

@endsection