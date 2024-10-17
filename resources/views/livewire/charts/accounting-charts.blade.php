<div class="container mx-auto min-h-screen px-4">
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
        <div class="bg-white p-4 border rounded shadow text-center">
            <p class="font-semibold">Total Number of Disbursement Vouchers</p>
            <h2 class="text-2xl font-bold text-indigo-600">
            {{ $processedPayee->sum('total_processed_dvs') ?? 0 }}
            </h2>
        </div>
        <div class="bg-white p-4 border rounded shadow text-center">
            <p class="font-semibold">Total Number of Unprocessed DVs</p>
            <h2 class="text-2xl font-bold text-red-500">
            {{ $unprocessedPayee->sum('total_unprocessed_dvs') ?? 0 }}
            </h2>
        </div>
        <div class="bg-white p-4 border rounded shadow text-center">
            <p class="font-semibold">Total Net Amount</p>
            <h2 class="text-2xl font-bold text-green-600">
            ₱{{ number_format($processedPayee->sum('total_processed_amount'), 2) ?? 0.00 }}
            </h2>
        </div>
    </div>

    <div class="mb-4">
        <a href="{{ route('accounting-generatePdf') }}"
            class="bg-blue-500 text-white font-semibold py-2 px-4 rounded shadow hover:bg-blue-600">
            Download PDF
        </a>
    </div>

    <!-- Tables Section: Processed and Unprocessed DVs -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
        <!-- Processed DVs Table -->
        <div class="bg-white p-4 border rounded shadow">
            <h3 class="text-center font-semibold mb-2">Processed DVs on Hand</h3>
            <div class="relative" style="max-height: 500px; overflow-y: auto;">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-white z-10">
                        <tr>
                            <th class="border px-4 py-2 text-center">Payee</th>
                            <th class="border px-4 py-2 text-center">No. of Processed DVs</th>
                            <th class="border px-4 py-2 text-center">Total Amount Processed(After Tax)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($processedPayee as $data)
                            <tr>
                                <td class="border px-4 py-2 text-center">{{ $data->payee }}</td>
                                <td class="border px-4 py-2 text-center">{{ $data->total_processed_dvs }}</td>
                                <td class="border px-4 py-2 text-center">{{ number_format($data->total_processed_amount, 2) }}</td>
                            </tr>
                        @endforeach
                            <tr class="font-bold sticky bottom-0 bg-white z-10">
                                <td class="border px-4 py-2 text-center">Total</td>
                                <td class="border px-4 py-2 text-center">{{ $processedPayee->sum('total_processed_dvs') ?? 0 }}</td>
                                <td class="border px-4 py-2 text-center">
                                ₱{{ number_format($processedPayee->sum('total_processed_amount'), 2) ?? 0.00 }}
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Unprocessed DVs Table -->
        <div class="bg-white p-4 border rounded shadow">
            <h3 class="text-center font-semibold mb-2">Unprocessed DVs on Hand</h3>
            <div class="relative" style="max-height: 500px; overflow-y: auto;">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-white z-10">
                        <tr>
                            <th class="border px-4 py-2 text-center">Payee</th>
                            <th class="border px-4 py-2 text-center">No. of Unprocessed DVs</th>
                            <th class="border px-4 py-2 text-center">Total Amount Unprocessed(Before Tax)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unprocessedPayee as $data)
                            <tr>
                                <td class="border px-4 py-2 text-center">{{ $data->payee }}</td>
                                <td class="border px-4 py-2 text-center">{{ $data->total_unprocessed_dvs }}</td>
                                <td class="border px-4 py-2 text-center">₱{{ number_format($data->total_unprocessed_amount, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr class="font-bold sticky bottom-0 bg-white z-10">
                            <td class="border px-4 py-2 text-center">Total</td>
                            <td class="border px-4 py-2 text-center">{{ $unprocessedPayee->sum('total_unprocessed_dvs') ?? 0 }}</td>
                            <td class="border px-4 py-2 text-center">
                            ₱{{ number_format($unprocessedPayee->sum('total_unprocessed_amount'), 2) ?? 0.00 }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>