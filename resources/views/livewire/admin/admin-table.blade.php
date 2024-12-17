<div class="flex-1 p-4">
    <!-- Centered Export Button -->
    <div class="flex justify-center mb-4">
        <button wire:click="export" class="bg-green-500 text-white border rounded p-2 flex items-center gap-2">
            Export Combined Data Table to Excel
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd"
                    d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>


    <h1 class="text-2xl font-bold mb-4">USER INFORMATION</h1>

    <!-- Search and Filter Controls -->
    <div class="flex mb-4">
        <input wire:model.live.debounce.500ms="search" type="text" placeholder="Search"
            class="border rounded p-2 flex-1" />
        <button wire:click="togglePendingFilter" class="bg-blue-500 text-white border rounded p-2 ml-2">
            {{ $showPendingOnly ? 'Show All Users' : 'Show Pending Accounts' }}
        </button>
    </div>

    <!-- Table -->
    <div class="relative p-2" style="max-height: 500px; overflow-y: auto;">
        <table class="min-w-full bg-gray-100">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="border py-3 px-4 text-left">User</th>
                    <th class="border py-3 px-4 text-left">DSWD ID</th>
                    <th class="border py-3 px-4 text-left">Email</th>
                    <th class="border py-3 px-4 text-left">Section</th>
                    <th class="border py-3 px-4 text-left">Status</th>
                    <th class="border py-3 px-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @isset($users)
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-100 cursor-pointer">
                            <td class="border py-3 px-4">{{ $user->name }}</td>
                            <td class="border py-3 px-4">{{ $user->dswd_id }}</td>
                            <td class="border py-3 px-4">{{ $user->email }}</td>
                            <td class="border py-3 px-4">
                                @if($user->section == 1)
                                    Budget
                                @elseif($user->section == 2)
                                    Accounting
                                @elseif($user->section == 3)
                                    Cash
                                @else
                                    Admin
                                @endif
                            </td>
                            <td class=" border py-3 px-4">
                                @if ($user->is_approved == 1)
                                    <h1 class="text-green-500">Approved</h1>
                                @else
                                    <h1 class="text-red-500">Pending</h1>
                                @endif
                            </td>
                            <td class="border py-3 text-center">
                                <div class="flex justify-center space-x-4">
                                    <!-- Approve Button -->
                                    <button title="Approve" wire:click="approveUser({{ $user->id }})"
                                        class="flex items-center justify-center">
                                        <svg class="h-5 w-5 text-green-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3" /></svg>
                                    </button>

                                    <!-- Deny Button -->
                                    <button title="Deny" wire:click="denyUser({{ $user->id }})" class="flex items-center justify-center">
                                    <svg class="h-5 w-5 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17" /></svg>
                                    </button>

                                    <button 
                                        title="Delete" 
                                        class="flex items-center justify-center"
                                        onclick="confirm('Are you sure you want to delete this user?') || event.stopImmediatePropagation();" 
                                        wire:click="softDeleteUser({{ $user->id }})">
                                        <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>


                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
    </div>
      <!-- Pagination -->
      {{ $users->links() }}
</div>