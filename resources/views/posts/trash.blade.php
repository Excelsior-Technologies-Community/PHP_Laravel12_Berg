<!DOCTYPE html>
<html>
<head>
    <title>Trash Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">🗑️ Trash Posts</h1>

        <a href="{{ route('posts.index') }}"
           class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
            ← Back
        </a>
    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <!-- EMPTY STATE -->
    @if($posts->isEmpty())
        <div class="bg-white p-10 text-center rounded-xl shadow">
            <p class="text-gray-500 text-lg">No trashed posts found 🧹</p>
        </div>
    @else

    <!-- TABLE -->
    <div class="bg-white shadow-lg rounded-xl overflow-x-auto">

        <table class="w-full text-sm text-left">

            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Title</th>
                    <th class="p-3">Created At</th>
                    <th class="p-3">Deleted At</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($posts as $post)
                <tr class="border-b hover:bg-gray-50 transition">

                    <!-- ID -->
                    <td class="p-3 font-semibold text-gray-700">
                        {{ $post->id }}
                    </td>

                    <!-- TITLE -->
                    <td class="p-3">
                        {{ $post->title }}
                    </td>

                    <!-- CREATED AT -->
                    <td class="p-3 text-gray-500">
                        {{ $post->created_at }}
                    </td>

                    <!-- DELETED AT -->
                    <td class="p-3 text-red-500 font-medium">
                        {{ $post->deleted_at }}
                    </td>

                    <!-- ACTIONS -->
                    <td class="p-3 flex justify-center gap-2">

                        <!-- RESTORE -->
                        <form method="POST" action="{{ route('posts.restore', $post->id) }}">
                            @csrf
                            <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                ♻ Restore
                            </button>
                        </form>

                        <!-- DELETE FOREVER -->
                        <form method="POST" action="{{ route('posts.forceDelete', $post->id) }}">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Delete permanently?')"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                ❌ Delete
                            </button>
                        </form>

                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>

    </div>
    @endif

</div>

</body>
</html>