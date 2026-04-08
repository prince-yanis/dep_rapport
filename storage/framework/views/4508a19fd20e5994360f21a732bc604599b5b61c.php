<div id="establishmentVisitChart" style="height: 410px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts@5.0.0/dist/echarts.min.js"></script>
<script>
    var chartDom = document.getElementById('establishmentVisitChart');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        title: {
            subtext: 'Nombre d\'établissements',
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
        color: [
            {
                type: 'linear',
                x: 0,
                y: 0,
                x2: 0,
                y2: 1,
                colorStops: [
                    { offset: 0, color: '#28a745' },   // Vert foncé pour établissements visités
                ]
            },
            {
                type: 'linear',
                x: 0,
                y: 0,
                x2: 1,
                y2: 1,
                colorStops: [
                    { offset: 0, color: '#f39c12' },   // Orange foncé pour établissements non visités
                ]
            }
        ],
        series: [
            {
                name: 'Visites des établissements',
                type: 'pie',
                radius: '50%',
                label: {
                    show: true,
                    formatter: '{b}: {c} ({d}%)', // Affiche le nom, la valeur et le pourcentage
                    fontSize: 14
                },
                labelLine: {
                    length: 20, // Ligne reliant le label au segment
                    length2: 10
                },
                itemStyle: {
                    borderWidth: 1,
                    shadowBlur: 5,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                },
                animationType: 'scale',
                animationEasing: 'elasticOut',
                animationDelay: function (idx) {
                    return Math.random() * 200; // Délai d'animation aléatoire pour chaque segment
                },
                data: [
                    { value: <?php echo json_encode($data['data'][0], 15, 512) ?>, name: 'Visités' },
                    { value: <?php echo json_encode($data['data'][1], 15, 512) ?>, name: 'Non visités' }
                ],
                emphasis: {
                    itemStyle: {
                        shadowBlur: 20,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.8)'
                    }
                }
            }
        ]
    };

    option && myChart.setOption(option);
</script>
<?php /**PATH C:\wamp64\www\dep_rapport\resources\views/admin/chart_visit.blade.php ENDPATH**/ ?>