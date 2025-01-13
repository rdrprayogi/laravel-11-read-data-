@if (session('success'))
    <!-- Flash Message -->
    <div id="flash-message" class="fixed top-4 right-4 bg-green-100 text-green-800 p-4 rounded-lg shadow-md border-l-4 border-green-500 z-50">
        {{ session('success') }}
    </div>
@elseif (session('success-delete'))
    <!-- Flash Message -->
    <div id="flash-message" class="fixed top-4 right-4 bg-red-100 text-red-800 p-4 rounded-lg shadow-md border-l-4 border-red-500 z-50">
        {{ session('success-delete') }}
    </div>
@endif

<script>
    setTimeout(() => {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.style.transition = 'opacity 0.5s';
            flashMessage.style.opacity = '0';
            setTimeout(() => flashMessage.remove(), 500);
        }
    }, 3000); // 3000ms = 3 detik

    function confirmDelete(name) {
            return confirm(`Apakah anda yakin ingin menghapus pengguna dengan nama "${name}"?`);
        }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-gray-100 via-gray-200 to-gray-300 min-h-screen">
    <div class="container mx-auto py-10">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Users List</h1>


            <!-- Search Form -->
            <div class="mb-6 flex justify-between items-center">
                    <form action="{{ route('users.index') }}" method="GET" class="flex items-center w-1/2">
                        <input type="text" name="search" value="{{ request()->query('search') }}" placeholder="Search by name or email" class="w-64 px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md">
                            Search
                        </button>
                    </form>

                    <!-- Add User Button -->
                    <div class="mb-6 text-right">
                        <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">
                            Add User
                        </a>
                    </div>
            </div>




            <!-- Users Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-6 text-left text-sm font-medium text-gray-700 uppercase border-b">ID</th>
                            <th class="py-3 px-6 text-left text-sm font-medium text-gray-700 uppercase border-b">Name</th>
                            <th class="py-3 px-6 text-left text-sm font-medium text-gray-700 uppercase border-b">Email</th>
                            <th class="py-3 px-6 text-left text-sm font-medium text-gray-700 uppercase border-b">Alamat</th>
                            <th class="py-3 px-6 text-center text-sm font-medium text-gray-700 uppercase border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->index + 1 }}</td>
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap">{{ $user->alamat }}</td>
                            <td class="py-4 px-6 text-center text-sm text-gray-900 whitespace-nowrap">
                                <!-- Edit Button -->
                                <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 shadow-md">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirmDelete('{{ $user->name }}');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 shadow-md">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 text-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</body>
</html>
