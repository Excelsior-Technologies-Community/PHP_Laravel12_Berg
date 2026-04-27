<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Posts</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold">All Posts</h1>
                <p class="text-gray-500">Manage your posts</p>
            </div>

            <a href="{{ route('posts.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-xl">
                + Create Post
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                {{ session('success') }}
            </div>
        @endif
        <!-- Search -->
        <form method="GET" class="flex gap-2 mb-4">
            <input type="text" name="search" class="border p-2 rounded-xl w-full" placeholder="Search posts...">

            <select name="status" class="border p-2 rounded-xl">
                <option value="">All</option>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>

            <button class="bg-black text-white px-4 rounded-xl">
                Search
            </button>

            <a href="{{ route('posts.trash') }}" class="bg-red-500 text-white px-4 py-2 rounded-xl">
                Trash
            </a>
        </form>

        <!-- Table -->
        <div class="bg-white shadow rounded-xl overflow-hidden">

            @if($posts->count())

                <table class="w-full">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Title</th>
                            <th class="p-3 text-left">Content</th>
                            <th class="p-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($posts as $post)

                            <tr class="border-b">
                                <td class="p-3 font-bold">
                                    {{ $post->id }}
                                </td>


                                <td class="p-3 font-bold">
                                    {{ $post->title }}
                                </td>

                                <td class="p-3 text-gray-600">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 80) }}
                                </td>

                                <td class="p-3 text-right space-x-2">

                                    <a href="{{ route('posts.show', $post) }}" class="bg-blue-500 text-white px-3 py-1 rounded">
                                        View
                                    </a>

                                    <a href="{{ route('posts.edit', $post) }}"
                                        class="bg-indigo-500 text-white px-3 py-1 rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="bg-red-500 text-white px-3 py-1 rounded"
                                            onclick="return confirm('Delete?')">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @else
                <p class="p-6 text-center text-gray-500">No posts found</p>
            @endif

        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $posts->links() }}
        </div>

    </div>

</body>

</html>