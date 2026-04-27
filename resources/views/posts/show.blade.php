<!DOCTYPE html>
<html>
<head>
    <title>View Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-4xl mx-auto p-6">

    <a href="{{ route('posts.index') }}"
       class="text-blue-600">← Back</a>

    <div class="bg-white p-6 mt-4 rounded-xl shadow">

        <h1 class="text-3xl font-bold">{{ $post->title }}</h1>

        <p class="text-gray-500 text-sm mb-4">
            {{ $post->created_at->format('d M Y') }}
        </p>

        <div class="prose max-w-none">
            {!! $post->content !!}
        </div>

    </div>

</div>

</body>
</html>