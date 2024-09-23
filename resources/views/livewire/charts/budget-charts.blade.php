<div class="container mx-auto">
    <div class="flex justify-between mb-4">
    <div class="bg-white p-4 border rounded shadow text-center w-1/3">
    <p class="font-semibold">Total Number of Disbursement Vouchers</p>
    <h2 class="text-xl font-bold">5,370</h2>
        </div>
        <div class="bg-white p-4 border rounded shadow text-center w-1/3">
        <p class="font-semibold">Total Gross Amount</p>
        <h2 class="text-xl font-bold">₱5,993,817,647.37</h2>
        </div>
        <div class="bg-white p-4 border rounded shadow text-center w-1/3">
        <p class="font-semibold">Total Number of Completed Disbursement Vouchers</p>
        <h2 class="text-xl font-bold">5,219</h2>
        </div>
    </div>

    <div class="flex justify-between mb-4">
        <div class="w-2/3 bg-white p-4 border rounded shadow">
            <canvas id="grossAmountByProgram"></canvas>
        </div>
        <div class="w-1/3 bg-white p-4 border rounded shadow">
            <canvas id="dvAppropriationStatus"></canvas>
        </div>
    </div>
</div>

<script>
    // Gross Amount by Program/Unit - Horizontal Bar Chart
    var ctxBar = document.getElementById('grossAmountByProgram').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['SOCPEN', 'DRRP', 'AICS', 'PANTAWID', 'QRF', 'CENTER', 'KCKKB', 'SLP', 'PAMANA-DRRP', 'SFP', 'TRUST FUND', 'COMM BASED', 'CENTER (DR)', 'GASS', 'ICTMS', 'CRCF', 'TARA', 'EPAHP', 'NHTSPR', 'COMPREHENS.', 'CCAM', 'HRMDD'],
            datasets: [{
                label: 'Gross Amount',
                data: [1724540926.80, 1684203842.97, 1406405533.02, 204933925.16, 173704564.93, 161536142.54, 129431826.83, 73439237.33, 107304966.77, 6950989.96, 3493289.11, 3068369.39, 2883174.14, 2792934.54, 1625756.44, 1606677.83, 21078846.50, 2954791.19, 4984553.83, 452617.19, 351987.98, 317022.82],
                backgroundColor: '#36A2EB'
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // DV Appropriation Status - Pie Chart
    var ctxPie = document.getElementById('dvAppropriationStatus').getContext('2d');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Continuing', 'Current'],
            datasets: [{
                data: [249, 4966],
                backgroundColor: ['#FF6384', '#36A2EB'],
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
