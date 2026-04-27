<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-3xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-4">Create Post</h1>

    <form action="{{ route('posts.store') }}" method="POST"
          class="bg-white p-6 rounded-xl shadow space-y-4">

        @csrf

        <input type="text"
               name="title"
               placeholder="Title"
               class="w-full border p-2 rounded-xl"
               required>

        <textarea name="content"
                  class="w-full border p-2 rounded-xl h-40"
                  placeholder="Content"></textarea>

        <select name="status"
                class="w-full border p-2 rounded-xl">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded-xl">
            Publish
        </button>

        <a href="{{ route('posts.index') }}"
           class="ml-3 text-gray-600">
            Cancel
        </a>

    </form>

</div>

</body>
</html>