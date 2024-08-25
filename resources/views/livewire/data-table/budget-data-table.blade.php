<div class="py-12">
   <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
         <div class="p-4 text-gray-900">

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
                        class="fixed inset-0 transition-opacity bg-gray-600 bg-opacity-50" aria-hidden="true"></div>

                     <!-- Modal Content -->
                     <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="inline-block w-full max-w-xl p-4 mt-2 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">

                        <form wire:submit.prevent="saveEntry">
                           @csrf
                           <div class="p-2">
                              <div class="text-lg font-bold mb-2 text-center">Create New Budget Entry</div>

                              <!-- DV No., Account ID, and DRN No. -->
                              <div class="flex mb-2">
                                 <input type="text" wire:model="dvNum" placeholder="DV No."
                                    class="border rounded px-4 py-2 w-full mr-2">
                                 <input type="text" wire:model="accountID" placeholder="Account ID"
                                    class="border rounded px-4 py-2 w-full mr-2">
                                 <input type="text" wire:model="drnNum" placeholder="DRN No."
                                    class="border rounded px-4 py-2 w-full">
                              </div>

                              <!-- Program ID, Controller ID, and Program -->
                              <div class="flex mb-2">
                                 <input type="text" wire:model="programID" placeholder="Program ID"
                                    class="border rounded px-4 py-2 w-full mr-2">
                                 <input type="text" wire:model="controllerID" placeholder="Controller ID"
                                    class="border rounded px-4 py-2 w-full mr-2">
                                 <input type="text" wire:model="program" placeholder="Program"
                                    class="border rounded px-4 py-2 w-full">
                              </div>

                              <!-- Payee, Particulars, and Controller -->
                              <div class="flex mb-2">
                                 <input type="text" wire:model="payee" placeholder="Payee"
                                    class="border rounded px-4 py-2 w-full mr-2">
                                 <input type="text" wire:model="particulars" placeholder="Particulars"
                                    class="border rounded px-4 py-2 w-full mr-2">
                                 <input type="text" wire:model="controller" placeholder="Controller"
                                    class="border rounded px-4 py-2 w-full">
                              </div>

                              <!-- Gross Amount and Final Amount NORSA -->
                              <div class="flex mb-2">
                                 <input type="number" step="0.01" wire:model="gross_amount" placeholder="Gross Amount"
                                    class="border rounded px-4 py-2 w-full mr-2">
                                 <input type="number" step="0.01" wire:model="final_amount_norsa"
                                    placeholder="Final Amount NORSA" class="border rounded px-4 py-2 w-full">
                              </div>

                              <!-- Fund Cluster and Appropriation -->
                              <div class="flex mb-2">
                                 <input type="text" wire:model="fund_cluster" placeholder="Fund Cluster"
                                    class="border rounded px-4 py-2 w-full mr-2">
                                 <input type="text" wire:model="appropriation" placeholder="Appropriation"
                                    class="border rounded px-4 py-2 w-full">
                              </div>

                              <!-- Incoming Date, ORS No., and Outgoing Date -->
                              <div class="flex mb-2">
                                 <input type="date" wire:model="incomingDate"
                                    class="border rounded px-4 py-2 w-full mr-2">
                                 <input type="text" wire:model="orsNum" placeholder="ORS No."
                                    class="border rounded px-4 py-2 w-full mr-2">
                                 <input type="date" wire:model="outgoingDate" class="border rounded px-4 py-2 w-full">
                              </div>

                              <!-- Remarks and Status -->
                              <textarea wire:model="remarks" placeholder="Remarks"
                                 class="border rounded px-4 py-2 w-full mb-2"></textarea>

                              <div class="flex mb-2">
                                 <select wire:model="status" class="border rounded px-4 py-2 w-full">
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled">Cancelled</option>
                                 </select>
                              </div>

                              <!-- Buttons -->
                              <div class="text-right">
                                 <button type="button"
                                    class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded"
                                    @click="$emit('closeModal')">Cancel</button>
                                 <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">Save</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>

               <!-- Create New Entry Button -->
               <div class="flex justify-between items-center ">
                  <button
                     class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
                     @click="modelOpen = true">Create New
                     Entry</button>
               </div>

               <div>
                  @if (session()->has('message'))
                 <div
                   class="flex items-center justify-between max-w-sm mx-auto mt-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md shadow-md">
                   <span class="flex items-center">
                     <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3a1 1 0 002 0V7zm-1 5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z"
                          clip-rule="evenodd" />
                     </svg>
                     {{ session('message') }}
                   </span>
                   <button class="text-green-600 hover:text-green-800"
                     onclick="this.parentElement.style.display='none';">
                     &times;
                   </button>
                 </div>
              @endif
               </div>
            </div>

            <!-- Search Input -->
            <div class="mb-1 flex items-center justify-between">
               <input type="text" placeholder="Search..." wire:model.live.debounce.500ms="search"
                  class="border rounded p-2 w-64" />

               <select wire:model="perPage" class="border rounded px-4 py-2 mb-4">
                  <option value="5">5 per page</option>
                  <option value="10">10 per page</option>
                  <option value="25">25 per page</option>
               </select>
            </div>

            <!-- Table Wrapper for Horizontal Scrolling -->
            <div class="min-h-100 overflow-x-auto">
               <div class="max-h-96 overflow-y-auto">
                  <table class="min-w-full bg-white">
                     <thead class="bg-green-600 text-white">
                        <tr>
                           <th class="py-2 px-2 text-center border-b border-r border-l border-gray-300">ID No.</th>
                           <th class="py-2 px-2 text-center border-b border-r border-gray-300">DRN No.</th>
                           <th class="py-2 px-2 text-center border-b border-r border-gray-300">DV No.</th>
                           <th class="py-2 px-2 text-center border-b border-r border-gray-300">Incoming Date</th>
                           <th class="py-2 px-2 text-center border-b border-r border-gray-300">Payee</th>
                           <th class="py-2 px-2 text-center border-b border-r border-gray-300">Particulars</th>
                           <th class="py-2 px-2 text-center border-b border-r border-gray-300">Program/Unit</th>
                           <th class="py-2 px-2 text-center border-b border-r border-gray-300">Budget Controller
                              Assigned
                           </th>
                           <th class="py-2 px-2 text-right border-b border-r border-gray-300">Gross Amount</th>
                           <th class="py-2 px-2 text-right border-b border-r border-gray-300">Final Amount</th>
                           <th class="py-2 px-2 text-center border-b border-r border-gray-300">Fund Cluster</th>
                           <th class="py-2 px-2 text-center border-b border-r border-gray-300">Appropriation</th>
                           <th class="py-2 px-2 text-center border-b border-r border-gray-300">Remarks</th>
                           <th class="py-2 px-2 text-center border-b border-r border-gray-300">ORS No.</th>
                           <th class="py-2 px-2 text-center border-b border-r border-gray-300">Outgoing Date</th>
                           <th class="py-2 px-2 text-center border-b border-r border-gray-300">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse($budgetRecords as $entry)
                     <tr>
                        <td class="py-3 px-4 border-b border-r border-l border-gray-300">{{ $entry->id }}</td>
                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $entry->drnNum }}</td>
                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $entry->dvNum }}</td>
                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $entry->incomingDate}}</td>
                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $entry->payee }}</td>
                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $entry->particulars }}</td>
                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $entry->program }}</td>
                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $entry->controller }}</td>
                        <td class="py-3 px-4 text-right border-b border-r border-gray-300">
                          ₱{{ number_format($entry->gross_amount, 2) }}
                        </td>
                        <td class="py-3 px-4 text-right border-b border-r border-gray-300">
                          ₱{{ number_format($entry->final_amount_norsa, 2) }}
                        </td>
                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $entry->fund_cluster }}</td>
                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $entry->appropriation }}</td>
                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $entry->remarks }}</td>
                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $entry->orsNum }}</td>
                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $entry->outgoingDate }}</td>
                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ ucfirst($entry->status) }}</td>
                     </tr>
                  @empty
               <tr>
                  <td colspan="16" class="py-3 px-4 border-b border-r border-gray-300 text-center">
                    No records found.
                  </td>
               </tr>
            @endforelse
                     </tbody>

                  </table>
               </div>
            </div>

            <!-- Pagination Links -->
            <div class="mt-2">
               {{ $budgetRecords->links() }}
            </div>
         </div>


      </div>
   </div>
</div>

</div>