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
                        <tr>
                            <td class="border px-4 py-2">AICS</td>
                            <td class="border px-4 py-2">1000</td>
                            <td class="border px-4 py-2">₱84,944,891.12</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">PANTAWID</td>
                            <td class="border px-4 py-2">6</td>
                            <td class="border px-4 py-2">₱788,508.92</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">GASS</td>
                            <td class="border px-4 py-2">3</td>
                            <td class="border px-4 py-2">₱186,810.00</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">ICTMS</td>
                            <td class="border px-4 py-2">3</td>
                            <td class="border px-4 py-2">₱1,126,506.72</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">SOCTECH</td>
                            <td class="border px-4 py-2">2</td>
                            <td class="border px-4 py-2">₱74,288.00</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">EPAHP</td>
                            <td class="border px-4 py-2">0</td>
                            <td class="border px-4 py-2">₱0.00</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">NHTSPR</td>
                            <td class="border px-4 py-2">1</td>
                            <td class="border px-4 py-2">₱11,400.00</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">SLP</td>
                            <td class="border px-4 py-2">2</td>
                            <td class="border px-4 py-2">₱74,353.12</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">CENTER</td>
                            <td class="border px-4 py-2">5</td>
                            <td class="border px-4 py-2">₱286,641.33</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">Total</td>
                            <td class="border px-4 py-2 font-bold">491</td>
                            <td class="border px-4 py-2 font-bold">₱87,493,399.21</td>
                        </tr>
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
