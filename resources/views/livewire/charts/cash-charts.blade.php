<div class="container mx-auto">
    <!-- Header -->
    <div style="text-align: center; margin-bottom: 20px;">
        <h1 style="font-size: 48px; font-weight: bold;">Cash Section</h1>
    </div>

    <!-- Summary Cards -->
    <div class="flex justify-around mb-4">
        <div class="bg-white p-4 border rounded shadow text-center w-1/3">
            <p class="font-semibold">Total Number of Disbursement Vouchers</p>
            <h2 class="text-xl font-bold">3,775</h2>
        </div>
        <div class="bg-white p-4 border rounded shadow text-center w-1/3">
            <p class="font-semibold">Total Number of Unprocessed DVs</p>
            <h2 class="text-xl font-bold">1,202</h2>
        </div>
        <div class="bg-white p-4 border rounded shadow text-center w-1/3">
            <p class="font-semibold">Total Net Amount</p>
            <h2 class="text-xl font-bold">₱5,531,648,946.08</h2>
        </div>
    </div>

    <!-- Pie Chart and Inventory Table Side by Side -->
    <div class="flex justify-between mb-4">
        <!-- Pie Chart -->
        <div class="bg-white p-4 border rounded shadow w-1/2">
            <h3 class="text-center font-semibold mb-2">DV Appropriation Status</h3>
            <div class="relative">
                <canvas id="dvAppropriationStatus" class="w-full h-96"></canvas>
            </div>
        </div>

        <!-- Inventory Table -->
        <div class="bg-white p-4 border rounded shadow w-1/2">
            <h3 class="text-center font-semibold mb-2">Inventory of DVs on Hand</h3>
            <div class="relative">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Program</th>
                            <th class="border px-4 py-2">No. of DV's</th>
                            <th class="border px-4 py-2">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // DV Appropriation Status - Pie Chart
    var ctxPie = document.getElementById('dvAppropriationStatus').getContext('2d');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Continuing', 'Current'],
            datasets: [{
                data: [29, 1173],
                backgroundColor: ['#FF6384', '#36A2EB'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>
