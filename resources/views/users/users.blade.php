@extends('layouts.dashboard')
@section('content')

    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold">System Users</h1>
            <button onclick="toggleModal()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>Add New User
            </button>
        </div>

        <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-700">
            <table class="w-full text-left">
                <thead class="bg-gray-700 text-gray-300 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">Full Name</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <tr class="hover:bg-gray-750 transition">
                        <td class="px-6 py-4 font-medium">John Doe</td>
                        <td class="px-6 py-4 text-gray-400">john@example.com</td>
                        <td class="px-6 py-4"><span
                                class="px-2 py-1 bg-purple-900 text-purple-200 text-xs rounded-full">Admin</span></td>
                        <td class="px-6 py-4 text-green-400 text-sm">Active</td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-blue-400 hover:text-blue-300 mr-3"><i class="fas fa-edit"></i></button>
                            <button class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="userModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-gray-800 rounded-xl w-full max-w-md p-6 border border-gray-700">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold">User Details</h2>
                <button onclick="toggleModal()" class="text-gray-400 hover:text-white">&times;</button>
            </div>

            <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm text-gray-400 mb-1">Full Name</label>
                    <input type="text" name="name"
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Enter name" required>
                </div>

                <div>
                    <label class="block text-sm text-gray-400 mb-1">Email Address</label>
                    <input type="email" name="email"
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="email@domain.com" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Password</label>
                        <input type="password" name="password"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="••••••••" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="••••••••" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm text-gray-400 mb-1">Role</label>
                    <select name="role"
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="user">User</option>
                        <option value="editor">Editor</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 py-2 rounded-lg font-medium">Save
                        User</button>
                    <button type="button" onclick="toggleModal()"
                        class="flex-1 bg-gray-700 hover:bg-gray-600 py-2 rounded-lg font-medium">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('userModal');
            modal.classList.toggle('hidden');
        }
    </script>
@endsection
