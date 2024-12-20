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
                                class="inline-block w-full max-w-4xl p-4 mt-4 overflow-hidden text-left transition-all transform bg-gray-100 rounded-lg shadow-xl 2xl:max-w-6xl">

                                <form wire:submit.prevent="saveEntry">
                                    @csrf
                                    <div class="p-2">
                                        <div class="text-lg font-bold mb-2 text-center">Edit Entry</div>
                                        <div class="mt-4 space-y-4">
                                            @if ($errors->any())
                                                <div
                                                    class="bg-red-100 text-red-700 border border-red-400 rounded px-4 py-2 mb-4">
                                                    <strong>Error:</strong> Please correct the highlighted fields.
                                                </div>
                                            @endif

                                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                                <!-- Date Received and DV No. -->
                                                <div>
                                                    <label for="date_received"
                                                        class="block text-sm font-medium text-gray-700">Date
                                                        Received</label>
                                                    <input type="date" id="date_received"
                                                        wire:model.defer="date_received"
                                                        class="text-gray-400 border rounded px-4 py-2 w-full" readonly>
                                                    @error('date_received') <span
                                                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                                </div>
                                                <div>
                                                    <label for="dv_no"
                                                        class="block text-sm font-medium text-gray-700">DV No.</label>
                                                    <input type="text" id="dv_no" wire:model.defer="dv_no"
                                                        class="text-gray-400 border rounded px-4 py-2 w-full" readonly>
                                                    @error('dv_no') <span
                                                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                                </div>
                                                <div>
                                                    <label for="payment_type"
                                                        class="block text-sm font-medium text-gray-700">Payment
                                                        Type</label>
                                                    <select id="payment_type" wire:model.defer="payment_type"
                                                        class="border rounded px-4 py-2 w-full">
                                                        <option value="">Select Payment Type</option>
                                                        <option value="ADA">ADA</option>
                                                        <option value="Cheque">Cheque</option>
                                                    </select>
                                                    @error('payment_type') <span
                                                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                                </div>

                                                <!-- CHECK/ADA No., Gross Amount, and Net Amount -->
                                                <div class="md:col-span-1">
                                                    <label for="payee"
                                                        class="block text-sm font-medium text-gray-700">Payee</label>
                                                    <input type="text" id="payee" wire:model.defer="payee"
                                                        class="text-gray-400 border rounded px-4 py-2 w-full" readonly>
                                                    @error('payee') <span
                                                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                                </div>
                                                <div>
                                                    <label for="gross_amount"
                                                        class="block text-sm font-medium text-gray-700">Gross
                                                        Amount</label>
                                                    <input type="text" id="gross_amount" wire:model.defer="gross_amount"
                                                        class="text-gray-400 border rounded px-4 py-2 w-full" readonly>
                                                    @error('gross_amount') <span
                                                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                                </div>
                                                <div>
                                                    <label for="net_amount"
                                                        class="block text-sm font-medium text-gray-700">Final Net
                                                        Amount</label>
                                                    <input type="text" id="net_amount" wire:model.defer="net_amount"
                                                        class="text-gray-400 border rounded px-4 py-2 w-full" readonly>
                                                    @error('net_amount') <span
                                                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                                </div>

                                                <!-- Final Net Amount, Date Issued, and Receipt No. -->
                                                <div>
                                                    <label for="date_issued"
                                                        class="block text-sm font-medium text-gray-700">Date
                                                        Issued</label>
                                                    <input type="date" id="date_issued" wire:model.defer="date_issued"
                                                        class="border rounded px-4 py-2 w-full">
                                                    @error('date_issued') <span
                                                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                                </div>
                                                <div>
                                                    <label for="receipt_no"
                                                        class="block text-sm font-medium text-gray-700">Receipt
                                                        No.</label>
                                                    <input type="text" id="receipt_no" wire:model.defer="receipt_no"
                                                        class="border rounded px-4 py-2 w-full">
                                                    @error('receipt_no') <span
                                                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                                </div>

                                                <!-- Outgoing Date, Payee, and Particulars -->
                                                <div>
                                                    <label for="outgoing_date"
                                                        class="block text-sm font-medium text-gray-700">Outgoing
                                                        Date</label>
                                                    <input type="date" id="outgoing_date"
                                                        wire:model.defer="outgoing_date"
                                                        class="border rounded px-4 py-2 w-full">
                                                    @error('outgoing_date') <span
                                                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                                </div>

                                                <div>
                                                    <label for="check_ada_no"
                                                        class="block text-sm font-medium text-gray-700">CHECK/ADA
                                                        No.</label>
                                                    <input type="text" id="check_ada_no" wire:model.defer="check_ada_no"
                                                        class="border rounded px-4 py-2 w-full">
                                                    @error('check_ada_no') <span
                                                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="md:col-span-2">
                                                    <label for="particulars"
                                                        class="block text-sm font-medium text-gray-700">Particulars</label>
                                                    <input type="text" id="particulars" wire:model.defer="particulars"
                                                        class="border rounded px-4 py-2 w-full">
                                                    @error('particulars') <span
                                                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                                </div>

                                                <!-- Remarks (Full Width) and Action -->
                                                <div class="md:col-span-3">
                                                    <label for="remarks"
                                                        class="block text-sm font-medium text-gray-700">Remarks</label>
                                                    <textarea id="remarks" wire:model.defer="remarks"
                                                        class="border rounded px-4 py-2 w-full"></textarea>
                                                    @error('remarks') <span
                                                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="md:col-span-3 text-center mx-auto">
                                                    <label for="status"
                                                        class="block text-sm font-medium text-gray-700">Action</label>
                                                    <select id="status" wire:model.defer="status"
                                                        class="border-1 border-solid rounded text-center px-4 py-2 mx-auto">
                                                        <option value="">Select Status</option>
                                                        <option class="text-green-500" value="Issuance Approved">Issuance Approved</option>
                                                        <option value="Forward to Accounting">Forward to Accounting
                                                        </option>
                                                        <option value="Forward to Budget Unit">Forward to Budget Unit
                                                        </option>
                                                        <option class="text-orange-500" value="Return to Accounting">Return to Accounting
                                                        </option>
                                                        ion value="Return to End User">Return to End User</option>
                                                    </select>
                                                    @error('status') <span
                                                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
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
                                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                                    class="mb-4 text-green-600"> {{ session('error') }}
                                </div>
                            @endif

                            @if (session()->has('message'))
                                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                                    class="mb-4 text-green-600"> {{ session('message') }}
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
                                <thead class="bg-blue-700 text-white sticky top-0 z-10">
                                    <tr>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Date Received</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">ORS Number</th>
                                        <th wire:click="sortBy('dv_no')"
                                            class="py-2 px-4 text-center font-bold min-w-[150px] cursor-pointer">
                                            DV Number
                                            @if ($sortField == 'dv_no')
                                                <span>
                                                    @if ($sortDirection == 'desc')
                                                        ▲
                                                    @else
                                                        ▼
                                                    @endif
                                                </span>
                                            @endif
                                        </th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Payment Type</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Check/ADA No</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Gross Amount</th>
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
                                    <!-- Highlight for new data or unedited entry -->
                                    @forelse($cashRecords as $record)
                                                                    <tr
                                                                        class="hover:bg-gray-100 cursor-pointer {{ $record->created_at->gt(now()->subDay()) && $record->updated_at == $record->created_at ? 'bg-yellow-100' : '' }}">
                                                                        <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                                            {{ $record->date_received }}</td>
                                                                        <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                                            {{ $record->orsNum }}</td>
                                                                        <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                                            {{ $record->dv_no }}</td>
                                                                        <td class="py-2 px-2 border-b border-r border-gray-300">
                                                                            {{ $record->payment_type }}</td>
                                                                        <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                                            {{ $record->check_ada_no }}</td>
                                                                        <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                                            ₱{{number_format($record->gross_amount)}}</td>
                                                                        <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                                            ₱{{number_format($record->net_amount)}}</td>
                                                                        <td class="py-2 px-2 border-b border-r border-gray-300">
                                                                            {{ $record->date_issued }}</td>
                                                                        <td class="py-2 px-2 border-b border-r border-gray-300">
                                                                            {{ $record->receipt_no }}</td>
                                                                        <td class="py-2 px-2 border-b border-r border-gray-300">{{ $record->payee }}
                                                                        </td>
                                                                        <td class="py-2 px-2 text-center border-b border-r border-gray-300 max-w-[50px] cursor-pointer relative"
                                                                            x-data="{ expanded: false, hovering: false, x: 0, y: 0}"
                                                                            @mouseenter="hovering = true; let rect = $el.getBoundingClientRect(); x = rect.left; y = rect.bottom;"
                                                                            @mouseleave="hovering = false" @click="expanded = !expanded">

                                                                            <!-- Truncated Text (always shown unless clicked to expand) -->
                                                                            <span x-show="!expanded"
                                                                                class="whitespace-nowrap overflow-hidden text-ellipsis block">
                                                                                {{ Str::limit($record->particulars, ) }}
                                                                                <!-- Adjust the character limit if needed -->
                                                                            </span>

                                                                            <!-- Full Text (shown when clicked to expand) -->
                                                                            <span x-show="expanded" class="whitespace-normal">
                                                                                {{ $record->particulars }}
                                                                            </span>

                                                                            <!-- Hover Pop-up (shown when hovered, fixed position to avoid scrolling) -->
                                                                            <div x-show="hovering && !expanded"
                                                                                class="fixed z-10 w-auto max-w-xs bg-white border border-gray-300 shadow-lg p-2 rounded-lg"
                                                                                :style="'left:' + x + 'px; top:' + y + 'px;'" x-cloak>
                                                                                <p class="text-sm">{{ $record->particulars }}</p>
                                                                            </div>
                                                                        </td>
                                                                        <td class="py-2 px-2 text-center border-b border-r border-gray-300 max-w-[50px] cursor-pointer relative"
                                                                            x-data="{ expanded: false, hovering: false, x: 0, y: 0}"
                                                                            @mouseenter="hovering = true; let rect = $el.getBoundingClientRect(); x = rect.left; y = rect.bottom;"
                                                                            @mouseleave="hovering = false" @click="expanded = !expanded">

                                                                            <!-- Truncated Text (always shown unless clicked to expand) -->
                                                                            <span x-show="!expanded"
                                                                                class="whitespace-nowrap overflow-hidden text-ellipsis block">
                                                                                {{ Str::limit($record->remarks, 26) }}
                                                                                <!-- Adjust the character limit if needed -->
                                                                            </span>

                                                                            <!-- Full Text (shown when clicked to expand) -->
                                                                            <span x-show="expanded" class="whitespace-normal">
                                                                                {{ $record->remarks }}
                                                                            </span>

                                                                            <!-- Hover Pop-up (shown when hovered, fixed position to avoid scrolling) -->
                                                                            <div x-show="hovering && !expanded"
                                                                                class="fixed z-10 w-auto max-w-xs bg-white border border-gray-300 shadow-lg p-2 rounded-lg"
                                                                                :style="'left:' + x + 'px; top:' + y + 'px;'" x-cloak>
                                                                                <p class="text-sm">{{ $record->remarks }}</p>
                                                                            </div>
                                                                        </td>
                                                                        <td class="py-2 px-2 border-b border-r border-gray-300">
                                                                            {{ $record->outgoing_date }}</td>

                                                                        <td class="py-2 px-2 text-center border-b border-r border-gray-300"
                                                                            style="color: 
                                                                                {{ $record->status === 'Issuance Approved' ? '#3AC430' :
                                        ($record->status === 'Sent from Accounting' ? 'orange' : 'inherit') }};">
                                                                            {{ $record->status }}
                                                                        </td>

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
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300"
                                                colspan="15">No Records found</td>
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