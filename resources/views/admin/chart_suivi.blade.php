<div id="suiviChart" style="height: 410px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts@5.0.0/dist/echarts.min.js"></script>
<script>
    var chartDom = document.getElementById('suiviChart');
    var myChart = echarts.init(chartDom);
    var option;

    var data = [
        @json($data['data'][0]), // Valeur pour "Terminé"
        @json($data['data'][1]) // Valeur pour "Non terminé"
    ];
    // Calcul du total
    var total = data.reduce((acc, val) => acc + val, 0);

    option = {
        title: {
            // text: 'Répartition par sexe',
            subtext: `Nombre d'etablissement : ${total}`,
            left: 'left',
            textStyle: {
                fontSize: 18,
                fontWeight: 'bold',
                color: '#333'
            },
            subtextStyle: {
                fontSize: 14,
                color: '#777'
            }
        },
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b}: {c} soit {d}%' // Tooltip montrant la valeur et le pourcentage
        },
        legend: {
            orient: 'vertical',
            left: 'right',
            textStyle: {
                fontSize: 14,
                color: '#333'
            }
        },
        // Ajout des couleurs personnalisées : gradient avec orange et vert
        color: [{
                type: 'linear',
                x: 0,
                y: 0,
                x2: 0,
                y2: 1,
                colorStops: [{
                        offset: 0,
                        color: '#0575E6'
                    }, // Vert foncé
                    // { offset: 1, color: '#00c65a' }    // Vert clair
                ]
            },
            {
                type: 'linear',
                x: 0,
                y: 0,
                x2: 1,
                y2: 1,
                colorStops: [{
                        offset: 0,
                        color: '#56CCF2'
                    }, // Orange foncé
                    // { offset: 1, color: '##dd4b39' }    // Orange clair
                ]
            }
        ],
        series: [{
            name: 'Nombre de remplissage',
            type: 'pie',
            radius: '50%',
            // Labels détaillés avec pourcentage
            label: {
                show: true,
                formatter: '{b}: {c} ({d}%)', // Affiche le nom, la valeur et le pourcentage
                fontSize: 14
            },
            labelLine: {
                length: 20, // Ligne reliant le label au segment
                length2: 10
            },
            // Ajout d'une bordure et d'un effet d'ombre
            itemStyle: {
                // borderColor: '#000',
                borderWidth: 1,
                shadowBlur: 5,
                shadowOffsetX: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
            },
            // Animation pour l'affichage du graphique
            animationType: 'scale',
            animationEasing: 'elasticOut',
            animationDelay: function(idx) {
                return Math.random() * 200; // Délai d'animation aléatoire pour chaque segment
            },
            data: [{
                    value: @json($data['data'][0]),
                    name: 'Terminé'
                },
                {
                    value: @json($data['data'][1]),
                    name: 'Non terminé'
                }
            ],
            emphasis: {
                itemStyle: {
                    shadowBlur: 20,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.8)'
                }
            }
        }]
    };

    option && myChart.setOption(option);
</script>
