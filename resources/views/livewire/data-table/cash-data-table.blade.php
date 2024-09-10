<div class="py-12">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <div x-data="{ modelOpen: false }" x-on:entry-saved.window="modelOpen = false">
                    <!-- Modal -->
                    <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
                        role="dialog" aria-modal="true">
                        <div
                            class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">

                            <!-- Backdrop -->
                            <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                                x-transition:enter="transition ease-out duration-300 transform"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200 transform"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="fixed inset-0 transition-opacity bg-gray-600 bg-opacity-50" aria-hidden="true">
                            </div>

                            <!-- Modal Content -->
                            <div x-cloak x-show="modelOpen"
                                x-transition:enter="transition ease-out duration-300 transform"
                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="transition ease-in duration-200 transform"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                class="inline-block w-full max-w-4xl p-4 mt-4 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-6xl">

                                <form wire:submit.prevent="saveEntry">
                                    @csrf <!-- CSRF token for form protection -->
                                    <div class="p-2">
                                        <div class="text-lg font-bold mb-2 text-center">Edit Entry</div>
                                        <div class="mt-4 space-y-4">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                                <!-- Date Received and DV No. -->
                                                <div>
                                                    <label for="date_received" class="block text-sm font-medium text-gray-700">Date Received</label>
                                                    <input type="date" id="date_received" wire:model.defer="date_received"
                                                        class="border rounded px-4 py-2 w-full">
                                                </div>
                                                <div>
                                                    <label for="dv_no" class="block text-sm font-medium text-gray-700">DV No.</label>
                                                    <input type="text" id="dv_no" wire:model.defer="dv_no" class="border rounded px-4 py-2 w-full">
                                                </div>
                                                <div>
                                                    <label for="payment_type" class="block text-sm font-medium text-gray-700">Payment Type</label>
                                                    <select id="payment_type" wire:model.defer="payment_type" class="border rounded px-4 py-2 w-full">
                                                        <option value="">Select Payment Type</option>
                                                        <option value="ADA">ADA</option>
                                                        <option value="Cheque">Cheque</option>
                                                    </select>
                                                </div>
                                        
                                                <!-- CHECK/ADA No., Gross Amount, and Net Amount -->
                                                <div>
                                                    <label for="check_ada_no" class="block text-sm font-medium text-gray-700">CHECK/ADA No.</label>
                                                    <input type="text" id="check_ada_no" wire:model.defer="check_ada_no"
                                                        class="border rounded px-4 py-2 w-full">
                                                </div>
                                                <div>
                                                    <label for="gross_amount" class="block text-sm font-medium text-gray-700">Gross Amount</label>
                                                    <input type="text" id="gross_amount" wire:model.defer="gross_amount"
                                                        class="border rounded px-4 py-2 w-full">
                                                </div>
                                                <div>
                                                    <label for="net_amount" class="block text-sm font-medium text-gray-700">Net Amount</label>
                                                    <input type="text" id="net_amount" wire:model.defer="net_amount" class="border rounded px-4 py-2 w-full">
                                                </div>
                                        
                                                <!-- Final Net Amount, Date Issued, and Receipt No. -->
                                                <div>
                                                    <label for="final_net_amount" class="block text-sm font-medium text-gray-700">Final Net Amount</label>
                                                    <input type="text" id="final_net_amount" wire:model.defer="final_net_amount"
                                                        class="border rounded px-4 py-2 w-full">
                                                </div>
                                                <div>
                                                    <label for="date_issued" class="block text-sm font-medium text-gray-700">Date Issued</label>
                                                    <input type="date" id="date_issued" wire:model.defer="date_issued" class="border rounded px-4 py-2 w-full">
                                                </div>
                                                <div>
                                                    <label for="receipt_no" class="block text-sm font-medium text-gray-700">Receipt No.</label>
                                                    <input type="text" id="receipt_no" wire:model.defer="receipt_no" class="border rounded px-4 py-2 w-full">
                                                </div>
                                        
                                                <!-- Outgoing Date, Payee, and Particulars -->
                                                <div>
                                                    <label for="outgoing_date" class="block text-sm font-medium text-gray-700">Outgoing Date</label>
                                                    <input type="date" id="outgoing_date" wire:model.defer="outgoing_date"
                                                        class="border rounded px-4 py-2 w-full">
                                                </div>
                                                <div>
                                                    <label for="payee" class="block text-sm font-medium text-gray-700">Payee</label>
                                                    <input type="text" id="payee" wire:model.defer="payee" class="border rounded px-4 py-2 w-full">
                                                </div>
                                                <div>
                                                    <label for="particulars" class="block text-sm font-medium text-gray-700">Particulars</label>
                                                    <input type="text" id="particulars" wire:model.defer="particulars" class="border rounded px-4 py-2 w-full">
                                                </div>
                                        
                                                <!-- Remarks (Full Width) and Action -->
                                                <div class="md:col-span-3">
                                                    <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                                                    <input type="text" id="remarks" wire:model.defer="remarks" class="border rounded px-4 py-2 w-full">
                                                </div>
                                                <div class="md:col-span-3">
                                                    <label for="status" class="block text-sm font-medium text-gray-700">Action</label>
                                                    <select id="status" wire:model.defer="status" class="border rounded px-4 py-2 w-full">
                                                        <option value="">Select Status</option>
                                                        <option value="Issuance Approved">Issuance Approved</option>
                                                        <option value="Forward to Accounting">Forward to Accounting</option>
                                                        <option value="Forward to Budget Unit">Forward to Budget Unit</option>
                                                        <option value="Return to Accounting">Return to Accounting</option>
                                                        <option value="Return to End User">Return to End User</option>
                                                    </select>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="p-4 text-right">
                                            <button type="button" class="bg-red-500 text-white px-4 py-2 rounded"
                                                @click="modelOpen = false">Cancel</button>
                                            <!-- Changed button to submit to work with form submission -->
                                            <button type="submit"
                                                class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                                        </div>
                                    </div>
                            </div>
                            </form>

                        </div>
                    </div>

                    <!-- Search Input -->
                    <div class="mb-4 flex items-center justify-between">
                        <!-- Search Input -->
                        <input type="text" placeholder="Search..." wire:model.live.debounce.500ms="search"
                            class="border border-gray-300 rounded-md px-4 py-2 w-64 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />

                        <!-- Alerts -->
                        <div class="flex space-x-4">
                            @if (session()->has('error'))
                                <div x-data="{ show: true }" x-show="show"
                                    class="bg-red-100 text-red-800 border border-red-300 rounded-md px-4 py-2 text-sm relative">
                                    {{ session('error') }}
                                    <button @click="show = false"
                                        class="absolute top-1 right-1 text-red-600 hover:text-red-800">
                                        &times;
                                    </button>
                                </div>
                            @endif

                            @if (session()->has('message'))
                                <div x-data="{ show: true }" x-show="show"
                                    class="bg-green-100 text-green-800 border border-green-300 rounded-md px-4 py-2 text-sm relative">
                                    {{ session('message') }}
                                    <button @click="show = false"
                                        class="absolute top-1 right-1 text-green-600 hover:text-green-800">
                                        &times;
                                    </button>
                                </div>
                            @endif
                        </div>


                        <!-- Pagination -->
                        <div class="flex items-center">
                            <select wire:model="perPage"
                                class="border border-gray-300 rounded-md px-4 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="2">2 per page</option>
                                <option value="10">10 per page</option>
                                <option value="20">20 per page</option>
                            </select>
                        </div>
                    </div>

                    <!-- Table Wrapper for Horizontal Scrolling -->
                    <div class="min-h-[35rem] overflow-x-auto">
                        <div class="max-h-[40rem] overflow-y-auto">
                        <table class="min-w-full bg-white">
                                <thead class="bg-blue-500 text-white sticky top-0">
                                    <tr>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Date Received</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">DV No</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Payment Type</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Check/ADA No</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Gross Amount</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Net Amount</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Final Net Amount</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Date Issued</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Receipt No</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[200px]">Payee</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[200px]">Particulars</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[200px]">Remarks</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Outgoing Date</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Status</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cashRecords as $record)
                                        <tr class="hover:bg-gray-100 cursor-pointer">
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->date_received }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->dv_no }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->payment_type }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->check_ada_no }}</td>
                                            <td class="py-2 px-2 text-right border-b border-r border-gray-300">₱{{number_format($record->gross_amount)}}</td>
                                            <td class="py-2 px-2 text-right border-b border-r border-gray-300">₱{{number_format($record->net_amount)}}</td>
                                            <td class="py-2 px-2 text-right border-b border-r border-gray-300">₱{{number_format($record->final_net_amount)}}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->date_issued }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->receipt_no }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->payee }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->particulars }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->remarks }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->outgoing_date }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->status }}</td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                <button @click="$wire.editEntry({{ $record->id }}); modelOpen = true;"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    <!-- SVG Icon -->
                                                    <svg class="h-5 w-5 text-white mr-2" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <path
                                                            d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                        <line x1="16" y1="5" x2="19" y2="8" />
                                                    </svg>
                                                    <!-- Button Text -->
                                                    Edit
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300" colspan="15">No Records found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>

                    </div>
                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $cashRecords->links() }}
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>