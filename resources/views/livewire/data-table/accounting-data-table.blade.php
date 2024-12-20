<div class="py-12">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <div x-data="{ modelOpen: false }" x-on:entry-saved.window="modelOpen = false">
                    <!-- Modal -->
                    <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
                        role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">

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
                                <div class="p-2">
                                   
                                     <form wire:submit.prevent="saveEntry">
                
                                            @if ($errors->any())
                                                <div class="bg-red-100 text-red-700 border border-red-400 rounded px-4 py-2 mb-4">
                                                    <strong>Error:</strong> Please correct the highlighted fields.
                                                </div>
                                            @endif

                                            @if (session()->has('error-dv'))
                                                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                                                    class="mb-4 text-green-600">
                                                    {{ session('error-dv') }}
                                                </div>
                                            @endif
                                        
                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                            <div class="px-2">
                                                <label class="block text-sm font-medium text-gray-700">Date Received</label>
                                                <input type="date" wire:model.defer="date_received" class="text-gray-400 border rounded px-4 py-2 w-full" readonly>
                                                @error('date_received') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="px-2">
                                                <label class="block text-sm font-medium text-gray-700">DV Number</label>
                                                <input type="text" wire:model.defer="dv_no" class="border rounded px-4 py-2 w-full" >
                                                @error('dv_no') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="px-2">
                                                <label class="block text-sm font-medium text-gray-700">AP Number</label>
                                                <input type="text" wire:model.defer="ap_no" class="border rounded px-4 py-2 w-full">
                                                @error('ap_no') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="px-2">
                                                <label class="block text-sm font-medium text-gray-700">Final Gross Amount</label>
                                                <input type="number" wire:model.defer="gross_amount" class="text-gray-400 border rounded px-4 py-2 w-full" readonly>
                                                @error('gross_amount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="px-2">
                                                <label class="block text-sm font-medium text-gray-700">Tax</label>
                                                <input type="number" wire:model.defer="tax" class="border rounded px-4 py-2 w-full">
                                                @error('tax') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="px-2">
                                                <label class="block text-sm font-medium text-gray-700">Other Deductions</label>
                                                <input type="number" wire:model.defer="other_deduction" class="border rounded px-4 py-2 w-full">
                                                @error('other_deduction') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="px-2">
                                                <label class="block text-sm font-medium text-gray-700">Program</label>
                                                <input type="text" wire:model.defer="program" class="text-gray-400 border rounded px-4 py-2 w-full" readonly>
                                                @error('program') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="px-2">
                                                <label class="block text-sm font-medium text-gray-700">Date Returned to End User</label>
                                                <input type="date" wire:model.defer="date_returned_to_end_user" class="border rounded px-4 py-2 w-full">
                                                @error('date_returned_to_end_user') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="px-2">
                                                <label class="block text-sm font-medium text-gray-700">Date Complied to End User</label>
                                                <input type="date" wire:model.defer="date_complied_to_end_user" class="border rounded px-4 py-2 w-full">
                                                @error('date_complied_to_end_user') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="px-2">
                                                <label class="block text-sm font-medium text-gray-700">Outgoing Processor</label>
                                                <input type="text" wire:model.defer="outgoing_processor" class="border rounded px-4 py-2 w-full">
                                                @error('outgoing_processor') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="px-2">
                                                <label class="block text-sm font-medium text-gray-700">Outgoing Certifier</label>
                                                <input type="text" wire:model.defer="outgoing_certifier" class="border rounded px-4 py-2 w-full">
                                                @error('outgoing_certifier') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                            </div>
                            
                                            <div class="px-2">
                                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                                <select wire:model.defer="status"
                                                    class="border rounded px-4 py-2 w-full">
                                                    <option value="Processing">Processing</option>
                                                    <option value="Forward to ARDA">Forward to ARDA</option>
                                                    <option value="Forward to ARDO">Forward to ARDO</option>
                                                    <option class="text-green-500" value="Forward to Cash">Forward to Cash</option>
                                                    <option value="Forward to Chief - FMD">Forward to Chief - FMD
                                                    </option>
                                                    <option value="Forward to DRMD">Forward to DRMD</option>
                                                    <option value="Forward to HRMDD">Forward to HRMDD</option>
                                                    <option value="Forward to ORD">Forward to ORD</option>
                                                    <option value="Forward to PPD">Forward to PPD</option>
                                                    <option value="Forward to Promotive Services Division">Forward to
                                                        Promotive Services Division</option>
                                                    <option value="Forward to Protective Services Division">Forward to
                                                        Protective Services Division</option>
                                                    <option value="Forward to HR - PAS">Forward to HR - PAS</option>
                                                    <option value="Forward to Admin">Forward to Admin</option>
                                                    <option value="Return to End User">Return to End User</option>
                                                    <option class="text-orange-500" value="Return to Budget">Return to Budget</option>
                                                    <option value="Complied">Complied</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                    <option value="For Approval">For Approval</option>
                                                </select>
                                                @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="md:col-span-3">
                                                <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                                                <textarea id="remarks" wire:model.defer="remarks" class="border rounded px-4 py-2 w-full"></textarea>
                                                @error('remarks') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror                                          
                                            </div>
                                        </div>

                                </div>
                                <div class="p-4 text-right">
                                    <button type="button"
                                        class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded"
                                        @click="modelOpen = false">Cancel</button>
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">Save</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- Search Input -->
                    <div class="mb-4 flex items-center justify-between">
                        <!-- Search Input -->
                        <input type="text" placeholder="Search..." wire:model.live.debounce.500ms="search"
                            class="border-solid-gray-500 rounded-md px-4 py-2 w-64 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />

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
                                        <th wire:click="sortBy('dv_no')" class="py-2 px-4 text-center font-bold min-w-[150px] cursor-pointer">
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
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">AP Number
                                        </th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Final Gross Amount
                                        </th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Tax</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Other
                                            Deductions</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Final Net Amount
                                        </th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Program
                                        </th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Date
                                            Returned</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Date
                                            Complied</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">No. of Days
                                        </th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Outgoing
                                            Processor</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Outgoing
                                            Certifier</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Remarks</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Outgoing
                                            Date</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Status</th>
                                        <th class="py-2 px-4 text-center font-bold min-w-[150px]">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Highlight for new data or unedited entry -->
                                    @forelse ($accountingRecords as $entry)
                                    <tr class="hover:bg-gray-100 cursor-pointer 
                                        {{ $entry->created_at->gt(now()->subDay()) && $entry->updated_at == $entry->created_at ? 'bg-yellow-100' : '' }}">            
                                        <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                {{ $entry->date_received }}
                                            </td>

                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                {{ $entry->orsNum }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                {{ $entry->dv_no }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                {{ $entry->ap_no }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                ₱{{number_format($entry->gross_amount ,2) }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                {{ number_format($entry->tax) }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                ₱{{ number_format($entry->other_deduction,2) }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                 ₱{{ number_format($entry->net_amount ,2) }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                {{ $entry->program }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                {{ $entry->date_returned_to_end_user }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                {{ $entry->date_complied_to_end_user }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                {{ $entry->no_of_days }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                {{ $entry->outgoing_processor }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                {{ $entry->outgoing_certifier }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300 max-w-[50px] cursor-pointer relative"
                                                x-data="{ expanded: false, hovering: false, x: 0, y: 0}"
                                                @mouseenter="hovering = true; let rect = $el.getBoundingClientRect(); x = rect.left; y = rect.bottom;" 
                                                @mouseleave="hovering = false"
                                                @click="expanded = !expanded">

                                                <!-- Truncated Text (always shown unless clicked to expand) -->
                                                <span x-show="!expanded" class="whitespace-nowrap overflow-hidden text-ellipsis block">
                                                    {{ Str::limit($entry->remarks, 16) }} <!-- Adjust the character limit if needed -->
                                                </span>

                                                <!-- Full Text (shown when clicked to expand) -->
                                                <span x-show="expanded" class="whitespace-normal">
                                                    {{ $entry->remarks }}
                                                </span>

                                                <!-- Hover Pop-up (shown when hovered, fixed position to avoid scrolling) -->
                                                <div x-show="hovering && !expanded" 
                                                    class="fixed z-10 w-auto max-w-xs bg-white border border-gray-300 shadow-lg p-2 rounded-lg"
                                                    :style="'left:' + x + 'px; top:' + y + 'px;'"
                                                    x-cloak>
                                                    <p class="text-sm">{{ $entry->remarks }}</p>
                                                </div>
                                            </td>

                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                                {{ $entry->outgoing_date }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300"
                                                style="color: 
                                                    {{ $entry->status === 'Sent to Cash' ? '#3AC430' : 
                                                    ($entry->status === 'Sent from Budget' ? 'orange' : 
                                                    ($entry->status === 'Returned from Cash' ? 'blue' : 'inherit')) }};">
                                                {{ $entry->status }}
                                            </td>
                                            <td class="py-2 px-2 text-center border-b border-r border-gray-300">
                                            <button 
                                            @click="$wire.editEntry({{ $entry->id }}); modelOpen = true;" 
                                                :disabled="{{ $entry->status === 'Sent to Cash' ? 'true' : 'false' }}" 
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                                                :class="{ 'bg-gray-400': {{ $entry->status === 'Sent to Cash' ? 'true' : 'false' }}, 'hover:bg-gray-400': {{ $entry->status === 'Sent to Cash' ? 'true' : 'false' }} }">
                                            
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
                                                colspan="20">No Records found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $accountingRecords->links() }}
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>