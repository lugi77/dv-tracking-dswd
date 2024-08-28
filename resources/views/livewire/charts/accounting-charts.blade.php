<div class="container" style="max-width: 1200px; margin: auto;">
    <!-- Header -->
    <div style="text-align: center; margin-bottom: 20px;">
        <h1 style="font-size: 48px; font-weight: bold;">Accounting Section</h1>
    </div>

    <div style="display: flex; justify-content: space-between;">
        <!-- Bar Chart -->
        <div style="flex: 3; padding-right: 20px;">
            <h3 style="text-align: center;">Completed vs Pending DV Compliance</h3>
            <div style="height: 400px;">
                <canvas id="myBarChart"></canvas>
            </div>
        </div>

        <!-- Right Side Charts -->
        <div style="flex: 2; display: flex; flex-direction: column; justify-content: space-between;">
            <div style="margin-bottom: 20px;">
                <h3 style="text-align: center;">Certification Status of DVs</h3>
                <div style="height: 200px;">
                    <canvas id="myPieChart1"></canvas>
                </div>
            </div>
            <div style="margin-bottom: 20px;">
                <h3 style="text-align: center;">Processing Status of DVs</h3>
                <div style="height: 200px;">
                    <canvas id="myPieChart2"></canvas>
                </div>
            </div>
        </div>
    </div>
            
    <script>
        // Bar Chart Configuration
        var ctxBar = document.getElementById('myBarChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Completed', 'Pending'],
                datasets: [{
                    label: 'DV Number',
                    data: [5184, 293],
                    borderWidth: 1,
                    backgroundColor: ['#007bff', '#ff0000']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart 1 Configuration
        var ctxPie1 = document.getElementById('myPieChart1').getContext('2d');
        new Chart(ctxPie1, {
            type: 'pie',
            data: {
                labels: ['Certified', 'Not Certified'],
                datasets: [{
                    label: 'Certification Status of DVs',
                    data: [4409, 961],
                    backgroundColor: ['#36a2eb', '#ff6384']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Pie Chart 2 Configuration
        var ctxPie2 = document.getElementById('myPieChart2').getContext('2d');
        new Chart(ctxPie2, {
            type: 'pie',
            data: {
                labels: ['Processed', 'Not Processed'],
                datasets: [{
                    label: 'Processing Status of DVs',
                    data: [5363, 7],
                    backgroundColor: ['#36a2eb', '#ff6384']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</div>
