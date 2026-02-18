@extends('layouts.app')

@section('content')

{{-- Page Header --}}
<div class="mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
    <div>
        <h1 class="text-4xl font-bold text-gray-900 leading-tight">
            {{ $post->title }}
        </h1>
        <p class="text-sm text-gray-500 mt-2">
            Published on {{ $post->created_at->format('d M Y') }}
        </p>
    </div>

    {{-- Action Buttons --}}
    <div class="flex items-center gap-3 mt-4 md:mt-0">
        <a href="{{ route('posts.index') }}"
           class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
            ← Back
        </a>

        <a href="{{ route('posts.edit', $post) }}"
           class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-xl shadow hover:bg-indigo-700 transition">
            Edit Post
        </a>
    </div>
</div>

{{-- Post Content Card --}}
<article class="bg-white rounded-2xl shadow-xl border border-gray-100 p-10">

    {{-- Rendered Content --}}
    <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-p:text-gray-700">
        {!! $post->content !!}
    </div>

</article>

@endsection
