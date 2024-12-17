<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="text-gray-900"></div>

            <div class="p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-blue-900 mb-2">Activity Logs</h2>

                @if (session()->has('message'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-4 text-green-600">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="min-h-[35rem] overflow-x-auto">
                    <div class="max-h-[40rem] overflow-y-auto">
                        <table class="min-w-full bg-gray-100 border-collapse">
                            <thead>
                                <tr>
                                    <th class="py-2 px-3 border-b border-gray-200 text-sm"></th>
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
                                        <td class="py-2 px-3 border-b border-gray-200 text-sm">
                                            <input type="checkbox" value="{{ $log->id }}" wire:model="selectedLogs" class="form-checkbox">
                                        </td>
                                        <td class="py-2 px-3 border-b border-gray-200 text-sm">
                                            {{ $log->created_at->setTimezone('Asia/Manila')->format('Y-m-d h:i A') }}
                                        </td>
                                        <td class="py-2 px-3 border-b border-gray-200 text-sm">{{ $log->section }}</td>
                                        <td class="py-2 px-3 border-b border-gray-200 text-sm">{{ $log->dswd_id }}</td>
                                        <td class="py-2 px-3 border-b border-gray-200 text-sm">{{ $log->user_name }}</td>
                                        <td class="py-2 px-3 border-b border-gray-200 text-sm">{{ $log->dv_no }}</td>
                                        <td class="py-2 px-3 border-b border-gray-200 text-sm">{{ $log->action }}</td>
                                        <td class="py-2 px-3 border-b border-gray-200 text-sm">{{ $log->details }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="py-2 px-3 border-b border-gray-200 text-center text-sm">No activity logs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        @if ($logs->count())
                            <div class="flex justify-between mt-4">
                                <button @click="$dispatch('confirm-delete-selected')" class="bg-red-500 text-white px-4 py-2 rounded">Delete Selected</button>
                                <button @click="$dispatch('confirm-delete-all')" class="bg-red-700 text-white px-4 py-2 rounded">Delete All</button>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    {{ $logs->links() }} <!-- Pagination links -->
                </div>

                <!-- Confirmation Dialog for Delete Selected -->
                <div x-data="{ open: false }" @confirm-delete-selected.window="open = true">
                    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm">
                            <h3 class="text-lg font-semibold">Confirm Deletion</h3>
                            <p class="mt-2">Are you sure you want to delete the selected logs?</p>
                            <div class="flex justify-end mt-4">
                                <button @click.prevent="open = false" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                                <button @click.prevent="open = false; @this.deleteSelected()" class="bg-red-500 text-white px-4 py-2 rounded ml-2">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Confirmation Dialog for Delete All -->
                <div x-data="{ open: false }" @confirm-delete-all.window="open = true">
                    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm">
                            <h3 class="text-lg font-semibold">Confirm Deletion</h3>
                            <p class="mt-2">Are you sure you want to delete all logs?</p>
                            <div class="flex justify-end mt-4">
                                <button @click.prevent="open = false" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                                <button @click.prevent="open = false; @this.deleteAll()" class="bg-red-700 text-white px-4 py-2 rounded ml-2">Delete All</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
