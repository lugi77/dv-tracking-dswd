<div>
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
        <div class="bg-gray-100 p-4 border rounded shadow text-center">
            <p class="font-semibold">PROCESSED</p>
            <h2 class="text-2xl font-bold text-indigo-600">
                {{ $processedPrograms->sum('total_processed_dvs') ?? 0 }}
            </h2>
        </div>
        <div class="bg-gray-100 p-4 border rounded shadow text-center">
            <p class="font-semibold">RETURN TO END USER</p>
            <h2 class="text-2xl font-bold text-red-500">
                {{ $returnToEndUserCount }} <!-- Display count for "Return to End User" -->
            </h2>
        </div>

        <div class="bg-gray-100 p-4 border rounded shadow text-center">
            <p class="font-semibold">FOR APPROVAL</p>
            <h2 class="text-2xl font-bold text-green-600">
                {{ $forApprovalCount }} <!-- Display count for "For Approval" -->
            </h2>
        </div>
    </div>


    <!-- Tables Section: Processed and Unprocessed DVs -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">

        <!-- Processed DVs Table -->
        <div class="bg-gray-100 p-4 border rounded shadow">
            <h3 class="text-center font-semibold mb-2">Processed DVs on Hand</h3>
            <div class="relative" style="max-height: 500px; overflow-y: auto;">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-gray-100 z-10">
                        <tr>
                            <th class="border px-4 py-2 text-center">Program</th>
                            <th class="border px-4 py-2 text-center">No. of Processed DVs</th>
                            <th class="border px-4 py-2 text-center">Total Amount Processed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($processedPrograms as $processed)
                            <tr>
                                <td class="border px-4 py-2">{{ $processed->program }}</td>
                                <td class="border px-4 py-2">{{ $processed->total_processed_dvs ?? 0 }}</td>
                                <td class="border px-4 py-2">
                                    ₱{{ number_format($processed->total_processed_amount, 2) ?? 0.00 }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="font-bold sticky bottom-0 bg-gray-100 z-10">
                            <td class="border px-4 py-2">Total</td>
                            <td class="border px-4 py-2">{{ $processedPrograms->sum('total_processed_dvs') ?? 0 }}</td>
                            <td class="border px-4 py-2">
                                ₱{{ number_format($processedPrograms->sum('total_processed_amount'), 2) ?? 0.00 }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Unprocessed DVs Table -->
        <div class="bg-gray-100 p-4 border rounded shadow">
            <h3 class="text-center font-semibold mb-2">Unprocessed DVs on Hand</h3>
            <div class="relative" style="max-height: 500px; overflow-y: auto;">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-gray-100 z-10">
                        <tr>
                            <th class="border px-4 py-2 text-center">Program</th>
                            <th class="border px-4 py-2 text-center">No. of Unprocessed DVs</th>
                            <th class="border px-4 py-2 text-center">Total Amount Unprocessed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($unprocessedPrograms as $unprocessed)
                            <tr>
                                <td class="border px-4 py-2">{{ $unprocessed->program }}</td>
                                <td class="border px-4 py-2">{{ $unprocessed->total_unprocessed_dvs ?? 0 }}</td>
                                <td class="border px-4 py-2">
                                    ₱{{ number_format($unprocessed->total_unprocessed_amount, 2) ?? 0.00 }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="font-bold sticky bottom-0 bg-gray-100 z-10">
                            <td class="border px-4 py-2">Total</td>
                            <td class="border px-4 py-2">{{ $unprocessedPrograms->sum('total_unprocessed_dvs') ?? 0 }}</td>
                            <td class="border px-4 py-2">
                                ₱{{ number_format($unprocessedPrograms->sum('total_unprocessed_amount'), 2) ?? 0.00 }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="flex justify-center mb-4">
        <a href="{{ route('budget-generatePdf') }}"
            class="bg-green-500 text-white border rounded p-2 flex items-center gap-2">
            Download PDF
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd"
                    d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z"
                    clip-rule="evenodd" />
            </svg>
        </a>
    </div>