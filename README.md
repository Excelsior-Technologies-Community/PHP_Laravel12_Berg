# PHP_Laravel12_Berg

## Project Introduction

PHP_Laravel12_Berg is a Laravel 12 demonstration project that shows how to install, configure, and use the Laraberg Gutenberg editor inside a Laravel application.
It provides a simple, step-by-step implementation of a block-based content management system, helping beginners understand how to create, store, and display rich editor content in Laravel.

------------------------------------------------------------------------

## Project Overview

This project includes:

- Fresh Laravel 12 setup

- Laraberg package integration

- Database migration and Post CRUD

- Gutenberg-style block editor for content creation

- Frontend rendering of stored block content

------------------------------------------------------------------------

## Step 1 --- Create Laravel 12 Project

``` bash
composer create-project laravel/laravel PHP_laravel12_Berg "12.*"
cd PHP_laravel12_Berg
```

Run project:

``` bash
php artisan serve
```

------------------------------------------------------------------------

## Step 2 --- Install Laraberg Package

``` bash
composer require van-ons/laraberg
```

Publish configuration:

``` bash
php artisan vendor:publish --tag=laraberg-config
```

------------------------------------------------------------------------

## Step 3 --- Database Setup

Update **.env**:

``` env
DB_DATABASE=laraberg_db
DB_USERNAME=root
DB_PASSWORD=
```

Run migration:

``` bash
php artisan migrate
```

------------------------------------------------------------------------

## Step 4: Install Node Modules and Build Assets

```bash
npm install
npm run dev
npm run build
```

------------------------------------------------------------------------

## Step 5 --- Create Post Model, Migration & Controller

``` bash
php artisan make:model Post -mcr
```

### Migration File

``` php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->longText('content')->nullable();
    $table->timestamps();
});
```

Run:

``` bash
php artisan migrate
```

------------------------------------------------------------------------

## Step 6 --- Define Routes

``` php
use App\Http\Controllers\PostController;

Route::resource('posts', PostController::class);
```

------------------------------------------------------------------------

## Step 7 --- Update Post Model

``` php
class Post extends Model
{
    protected $fillable = ['title', 'content'];
}
```

------------------------------------------------------------------------

## Step 8 --- Controller Logic

``` php
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        Post::create($request->all());
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
```

------------------------------------------------------------------------

## Step 9 --- Blade Layout

### 1. app.blade.php

**resources/views/layouts/app.blade.php**

``` php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laraberg CMS') }}</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind CSS (Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Laraberg Styles --}}
    <!-- @larabergStyles -->
</head>

<body class="bg-gradient-to-br from-slate-50 via-gray-100 to-slate-200 text-gray-800 font-[Inter] antialiased">

    {{-- ===== Top Navigation ===== --}}
    <header class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            {{-- Logo / Title --}}
            <h1 class="text-2xl font-bold tracking-tight text-indigo-600">
                Laraberg CMS
            </h1>

            {{-- Navigation Links --}}
            <nav class="flex items-center gap-4">

                <a href="{{ route('posts.index') }}"
                   class="text-gray-600 hover:text-indigo-600 font-medium transition">
                    Posts
                </a>

                <a href="{{ route('posts.create') }}"
                   class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl shadow-md
                          hover:bg-indigo-700 hover:shadow-lg transition-all duration-200">
                    + New Post
                </a>
            </nav>
        </div>
    </header>

    {{-- ===== Page Content ===== --}}
    <main class="max-w-7xl mx-auto px-6 py-10">

        {{-- Glass Card Container --}}
        <div class="bg-white/90 backdrop-blur-md border border-gray-200
                    rounded-3xl shadow-xl p-8 min-h-[70vh]">

            @yield('content')

        </div>
    </main>

    {{-- ===== Footer ===== --}}
    <footer class="text-center text-sm text-gray-500 py-8">
        © {{ date('Y') }} Laraberg Laravel 12 — Crafted with ❤️ for modern CMS
    </footer>

    {{-- Laraberg Scripts --}}
    <!-- @larabergScripts -->

</body>
</html>
```

### 2. index.blade.php

**resources/views/posts/index.blade.php**

```php
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
```

### 3. create.blade.php

**resources/views/posts/create.blade.php**

```php
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
```

### 4. edit.blade.php

**resources/views/posts/edit.blade.php**

```php
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
```

### 5. show.blade.php

**resources/views/posts/show.blade.php**

```php
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
```
------------------------------------------------------------------------

## Step 10 — Run the Project

To run the project properly, you must open two separate terminals.

### Terminal 1 — Start Vite (Frontend Assets)

```bash
npm run dev
```

Purpose:

- Compiles Tailwind CSS and JavaScript

- Loads Laraberg editor UI correctly

- Auto-refresh on file changes

- Keep this terminal running.

### Terminal 2 — Start Laravel Server

```bash
php artisan serve
```

Now open in browser:

```bash
http://127.0.0.1:8000/posts
```

------------------------------------------------------------------------

## Output

### Index Page

<img width="1918" height="1025" alt="Screenshot 2026-02-18 113610" src="https://github.com/user-attachments/assets/76b1bdb3-e973-4631-b247-4b94d9c23fe0" />

------------------------------------------------------------------------

# Final Folder Structure

```
PHP_Laravel12_Berg/
│
├── app/
│   ├── Models/
│   │   └── Post.php
│   │
│   └── Http/
│       └── Controllers/
│           └── PostController.php
│
├── database/
│   └── migrations/
│       └── create_posts_table.php
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       │
│       └── posts/
│           ├── index.blade.php
│           ├── create.blade.php
│           ├── edit.blade.php
│           └── show.blade.php
│
├── routes/
│   └── web.php
│
├── public/
├── config/
├── storage/
├── bootstrap/
├── vendor/
│
├── .env
├── artisan
├── composer.json
├── package.json
└── README.md
```

------------------------------------------------------------------------

## Your PHP_Laravel12_Berg Project is now ready!
