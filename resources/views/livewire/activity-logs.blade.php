<div class="py-12">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="text-gray-900"></div>

            <div class="p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">Activity Logs</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse bg-white shadow-lg">
                        <thead>
                            <tr class="bg-blue-500 text-white">
                                <th class="py-3 px-4 text-left font-semibold">Timestamp</th>
                                <th class="py-3 px-4 text-left font-semibold">Table</th>
                                <th class="py-3 px-4 text-left font-semibold">DV Number</th>
                                <th class="py-3 px-4 text-left font-semibold">User</th>
                                <th class="py-3 px-4 text-left font-semibold">Action</th>
                                <th class="py-3 px-4 text-left font-semibold">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr class="hover:bg-blue-100 transition duration-200 ease-in-out">
                                <td class="py-3 px-4 border-b border-gray-200 text-blue-800">{{ $log->created_at->setTimezone('Asia/Manila')->format('Y-m-d h:i A') }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-blue-800">{{ $log->model_type}}</td>
                                    <td class="py-3 px-4 border-b border-gray-200 text-blue-800">{{ $log->dv_no ?? 'N/A' }}
                                    </td>
                                    <td class="py-3 px-4 border-b border-gray-200 text-blue-800">{{ $log->user_name }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200 text-blue-800">{{ $log->action }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200 text-blue-800">{{ $log->details }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-3 px-4 border-b border-gray-200 text-blue-800 text-center">No
                                        logs found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>