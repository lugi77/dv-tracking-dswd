<div class="container mx-auto">
    <!-- Summary Cards -->
    <div class="flex justify-around mb-4">
        <div class="bg-white p-4 border rounded shadow text-center w-1/3">
            <p class="font-semibold">Total Number of Disbursement Vouchers</p>
            <h2 class="text-2xl font-bold text-indigo-600">{{ number_format($totalDvCount) }}</h2>
        </div>
        <div class="bg-white p-4 border rounded shadow text-center w-1/3">
            <p class="font-semibold">Total Number of Unprocessed DVs</p>
            <h2 class="text-2xl font-bold text-red-500">{{ number_format($totalUnprocessedCount) }}</h2>
        </div>
        <div class="bg-white p-4 border rounded shadow text-center w-1/3">
            <p class="font-semibold">Total Net Amount</p>
            <h2 class="text-2xl font-bold text-green-600">₱{{ number_format($totalAmount, 2) }}</h2>
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
        <div class="bg-white p-4 border rounded shadow w-3/4">
        <h3 class="text-center font-semibold mb-2">Inventory of DVs on Hand</h3>
        <div class="relative" style="height: 400px; overflow-y: auto;">
        <table class="w-full text-left border-collapse">
            <thead>
            <tr>
                <th class="border px-4 py-2 sticky top-0 bg-white">Program</th>
                <th class="border px-4 py-2 sticky top-0 bg-white">No. of DV's</th>
                <th class="border px-4 py-2 sticky top-0 bg-white">Amount</th>
                <th class="border px-4 py-2 sticky top-0 bg-white">Unprocessed DV</th>
                <th class="border px-4 py-2 sticky top-0 bg-white">Total Amount</th> 
            </tr>
            </thead>
            <tbody>
            @foreach($programs as $program)
                <tr>
                <td class="border px-4 py-2">{{ $program->program }}</td>
                <td class="border px-4 py-2">{{ $program->no_of_dv }}</td>
                <td class="border px-4 py-2">₱{{ number_format($program->total_amount_program, 2) }}</td>
                <td class="border px-4 py-2"></td> 
                <td class="border px-4 py-2"></td> </tr>
            @endforeach
            <tr class="border px-4 py-2 font-bold sticky bottom-0 bg-white z-10">
                <td class="border px-4 py-2 font-bold">Total</td>
                <td class="border px-4 py-2 font-bold">{{ $totalDv }}</td>
                <td class="border px-4 py-2 font-bold">₱{{ number_format($totalAmount, 2) }}</td>
                </tr>
            </tbody>
        </table>
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
                data: [{{ $continuingCount }}, {{ $currentCount }}],
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
