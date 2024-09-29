<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="text-gray-900"></div>

            <div class="p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-blue-900 mb-2">Activity Logs</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border-collapse">
                        <thead>
                            <tr>
                                <th class="py-2 px-3 border-b border-gray-200 text-sm">Date</th>
                                <th class="py-2 px-3 border-b border-gray-200 text-sm">Section</th>
                                <th class="py-2 px-3 border-b border-gray-200 text-sm">DSWD ID</th>
                                <th class="py-2 px-3 border-b border-gray-200 text-sm">User</th>
                                <th class="py-2 px-3 border-b border-gray-200 text-sm">DV Number / ORS Number</th>
                                <th class="py-2 px-3 border-b border-gray-200 text-sm">Action</th>
                                <th class="py-2 px-3 border-b border-gray-200 text-sm">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr class="hover:bg-blue-100 transition duration-150 ease-in-out">
                                    <td class="py-2 px-3 border-b border-gray-200 text-sm">{{ $log->created_at->setTimezone('Asia/Manila')->format('Y-m-d h:i A') }}</td>
                                    <td class="py-2 px-3 border-b border-gray-200 text-sm">{{ $log->section }}</td>
                                    <td class="py-2 px-3 border-b border-gray-200 text-sm">{{ $log->dswd_id }}</td>
                                    <td class="py-2 px-3 border-b border-gray-200 text-sm">{{ $log->user_name }}</td>
                                    <td class="py-2 px-3 border-b border-gray-200 text-sm">{{ $log->dv_no }}</td>
                                    <td class="py-2 px-3 border-b border-gray-200 text-sm">{{ $log->action }}</td>
                                    <td class="py-2 px-3 border-b border-gray-200 text-sm">{{ $log->details }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-2 px-3 border-b border-gray-200 text-center text-sm">No activity logs found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
