<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview Balance Bar Chart</title>
    <style>
        body {
            background-color: #1E1E2F;
            color: #FFF;
            font-family: Arial, sans-serif;
        }
        .chart-container {
            width: 32rem;
            margin: 0 auto;
        }
        canvas {
            background: #2C2C3E; /* Match the background color from your image */
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Overview Balance</h2>
    <div class="chart-container">
        <canvas id="overviewBalanceChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const totalValue = 100; // The maximum value to represent 100% height
        const dataValues = [56, 45, 62, 73, 88, 56, 10, 63, 20, 8, 62, 73, 90];

        const fillData = dataValues;
        const backgroundData = dataValues.map(value => totalValue);

        const data = {
            labels: ['06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18'],
            datasets: [
                {
                    label: 'Filled',
                    data: fillData,
                    backgroundColor: 'rgba(73, 77, 173, 1)', // Purple fill color
                    borderColor: 'rgba(73, 77, 173, 1)',
                    borderWidth: 0,
                    barThickness: 10, // Make bars thinner
                    borderRadius: {
                        topLeft: 10,
                        topRight: 10,
                        bottomLeft: 10,
            bottomRight: 10
                    },
                },
                {
                    label: 'Empty',
                    data: backgroundData,
                    backgroundColor: '#FFFFFF', // White background color
                    borderColor: '#FFFFFF',
                    borderWidth: 0,
                    barThickness: 10, // Make bars thinner
                    borderRadius: {
                        topLeft: 10,
                        topRight: 10
                    },
                }
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stacked: false, // Stack the datasets on top of each other
                        ticks: {
                            color: '#FFF'
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0)' // Transparent grid lines
                        }
                    },
                    x: {
                        stacked: true, // Stack the datasets on top of each other
                        ticks: {
                            color: '#FFF'
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                        text: 'Overview Balance',
                        color: '#FFF',
                        font: {
                            size: 20
                        }
                    }
                }
                
            }
        };

        const ctx = document.getElementById('overviewBalanceChart').getContext('2d');
        const overviewBalanceChart = new Chart(ctx, config);
    </script>
</body>
</html>
