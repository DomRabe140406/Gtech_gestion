@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.notification')
<br><br><br>
    <div class="max-w-5xl mx-auto w-full">
        <div class="flex justify-around items-center mb-4">
            <!-- Graphe Chart -->
            <div class="h-72 w-1/2">
                <canvas id="formationGraphe"></canvas>
            </div>
            <!-- Doughnut Chart -->
            <div class="card-body">
                <div>
                    <canvas id="formationsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Flèches de navigation -->
        <div class="flex gap-2">
            <button
                id="btnPrev"
                class="w-10 h-10 rounded-full transition duration-300">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button
                id="btnNext"
                class="w-10 h-10 rounded-full transition duration-300">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="flex justify-around items-center mt-4">
        <p class="text-lg font-semibold mb-4">
            Evolution du nombre de formations
        </p>
        <p class="text-lg font-semibold mb-4">
            Répartition des formations
        </p>
        </div>
    </div>
<br><br>
        <!-- Historique des actions -->
        <div style="text-align:center; font-size:30px;">
            <h2><strong>Historique des actions</strong></h2>
        </div>

        <div class="bg-white overflow-x-auto">

            @if(count($history))

                <table class="shadow-xl rounded-2x1 w-semifull mx-auto">

                    <thead class="bg-gray-300">
                        <tr>
                            <th class="p-4 text-left">Date</th>
                            <th class="p-4 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($history as $item)

                        <tr class="border-b border-gray-100 transition duration-300 hover:bg-gray-100">
                            <td class="p-4">{{ $item['time'] }}</td>
                            <td class="p-4">{{ $item['message'] }}</td>
                        </tr>

                        @endforeach
                    </tbody>

                </table>

            @else
                <div class="alert alert-info">
                    Aucun historique.
                </div>
            @endif
        </div>
<br><br>
    <!--verification 
<pre>
{{ json_encode($labels, JSON_PRETTY_PRINT) }}
</pre>

<pre>
{{ json_encode($data, JSON_PRETTY_PRINT) }}
</pre>-->
@endsection
@section('scripts')
    <!--pour le Doughnut Chart -->
    <script>
        const ctx = document.getElementById('formationsChart');

        const centerTextPlugin = {
            id: 'centerText',

            beforeDraw(chart) {
                const {
                    width,
                    height,
                    ctx
                } = chart;

                ctx.restore();

                ctx.font = 'bold 28px Arial';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';

                ctx.fillText(
                    '{{ $total }}',
                    width / 2,
                    height / 2 - 30
                );

                ctx.font = '14px Arial';

                ctx.fillText(
                    'Formations',
                    width / 2,
                    height / 2
                );

                ctx.save();
            }
        };

        console.log('window.Chart = ', window.Chart);
        new Chart(ctx, {

            type: 'doughnut',

            data: {
                labels: [
                    'En inscription',
                    'En cours',
                    'Terminées'
                ],

                datasets: [{
                    data: [
                        {{ $enInscription }},
                        {{ $enCours }},
                        {{ $termine }}
                    ],

                    backgroundColor: [
                        '#3B82F6',
                        '#F59E0B',
                        '#10B981'
                    ],

                    borderWidth: 2
                }]
            },

            options: {

                responsive: true,

                cutout: '70%',

                plugins: {

                    legend: {
                        position: 'bottom'
                    },

                    tooltip: {
                        callbacks: {
                            label: function(context) {

                                let total = {{ $total }};
                                let value = context.raw;

                                let percentage =
                                    ((value / total) * 100)
                                    .toFixed(1);

                                return context.label +
                                    ': ' +
                                    value +
                                    ' (' +
                                    percentage +
                                    '%)';
                            }
                        }
                    }
                }
            },

            plugins: [centerTextPlugin]
        });
    </script>
    
    <!-- pour le graphe -->
    <script>
        const allLabels = @json($labels);
        const allData = @json($data);

        // Nombre de mois affichés
        const windowSize = 3;

        // Position de départ
        let startIndex = 0;
        /*const labels = @json($labels);
        const data = @json($data);*/
        const ctx2 = document.getElementById('formationGraphe');
        //console.log('window.Chart = ', window.Chart);
        const chart = new Chart(ctx2, {

            type: 'line',

            data: {

                labels: [],

                datasets: [{

                    label: 'Formations créées',

                    data: [],

                    borderColor: '#2563eb',

                    backgroundColor: 'rgba(37,99,235,.2)',

                    borderWidth: 3,

                    fill: true,

                    tension: 0.4,

                    pointRadius: 5,

                    pointHoverRadius: 8

                }]

            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                plugins: {

                    legend: {

                        display: true

                    }

                },

                scales: {
                   
                    y: {
                        beginAtZero: true,
                        
                        ticks: {
                            stepSize: 1,
                            precision:0
                        }
                    }
                }

            }

        });

        //elle découpe le tableau
        function updateChart(){

            chart.data.labels = allLabels.slice(
                startIndex,
                startIndex + windowSize
            );

            chart.data.datasets[0].data = allData.slice(
                startIndex,
                startIndex + windowSize
            );

            chart.update();

        }

        //elle regarde si on peut aller à gauche ou à droite (actuellement on ne peut pas aller avant janv et pas après dec)
        function updateButtons() {
            const btnPrev = document.getElementById('btnPrev');
            const btnNext = document.getElementById('btnNext');

            // Bouton précédent
            btnPrev.disabled = (startIndex === 0);

            // Bouton suivant
            btnNext.disabled = (startIndex >= allLabels.length - windowSize);
        
            // Apparence du bouton précédent
            if (btnPrev.disabled) {

                btnPrev.classList.remove(
                    'bg-blue-500',
                    'text-white',
                    'hover:bg-blue-600',
                    'cursor-pointer'
                );

                btnPrev.classList.add(
                    'bg-gray-300',
                    'text-gray-500',
                    'cursor-not-allowed',
                    'opacity-50'
                );

            } else {

                btnPrev.classList.remove(
                    'bg-gray-300',
                    'text-gray-500',
                    'cursor-not-allowed',
                    'opacity-50'
                );

                btnPrev.classList.add(
                    'bg-blue-500',
                    'text-white',
                    'hover:bg-blue-600',
                    'cursor-pointer'
                );

            }

            // Apparence du bouton suivant
            if (btnNext.disabled) {

                btnNext.classList.remove(
                    'bg-blue-500',
                    'text-white',
                    'hover:bg-blue-600',
                    'cursor-pointer'
                );

                btnNext.classList.add(
                    'bg-gray-300',
                    'text-gray-500',
                    'cursor-not-allowed',
                    'opacity-50'
                );

            } else {

                btnNext.classList.remove(
                    'bg-gray-300',
                    'text-gray-500',
                    'cursor-not-allowed',
                    'opacity-50'
                );

                btnNext.classList.add(
                    'bg-blue-500',
                    'text-white',
                    'hover:bg-blue-600',
                    'cursor-pointer'
                );

            }
        }

        //flèche Next
        document
            .getElementById('btnNext')
            .addEventListener('click', function () {
                if (startIndex < allLabels.length - windowSize) {
                    startIndex++;
                    updateChart();
                    updateButtons();
                }
            });

        //flèche Prev
        document
            .getElementById('btnPrev')
            .addEventListener('click', function () {
                if (startIndex > 0) {
                    startIndex--;
                    updateChart();
                    updateButtons();
                }
            });


        updateChart();
        updateButtons();

    </script>

@endsection