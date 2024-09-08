<div class="py-12">
   <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
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
                        class="inline-block w-full max-w-4xl p-4 mt-2 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-6xl">

                        <form wire:submit.prevent="saveEntry">
                           @csrf
                           <div class="p-2">
                              <div class="text-lg font-bold mb-2 text-center">Create New Budget Entry</div>

                              @if ($errors->any())
                          <div class="bg-red-100 text-red-700 border border-red-400 rounded px-4 py-2 mb-4">
                            <strong>Error:</strong> Please correct the highlighted fields.
                          </div>
                       @endif

                              <!-- DV No., Account ID, and DRN No. -->
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-2">
                                 <div>
                                    <label class="block text-sm font-medium text-gray-700">Drn No.</label>
                                    <input type="text" wire:model="drn_no" class="border rounded px-4 py-2 w-full">
                                    @error('drn_no') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                 </div>
                                 <div>
                                    <label class="block text-sm font-medium text-gray-700">DV No.</label>
                                    <input type="text" wire:model="dv_no" class="border rounded px-4 py-2 w-full">
                                    @error('dv_no') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                 </div>
                                 <div>
                                    <label class="block text-sm font-medium text-gray-700">Program</label>
                                    <input type="text" wire:model="program" class="border rounded px-4 py-2 w-full">
                                    @error('program') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                 </div>
                              </div>

                              <!-- Payee, Particulars, and Controller -->
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-2">
                                 <div>
                                    <label class="block text-sm font-medium text-gray-700">Particulars</label>
                                    <input type="text" wire:model="particulars" class="border rounded px-4 py-2 w-full">
                                    @error('particulars') <span class="text-red-600 text-sm">{{ $message }}</span>
                           @enderror
                                 </div>
                                 <div>
                                    <label class="block text-sm font-medium text-gray-700">Fund Cluster</label>
                                    <select wire:model="fund_cluster" class="border rounded px-4 py-2 w-full">
                                       <option value="FUND 101">FUND 101</option>
                                       <option value="FUND 102">FUND 102</option>
                                       <option value="FUND 171">FUND 171</option>
                                       <option value="TRUST FUND">TRUST FUND</option>
                                    </select>
                                    @error('fund_cluster') <span class="text-red-600 text-sm">{{ $message }}</span>
                           @enderror
                                 </div>
                                 <div>
                                    <label class="block text-sm font-medium text-gray-700">Budget Controller</label>
                                    <input type="text" wire:model="budget_controller"
                                       class="border rounded px-4 py-2 w-full">
                                    @error('budget_controller') <span class="text-red-600 text-sm">{{ $message }}</span>
                           @enderror
                                 </div>
                              </div>

                              <!-- Gross Amount, Final Amount NORSA, ORS No. -->
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-2">
                                 <div>
                                    <label class="block text-sm font-medium text-gray-700">Gross Amount</label>
                                    <input type="number" step="0.01" wire:model="gross_amount"
                                       class="border rounded px-4 py-2 w-full">
                                    @error('gross_amount') <span class="text-red-600 text-sm">{{ $message }}</span>
                           @enderror
                                 </div>
                                 <div>
                                    <label class="block text-sm font-medium text-gray-700">ORS No.</label>
                                    <input type="text" wire:model="orsNum" class="border rounded px-4 py-2 w-full">
                                    @error('orsNum') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                 </div>
                                 <div>
                                    <label class="block text-sm font-medium text-gray-700">Final Amount NORSA</label>
                                    <input type="number" step="0.01" wire:model="final_amount_norsa"
                                       class="border rounded px-4 py-2 w-full">
                                    @error('final_amount_norsa') <span
                              class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                 </div>
                              </div>

                              <!-- Payee, Appropriation -->
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                                 <div>
                                    <label class="block text-sm font-medium text-gray-700">Payee</label>
                                    <input type="text" wire:model="payee" class="border rounded px-4 py-2 w-full">
                                    @error('payee') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                 </div>
                                 <div>
                                    <label class="block text-sm font-medium text-gray-700">Appropriation</label>
                                    <input type="text" wire:model="appropriation"
                                       class="border rounded px-4 py-2 w-full">
                                    @error('appropriation') <span class="text-red-600 text-sm">{{ $message }}</span>
                           @enderror
                                 </div>
                              </div>

                              <!-- Incoming Date, Outgoing Date -->
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                                 <div>
                                    <label class="block text-sm font-medium text-gray-700">Incoming Date</label>
                                    <input type="date" wire:model="incomingDate"
                                       class="border rounded px-4 py-2 w-full">
                                    @error('incomingDate') <span class="text-red-600 text-sm">{{ $message }}</span>
                           @enderror
                                 </div>
                                 <div>
                                    <label class="block text-sm font-medium text-gray-700">Outgoing Date</label>
                                    <input type="date" wire:model="outgoingDate"
                                       class="border rounded px-4 py-2 w-full">
                                    @error('outgoingDate') <span class="text-red-600 text-sm">{{ $message }}</span>
                           @enderror
                                 </div>
                              </div>

                              <!-- Remarks -->
                              <div class="mb-4">
                                 <label class="block text-sm font-medium text-gray-700">Remarks</label>
                                 <textarea wire:model="remarks" class="border rounded px-4 py-2 w-full"></textarea>
                                 @error('remarks') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                              </div>

                              <!-- Action -->
                              <div class="mb-4 text-center">
                                 <label class="block text-sm font-medium text-gray-700">Action</label>
                                 <select wire:model="status"
                                    class="border-1 border-solid rounded text-center px-4 py-2 mx-auto">
                                    <option value="">Select Action</option>
                                    <option value="">Select Action</option>
                                    <option value="FOR PROCESSING">FOR PROCESSING</option>
                                    <option value="FORWARD TO ACCOUNTING">FORWARD TO ACCOUNTING</option>
                                    <option value="FORWARD TO ARDA">FORWARD TO ARDA</option>
                                    <option value="FORWARD TO ARDO">FORWARD TO ARDO</option>
                                    <option value="FORWARD TO BAC">FORWARD TO BAC</option>
                                    <option value="FORWARD TO CASH">FORWARD TO CASH</option>
                                    <option value="FORWARD TO CHIEF - FMD">FORWARD TO CHIEF - FMD</option>
                                    <option value="FORWARD TO DRMD">FORWARD TO DRMD</option>
                                    <option value="FORWARD TO END USER">FORWARD TO END USER</option>
                                    <option value="FORWARD TO HRMDD">FORWARD TO HRMDD</option>
                                    <option value="FORWARD TO ORD">FORWARD TO ORD</option>
                                    <option value="FORWARD TO PPD">FORWARD TO PPD</option>
                                    <option value="FORWARD TO PROCUREMENT">FORWARD TO PROCUREMENT</option>
                                    <option value="FORWARD TO PROMOTIVE SERVICES DIVISION">FORWARD TO PROMOTIVE SERVICES
                                       DIVISION</option>
                                    <option value="FORWARD TO PROTECTIVE SERVICES DIVISION">FORWARD TO PROTECTIVE
                                       SERVICES DIVISION</option>
                                    <option value="FORWARD TO RECORDS">FORWARD TO RECORDS</option>
                                    <option value="FORWARD TO SUPPLY">FORWARD TO SUPPLY</option>
                                    <option value="RETURN TO END USER">RETURN TO END USER</option>
                                    <option value="RETURN TO BUDGET">RETURN TO BUDGET</option>
                                 </select>
                                 @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                              </div>

                              <!-- Buttons -->
                              <div class="text-right">
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
               </div>

               <!-- Create New Entry Button -->
               <div class="flex justify-between items-center ">
                  <button
                     class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
                     @click="modelOpen = true">Create New
                     Entry</button>
               </div>





            </div>

            <!-- Search Input -->
            <div class="mb-1 flex items-center justify-between">
               <input type="text" placeholder="Search..." wire:model.live.debounce.500ms="search"
                  class="border rounded p-2 w-64" />

               <!-- Alerts -->
               <div class="flex space-x-4">
                  @if (session()->has('error'))
                 <div x-data="{ show: true }" x-show="show"
                   class="bg-red-100 text-red-800 border border-red-300 rounded-md px-4 py-2 text-sm relative">
                   {{ session('error') }}
                   <button @click="show = false" class="absolute top-1 right-1 text-red-600 hover:text-red-800">
                     &times;
                   </button>
                 </div>
              @endif

                  @if (session()->has('message'))
                 <div x-data="{ show: true }" x-show="show"
                   class="bg-green-100 text-green-800 border border-green-300 rounded-md px-4 py-2 text-sm relative">
                   {{ session('message') }}
                   <button @click="show = false" class="absolute top-1 right-1 text-green-600 hover:text-green-800">
                     &times;
                   </button>
                 </div>
              @endif
               </div>

               <select wire:model="perPage" class="border rounded px-8 py-2 mb-4">
                  <option value="5">5 per page</option>
                  <option value="10">10 per page</option>
                  <option value="25">25 per page</option>
               </select>
            </div>

            <!-- Table Wrapper for Horizontal Scrolling -->
            <div class="min-h-[35rem] overflow-x-auto">
               <div class="max-h-[40rem] overflow-y-auto">
                  <table class="min-w-full bg-white">
                     <thead class="bg-blue-500 text-white sticky top-0">
                        <tr>
                           <th class="py-2 px-4 text-center font-bold min-w-[50px]">ID No.</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">DRN No.</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">DV No.</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">Incoming Date</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">Payee</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">Particulars</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">Program/Unit</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">Budget Controller Assigned</th>
                           <th class="py-2 px-4 text-right font-bold min-w-[150px]">Gross Amount</th>
                           <th class="py-2 px-4 text-right font-bold min-w-[150px]">Final Amount</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">Fund Cluster</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">Appropriation</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">Remarks</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">ORS No.</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">Outgoing Date</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">Status</th>
                           <th class="py-2 px-4 text-center font-bold min-w-[150px]">Actions</th>
                        </tr>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse($budgetRecords as $entry)
                     <tr class="hover:bg-gray-100 cursor-pointer">
                        <td class="py-2 px-2 border-b border-r border-l border-gray-300 text-center">{{ $entry->id }}
                        </td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">{{ $entry->drn_no }}</td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">{{ $entry->dv_no }}</td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">{{ $entry->incomingDate}}
                        </td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">{{ $entry->payee }}</td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">{{ $entry->particulars }}
                        </td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">{{ $entry->program }}
                        </td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">
                          {{ $entry->budget_controller }}
                        </td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">
                          ₱{{ number_format($entry->gross_amount, 2) }}
                        </td>
                        <td class="py-2 px-4 border-b border-r border-gray-300 text-center">
                          ₱{{ number_format($entry->final_amount_norsa, 2) }}
                        </td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">
                          {{ $entry->fund_cluster }}
                        </td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">
                          {{ $entry->appropriation }}
                        </td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">{{ $entry->remarks }}
                        </td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">{{ $entry->orsNum }}</td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">
                          {{ $entry->outgoingDate }}
                        </td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">
                          {{ ucfirst($entry->status) }}
                        </td>
                        <td class="py-2 px-2 border-b border-r border-gray-300 text-center">
                          <button wire:click="sendToAccounting({{ $entry->id }})"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <!-- SVG Icon -->
                            <svg class="h-5 w-5 text-white mr-2" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round">
                              <line x1="22" y1="2" x2="11" y2="13" />
                              <polygon points="22 2 15 22 11 13 2 9 22 2" />
                            </svg>
                            <!-- Button Text -->
                            Forward to Accounting
                          </button>


                        </td>

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
            <div class="mt-1">
               {{ $budgetRecords->links() }}
            </div>
         </div>


      </div>
   </div>
</div>

</div>