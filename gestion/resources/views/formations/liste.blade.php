@extends('layouts.app')

@section('title', 'Liste des formations')

@section('content')


<div class="max-w-7xl mx-auto px-6 py-8">
    <!--  Titres  -->
    <div class="flex flex-col lg:flex-row justify-between items-center gap-4 mb-8">

        <div>
            <h2 class="text-2xl font-bold text-gray-700">
                Gestion des formations
            </h2>
            <p class="text-gray-500 mt-1">
                Consultez, modifiez et supprimez les formations.
            </p>
        </div>
    
        <!-- Notifications -->
        {{-- Notifications --}}

        @if(session('success'))
            <div id="notif"
                class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700 shadow-md transition-all duration-500">

                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div id="notif"
                class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-red-700 shadow-md transition-all duration-500">

                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-xmark text-red-600 text-xl"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif
            
        <!-- BTN AJOUT de formation -->
        <a href="{{ route('formations.create') }}"
            class="inline-flex items-center gap-3
            bg-gradient-to-r from-blue-600 to-blue-500
            hover:from-blue-700 hover:to-blue-600
            text-white
            px-6 py-3
            rounded-xl
            shadow-lg
            transition">

            <i class="fa-solid fa-plus"></i>
            Ajouter une formation
        </a>
    </div>

    <!-- CARTES -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:-translate-y-1 hover:shadow-xl transition">

            <div class="flex items-center gap-4">

                <div class="w-16 h-16 rounded-full bg-blue-100 flex justify-center items-center">
                    <i class="fa-solid fa-graduation-cap text-blue-600 text-2xl"></i>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">
                        Total formations
                    </p>
                    <h3 class="text-3xl font-bold">
                        {{ $totalFormations }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:-translate-y-1 hover:shadow-xl transition">

            <div class="flex items-center gap-4">

                <div class="w-16 h-16 rounded-full bg-blue-50 flex justify-center items-center">
                    <i class="fa-solid fa-user-plus text-blue-500 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">
                        En inscription
                    </p>
                    <h3 class="text-3xl font-bold">
                        {{ $formationsInscription }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:-translate-y-1 hover:shadow-xl transition">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-orange-100 flex justify-center items-center">
                    <i class="fa-solid fa-spinner text-orange-500 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">
                        En cours
                    </p>
                    <h3 class="text-3xl font-bold">
                        {{ $formationsEnCours }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:-translate-y-1 hover:shadow-xl transition">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-green-100 flex justify-center items-center">
                    <i class="fa-solid fa-circle-check text-green-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">
                        Terminées
                    </p>
                    <h3 class="text-3xl font-bold">
                        {{ $formationsTerminees }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <!--  Tableau  -->
    <div class="bg-white rounded-3xl border border-gray-200 shadow-lg p-6">
        <div class="flex flex-col lg:flex-row justify-between gap-4 mb-6">
            <form action="{{ route('formations.index') }}"
                    method="GET"
                    id="searchForm"
                    class="flex flex-col md:flex-row gap-3 w-full">

                <div class="relative w-full md:w-96">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Rechercher une formation..."
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none"
                    >
                </div>
                <select name="statut"
                        onchange="this.form.submit()"
                        class="rounded-xl border border-gray-300 px-5 py-3">
                    <option value="">Tous les statuts</option>
                    <option value="en_inscription"
                        {{ request()->statut=='en_inscription'?'selected':'' }}>
                        En inscription
                    </option>
                    <option value="en_cours"
                        {{ request()->statut=='en_cours'?'selected':'' }}>
                        En cours
                    </option>
                    <option value="termine"
                        {{ request()->statut=='termine'?'selected':'' }}>
                        Terminée
                    </option>
                </select>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left">Référence</th>
                        <th class="px-6 py-4 text-left">Formation</th>
                        <th class="px-6 py-4 text-left">Statut</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formations as $formation)
                    <tr class="border-b border-gray-200 hover:bg-slate-50 transition duration-300">
                        <!-- Référence -->
                        <td class="px-6 py-5 font-medium text-gray-700">
                            {{ $formation->ref_formation }}
                        </td>

                        <!-- Nom -->
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fa-solid fa-graduation-cap text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">
                                        {{ $formation->nom_formation }}
                                    </h3>
                                </div>
                            </div>
                        </td>

                        <!-- Statut -->
                        <td class="px-6 py-5">
                            @switch($formation->statut)
                                @case('en_inscription')
                                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                        En inscription
                                    </span>
                                @break

                                @case('en_cours')
                                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-100 text-orange-700 text-sm font-semibold">
                                        <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                        En cours
                                    </span>
                                @break

                                @case('termine')
                                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                        Terminée
                                    </span>
                                @break

                                @default
                                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 text-gray-700 text-sm font-semibold">
                                        <span class="w-2 h-2 rounded-full bg-gray-500"></span>
                                        Inconnu
                                    </span>
                            @endswitch
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-5">
                            <div class="flex justify-center items-center gap-3">
                                <!-- Modifier -->
                                <a href="{{ route('liste.edit',$formation->id) }}"
                                    class="w-10 h-10 rounded-full
                                        bg-blue-100
                                        text-blue-600
                                        hover:bg-blue-600
                                        hover:text-white
                                        transition
                                        duration-300
                                        flex items-center justify-center">

                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <!-- Supprimer -->
                                <form action="{{ route('liste.destroy',$formation->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Supprimer cette formation ?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="w-10 h-10 rounded-full
                                            bg-red-100
                                            text-red-600
                                            hover:bg-red-600
                                            hover:text-white
                                            transition
                                            duration-300
                                            flex items-center justify-center">

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
</div>

@if($formations->count() == 0)
    <div class="py-16 text-center">
        <div class="w-24 h-24 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-6">
            <i class="fa-solid fa-folder-open text-4xl text-gray-400"></i>
        </div>
        <h2 class="text-2xl font-semibold text-gray-700">
            Aucune formation trouvée
        </h2>
        <p class="text-gray-500 mt-2">
            Essayez une autre recherche ou ajoutez une nouvelle formation.
        </p>
    </div>
@endif

<!--  Pagination  -->
@if($formations->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $formations->links() }}
    </div>
@endif

@endsection

@section('scripts')
<script>
    //pour permettre la recherche automatique
    let timer;

    document.getElementById('search').addEventListener('input', function () {
        clearTimeout(timer);

        timer = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 500); // délai de 500 ms
    });
    //notification
    document.addEventListener("DOMContentLoaded", function () {

    const notif = document.getElementById("notif");

    if (notif) {

        setTimeout(() => {

            notif.style.opacity = "0";
            notif.style.transform = "translateY(-20px)";

            setTimeout(() => {

                notif.remove();

            }, 500);

        }, 3000);

    }

});

</script>
@endsection