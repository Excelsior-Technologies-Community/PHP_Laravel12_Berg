<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-3xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-4">Edit Post</h1>

    <form action="{{ route('posts.update', $post) }}"
          method="POST"
          class="bg-white p-6 rounded-xl shadow space-y-4">

        @csrf
        @method('PUT')

        <input type="text"
               name="title"
               value="{{ $post->title }}"
               class="w-full border p-2 rounded-xl">

        <textarea name="content"
                  class="w-full border p-2 rounded-xl h-40">{{ $post->content }}</textarea>

        <select name="status"
                class="w-full border p-2 rounded-xl">
            <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>
                Draft
            </option>
            <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>
                Published
            </option>
        </select>

        <button class="bg-green-600 text-white px-4 py-2 rounded-xl">
            Update
        </button>

    </form>

</div>

</body>
</html>