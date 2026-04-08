<div id="establishmentChart" style="height: 410px;"></div>

<script src="https://cdn.jsdelivr.net/npm/echarts@5.0.0/dist/echarts.min.js"></script>
<script>
    var chartDom = document.getElementById('establishmentChart');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        title: {
            // text: 'Répartition par Type d\'Établissement',
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
            formatter: '{a} <br/>{b}: {c} soit {d}%'
        },
        legend: {
            orient: 'vertical',
            left: 'right',
            textStyle: {
                fontSize: 14,
                color: '#333'
            }
        },
        color: ['#00c0ef', '#ff851b', '#00a65a'], // Couleurs personnalisées pour chaque type
        series: [
            {
                name: 'Types d\'établissements',
                type: 'pie',
                radius: '50%',
                label: {
                    show: true,
                    formatter: '{b}: {c} ({d}%)',
                    fontSize: 14
                },
                data: [
                    { value: @json($data['data'][0]), name: ' Technique' },
                    { value: @json($data['data'][1]), name: ' Professionnelle' },
                    { value: @json($data['data'][2]), name: ' Supérieur' }
                ],
                emphasis: {
                    itemStyle: {
                        shadowBlur: 20,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.8)'
                    }
                },
                itemStyle: {
                    // borderColor: '#000',
                    borderWidth: 1,
                    shadowBlur:5,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                },
            }
        ]
    };

    option && myChart.setOption(option);
</script>
