function Menu()
{
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    const estOuvert = sidebar.classList.contains('translate-x-0');

    if (estOuvert) {
        // Fermer
        sidebar.classList.remove('translate-x-0');
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    } else {
        // Ouvrir
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        overlay.classList.remove('hidden');
    }
}

//pour le Doughnut Chart
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
        total,
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
const { enInscription, enCours, termine, total } = window.dashboardData;
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
                        enInscription,
                        enCours,
                        termine
                    ] ,

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

                                let totalFormation = total;
                                let value = context.raw;

                                let percentage =
                                    ((value / totalFormation) * 100)
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

//pour le graphe
const allLabels = window.formationData.labels;
const allData = window.formationData.data;

// Nombre de mois affichés
const windowSize = 3;

// Position de départ
let startIndex = 0;
const ctx2 = document.getElementById('formationGraphe');

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

