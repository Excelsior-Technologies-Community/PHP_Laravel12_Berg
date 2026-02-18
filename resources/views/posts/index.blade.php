@extends('layouts.app')

@section('content')

{{-- Page Header --}}
<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">All Posts</h2>
        <p class="text-gray-500 text-sm mt-1">
            Manage, edit, and view your published articles.
        </p>
    </div>

    <a href="{{ route('posts.create') }}"
       class="inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 text-white text-sm font-semibold rounded-xl shadow-md hover:bg-indigo-700 transition">
        + Create Post
    </a>
</div>

{{-- Posts Table Card --}}
<div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

    @if($posts->count())
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                        Title
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                        Content Preview
                    </th>

                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @foreach($posts as $post)
                    <tr class="hover:bg-gray-50 transition">
                        {{-- Title --}}
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-indigo-600 transition">
                                {{ $post->title }}
                            </a>
                        </td>

                        {{-- Content Preview --}}
                        <td class="px-6 py-4 text-gray-600 text-sm max-w-md">
                            {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('posts.show', $post) }}"
                               class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                                View
                            </a>

                            <a href="{{ route('posts.edit', $post) }}"
                               class="px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                                Edit
                            </a>

                            <form action="{{ route('posts.destroy', $post) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="px-4 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-center py-16">
            <p class="text-gray-500 mb-4">No posts found.</p>

            <a href="{{ route('posts.create') }}"
               class="inline-flex items-center px-5 py-3 bg-indigo-600 text-white text-sm font-semibold rounded-xl shadow hover:bg-indigo-700 transition">
                Create Your First Post
            </a>
        </div>
    @endif

</div>

@endsection
