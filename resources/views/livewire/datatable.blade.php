<x-layouts.datatable-layouts>
    {{-- Editable Component --}}

    {{-- Table headers --}}
    <x-slot:theaders>
        @foreach ($theaders as $th)
            @include('components.includes.table-sortable-th', $th)
        @endforeach
        <th scope="col" class="px-4 py-3">
            <span class="sr-only">Actions</span>
        </th>
    </x-slot:theaders>

    {{-- Dropdown filters --}}
    <x-slot:dropdown_filters>
        <div class="flex space-x-3">
            <div class="flex space-x-3 items-center">
                <label class="w-40 text-sm font-medium text-gray-900">User Type :</label>
                <select wire:model.live="roleFilter"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="">All</option>
                    <option value="0">User</option>
                    <option value="1">Admin</option>
                </select>
            </div>
        </div>
    </x-slot:dropdown_filters>

    {{-- Table bottom side --}}
    <x-slot:table_footer>
        Current page: {{ $users->currentPage() }}
        {{ $users->links() }}
    </x-slot:table_footer>

    {{-- Slot --}}
    @foreach ($users as $user)
        <tr wire:key="{{ $user->id }}" class="border-b dark:border-gray-700">
            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $user->name }}</th>
            <td class="px-4 py-3">{{ $user->email }}</td>
            <td class="px-4 py-3 {{ $user->is_admin ? 'text-green-500' : 'text-blue-500' }}">
                {{ $user->is_admin ? 'Admin' : 'Member' }}</td>
            <td class="px-4 py-3">{{ $user->created_at }}</td>
            <td class="px-4 py-3">{{ $user->updated_at }}</td>
            <td class="px-4 py-3 flex items-center justify-end">
                <button @click="openModal({{ $user->id }})" data-modal-target="popup-modal"
                    data-modal-toggle="popup-modal" class="px-3 py-1 bg-red-500 text-white rounded"
                    wire:loading.class="bg-blue-600" wire:target="deleteUser({{ $user->id }})">X
                </button>
            </td>
        </tr>
    @endforeach
</x-layouts.datatable-layouts>
