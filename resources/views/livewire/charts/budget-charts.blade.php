<div class="container mx-auto min-h-screen px-4">
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
        <div class="bg-white p-4 border rounded shadow text-center">
            <p class="font-semibold">PROCESSED</p>
            <h2 class="text-2xl font-bold text-indigo-600">
            {{ $processedPrograms->sum('total_processed_dvs') ?? 0 }}
            </h2>
        </div>
        <div class="bg-white p-4 border rounded shadow text-center">
            <p class="font-semibold">RETURN TO END USER</p>
            <h2 class="text-2xl font-bold text-red-500">
                {{ $returnToEndUserCount }} <!-- Display count for "Return to End User" -->
            </h2>
        </div>

        <div class="bg-white p-4 border rounded shadow text-center">
            <p class="font-semibold">FOR APPROVAL</p>
            <h2 class="text-2xl font-bold text-green-600">
                {{ $forApprovalCount }} <!-- Display count for "For Approval" -->
            </h2>
        </div>
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
                            <td class="border px-4 py-2"> ₱{{ number_format($unprocessed->total_unprocessed_amount, 2) ?? 0.00 }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
