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
            <div class="relative" style="height: 400px; overflow-y: auto;">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Program</th>
                            <th class="border px-4 py-2">No. of DV's</th>
                            <th class="border px-4 py-2">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td class="border px-4 py-2">ADOPTION</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">AICS</td><td class="border px-4 py-2">1000</td><td class="border px-4 py-2">₱84,944,891.12</td></tr>
                        <tr><td class="border px-4 py-2">ANGELS HAVEN</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">BANGUN</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">BFIRST</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">BTMS</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">CBB</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">CCAM</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">CCSN</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">CENTENARIAN</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">CENTER - FO RETENTION</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">CENTER (DR)</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">CLIMATE CHANGE</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">COMM BASED</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">COMPREHENSIVE</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">CRCF</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">DRRP</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">EPAHP</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">FO/PROGRAMS/CENTERS</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">FOOD STAMP</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">GASS</td><td class="border px-4 py-2">3</td><td class="border px-4 py-2">₱186,810.00</td></tr>
                        <tr><td class="border px-4 py-2">HA</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">HGW</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">HRMDD</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">ICTMS</td><td class="border px-4 py-2">3</td><td class="border px-4 py-2">₱1,126,506.72</td></tr>
                        <tr><td class="border px-4 py-2">INTERNAL AUDIT</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">ISSO</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">KC - KKB</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">KC NCDDP</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">KC PAMANA</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">KC PMNP</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">LED - SEC</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">LINGAP SA MASA</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">NHTSPR</td><td class="border px-4 py-2">1</td><td class="border px-4 py-2">₱11,400.00</td></tr>
                        <tr><td class="border px-4 py-2">PAMANA - PSB</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">PAMANA - SLP</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">PAMANA-DRMD</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">PANTAWID</td><td class="border px-4 py-2">6</td><td class="border px-4 py-2">₱788,508.92</td></tr>
                        <tr><td class="border px-4 py-2">PDPB</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">PDPS</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">PROPER</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">PWD</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">QRF</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">RRCY</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">RRPTP</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">RSCC</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">SFP</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">SLP</td><td class="border px-4 py-2">2</td><td class="border px-4 py-2">₱74,353.12</td></tr>
                        <tr><td class="border px-4 py-2">SMS</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">SOCPEN</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">SOCTECH</td><td class="border px-4 py-2">2</td><td class="border px-4 py-2">₱74,288.00</td></tr>
                        <tr><td class="border px-4 py-2">STANDARDS</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">STB</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">SWIDB</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">TARA</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">TCT</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
                        <tr><td class="border px-4 py-2">TRUST FUND</td><td class="border px-4 py-2">0</td><td class="border px-4 py-2">₱0.00</td></tr>
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
