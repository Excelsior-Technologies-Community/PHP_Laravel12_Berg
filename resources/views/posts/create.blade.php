@extends('layouts.app')

@section('content')

{{-- Page Header --}}
<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Create New Post</h2>
        <p class="text-gray-500 text-sm mt-1">
            Write and publish a new article using the Laraberg editor.
        </p>
    </div>

    <a href="{{ route('posts.index') }}"
       class="text-sm font-medium text-indigo-600 hover:underline">
        ← Back to Posts
    </a>
</div>


{{-- Form Card --}}
<div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">

    <form action="{{ route('posts.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Title Field --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Post Title
            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                placeholder="Enter your post title..."
                class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                required
            >
        </div>


        {{-- Content Field --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Post Content
            </label>

            <textarea
                id="content"
                name="content"
                class="w-full min-h-[300px] rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
            >{{ old('content') }}</textarea>
        </div>


        {{-- Submit Button --}}
        <div class="flex justify-end">
            <button
                type="submit"
                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white text-sm font-semibold rounded-xl shadow-md hover:bg-indigo-700 transition duration-200"
            >
                🚀 Publish Post
            </button>
        </div>

    </form>
</div>

{{-- Laraberg Editor --}}
<!-- @laraberg('content') -->

@endsection
