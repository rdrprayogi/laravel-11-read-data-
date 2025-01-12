<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6">Users List</h1>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200">ID</th>
                        <th class="py-2 px-4 border-b border-gray-200">Name</th>
                        <th class="py-2 px-4 border-b border-gray-200">Email</th>
                        <th class="py-2 px-4 border-b border-gray-200">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- Example row -->
                    @foreach ($users as $user)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $users->firstItem() + $index }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $user->name }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $user->alamat }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
            {{ $users->links()}}
        </div>
    </div>
</body>
</html>
