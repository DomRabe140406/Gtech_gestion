@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.notification')
<br><br><br>
    <div class="card shadow-sm" style="width: 1000px; margin: auto;">
        <div style="text-align:center; font-size:30px;">
            <h2><strong>Répartition des formations</strong></h2>
        </div>
<br>
        <div class="card-body">
            <div style="width: 300px; margin:auto;">
                <canvas id="formationsChart"></canvas>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
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

@endsection