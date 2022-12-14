import Chart from 'chart.js/auto'
const label = rangeTanggal

const data = {
    labels: label,
    datasets: [
        {
            label: 'Terlambat',
            backgroundColor: 'rgb(250, 160, 90)',
            fill: false,
            borderColor: 'rgb(250, 160, 90)',
            data: dataTerlambat,
            tension: 0.1
        },
    ]
}

const config = {
    type: 'line',
    data: data,
    options: {}
}

new Chart(
    document.getElementById('terlambatChart').getContext('2d'),
    config
)