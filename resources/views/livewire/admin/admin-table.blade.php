<div class="py-12">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex">
                
                <div class="flex-1 p-4">
                    <h1 class="text-2xl font-bold mb-4">USER INFORMATION</h1>
                    <div class="flex mb-4">
                        <input type="text" placeholder="Search" class="border rounded p-2 flex-1" />
                        <select class="border rounded p-2 pr-8 appearance-none ml-2">
                            <option disabled selected>Section</option>
                            <option>Budget</option>
                            <option>Accounting</option>
                            <option>Cash</option>
                        </select>
                        <button class="border rounded p-2 ml-2">Pending Accounts</button>
                    </div>

                    <div class="overflow-x-auto bg-white shadow rounded-lg">
                        
                    </div>
                    <table class="min-w-full bg-white">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left border-b border-gray-300">User</th>
                                <th class="py-3 px-4 text-left border-b border-gray-300">DSWD ID</th>
                                <th class="py-3 px-4 text-left border-b border-gray-300">Email</th>
                                <th class="py-3 px-4 text-left border-b border-gray-300">Section</th>
                                <th class="py-3 px-4 text-left border-b border-gray-300">Status</th>
                                <th class="py-3 px-4 text-center border-b border-gray-300">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @isset($users)
                                @foreach($users as $user)
                                    <tr class="hover:bg-gray-100 cursor-pointer">
                                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $user->name }}</td>
                                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $user->dswd_id }}</td>
                                        <td class="py-3 px-4 border-b border-r border-gray-300">{{ $user->email }}</td>
                                        <td class="py-3 px-4 border-b border-r border-gray-300">
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
                                        <td class="py-3 px-4 border-b border-r border-gray-300">
                                            @if ($user->is_approved == 1) 
                                                Approved
                                            @else 
                                                Denied
                                            @endif
                                        </td>
                                        <td class="py-3 text-center border-b border-gray-300">
                                            <div class="flex justify-center space-x-4">
                                                <button wire:click="approveUser({{ $user->id }})"
                                                    class="bg-green-500 text-white px-4 py-2 rounded">Approve</button>
                                                <button wire:click="denyUser({{ $user->id }})"
                                                    class="bg-red-500 text-white px-4 py-2 rounded">Deny</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>

                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>