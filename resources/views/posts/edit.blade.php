@extends('layouts.app')

@section('content')

{{-- Page Header --}}
<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Edit Post</h2>
        <p class="text-gray-500 text-sm mt-1">
            Update your article content using the Laraberg editor.
        </p>
    </div>

    <a href="{{ route('posts.index') }}"
       class="text-sm font-medium text-indigo-600 hover:underline">
        ← Back to Posts
    </a>
</div>


{{-- Form Card --}}
<div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">

    <form action="{{ route('posts.update', $post) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Title Field --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Post Title
            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title', $post->title) }}"
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
            >{{ old('content', $post->content) }}</textarea>
        </div>


        {{-- Action Buttons --}}
        <div class="flex items-center justify-end gap-3">

            <a href="{{ route('posts.index') }}"
               class="px-5 py-3 text-sm font-semibold text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                Cancel
            </a>

            <button
                type="submit"
                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white text-sm font-semibold rounded-xl shadow-md hover:bg-indigo-700 transition duration-200"
            >
                💾 Update Post
            </button>
        </div>

    </form>
</div>

{{-- Laraberg Editor --}}
<!-- @laraberg('content') -->

@endsection
