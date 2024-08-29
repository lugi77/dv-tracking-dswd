<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                                    <label for="dvNum" class="block text-sm font-medium text-gray-700">DV No.</label>
                                                    <input type="text" id="dvNum" wire:model.defer="dvNum" class="border rounded px-4 py-2 w-full">
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
                                                    <label for="action" class="block text-sm font-medium text-gray-700">Action</label>
                                                    <select id="action" wire:model.defer="action" class="border rounded px-4 py-2 w-full">
                                                        <option value="">Select Action</option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="Deny">Deny</option>
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
                        <input type="text" placeholder="Search..." wire:model.live.debounce.500ms="search"
                            class="border rounded p-2 w-64" />

                        <div>
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center ml-auto">
                            <!-- Pagination -->
                            <select wire:model="perPage" class="border rounded px-4 py-2 mr-2">
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
                                <thead class="bg-green-600 text-white sticky top-0">
                                    <tr>
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">Date
                                            Received</th>
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">DV No</th>
            
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">Payment Type
                                        </th>
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">Check/ADA No
                                        </th>
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">Gross Amount
                                        </th>
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">Net Amount
                                        </th>
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">Final Net
                                            Amount</th>
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">Date Issued
                                        </th>
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">Receipt No
                                        </th>
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">Payee</th>
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">Particulars
                                        </th>
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">Remarks</th>
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">Outgoing
                                            Date</th>
                                        <th class="py-2 px-2 text-center border-b border-r border-gray-300">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($cashRecords as $record)
                                        <tr @click="$wire.editEntry({{ $record->id }}); modelOpen = true;">
                                            <td class="py-2 px-2 border-b border-r border-gray-300">
                                                {{ $record->date_received }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->dvNum }}
                                            </td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">
                                                {{ $record->payment_type }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">
                                                {{ $record->check_ada_no }}</td>
                                            <td class="py-2 px-2 text-right border-b border-r border-gray-300">
                                                {{ $record->gross_amount }}</td>
                                            <td class="py-2 px-2 text-right border-b border-r border-gray-300">
                                                {{ $record->net_amount }}</td>
                                            <td class="py-2 px-2 text-right border-b border-r border-gray-300">
                                                {{ $record->final_net_amount }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">
                                                {{ $record->date_issued }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">
                                                {{ $record->receipt_no }}</td>
                                                <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->payee }}
                                            </td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">
                                                {{ $record->particulars }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->remarks }}
                                            </td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">
                                                {{ $record->outgoing_date }}</td>
                                            <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->action }}
                                            </td>
                                        </tr>
                                    @endforeach
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