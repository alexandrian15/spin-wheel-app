<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Manage Users Area
        </h2>
    </x-slot>

    <div class="py-10">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))

                <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200">
                    {{ session('success') }}
                </div>

            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl">

                <div class="p-6 overflow-x-auto">

                    <table class="w-full text-sm text-left">

                        <thead class="border-b dark:border-gray-700">

                            <tr class="text-gray-700 dark:text-gray-300">

                                <th class="py-3 px-4">ID</th>
                                <th class="py-3 px-4">Nama</th>
                                <th class="py-3 px-4">Email</th>
                                <th class="py-3 px-4">Role</th>
                                <th class="py-3 px-4">Area</th>
                                <th class="py-3 px-4">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($users as $user)

                            <tr class="border-b dark:border-gray-700">

                                <td class="py-4 px-4 text-gray-800 dark:text-gray-200">
                                    {{ $user->id }}
                                </td>

                                <td class="py-4 px-4 text-gray-800 dark:text-gray-200">
                                    {{ $user->name }}
                                </td>

                                <td class="py-4 px-4 text-gray-800 dark:text-gray-200">
                                    {{ $user->email }}
                                </td>

                                <td class="py-4 px-4">

                                    @if($user->role == 'super_admin')

                                        <span class="px-3 py-1 rounded-full text-xs bg-purple-100 text-purple-700 dark:bg-purple-900 dark:text-purple-200">
                                            Super Admin
                                        </span>

                                    @else

                                        <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200">
                                            Admin Area
                                        </span>

                                    @endif

                                </td>

                                <td class="py-4 px-4 text-gray-800 dark:text-gray-200">
                                    {{ $user->area_name ?? '-' }}
                                </td>

                                <td class="py-4 px-4">

                                    <form
                                        action="/admin/users/{{ $user->id }}"
                                        method="POST"
                                        class="flex flex-col lg:flex-row gap-2"
                                    >

                                        @csrf

                                        <select
                                            name="area_id"
                                            class="rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        >

                                            @foreach($areas as $area)

                                                <option
                                                    value="{{ $area->id }}"
                                                    {{ $user->area_id == $area->id ? 'selected' : '' }}
                                                >
                                                    {{ $area->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                        <select
                                            name="role"
                                            class="rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        >

                                            <option
                                                value="admin_area"
                                                {{ $user->role == 'admin_area' ? 'selected' : '' }}
                                            >
                                                Admin Area
                                            </option>

                                            <option
                                                value="super_admin"
                                                {{ $user->role == 'super_admin' ? 'selected' : '' }}
                                            >
                                                Super Admin
                                            </option>

                                        </select>

                                        <button
                                            type="submit"
                                            class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white transition"
                                        >
                                            Update
                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>