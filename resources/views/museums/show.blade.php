@extends('layouts.app')

@section('content')
    <div class="border p-4">
        <h1 class="text-center text-lg font-bold">博物館</h1>
        <h2 class="text-center text-xl font-bold">{{ $museum->name }}</h2>

        <div class="flex justify-between items-center">
            <button class="bg-blue-500 text-white px-4 py-2 rounded">お気に入り</button>
        </div>
    </div>

    <div class="border p-4 mt-4 text-center">
        <h3 class="text-lg font-bold">特別展・企画展</h3>
        <a href="{{ $museum->special_exhibition }}" target="_blank">
            <button class="bg-gray-700 text-white px-4 py-2 rounded mt-2">公式ページ</button>
        </a>
    </div>

    <div class="flex flex-col gap-4 mt-4 w-full max-w-screen-lg mx-auto">
        <div class="border p-4 text-center h-auto">
            <h3 class="text-lg font-bold">特徴</h3>
            <p class="mt-2">{{ $museum->description }}</p>
        </div>
        <div class="border p-4 text-center h-auto">
            <h3 class="text-lg font-bold">見どころ</h3>
            <p class="mt-2">{{ $museum->highlights }}</p>
        </div>
        <div class="border p-4 text-center h-auto">
            <h3 class="text-lg font-bold">アクセス</h3>
            <p class="mt-2">{{ $museum->access }}</p>
        </div>
    </div>

    <div class="border p-4 mt-4">
        <h3 class="text-lg font-bold">感想を投稿</h3>
        @auth
            <form action="{{ route('review.store', $museum->id) }}" method="POST">
                @csrf
                <textarea name="content" class="w-full border p-2 mt-2" rows="3"></textarea>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">投稿</button>
            </form>
        @else
            <p>ログインすると感想を投稿できます。</p>
        @endauth
    </div>

    <div class="border p-4 mt-4">
        <h3 class="text-lg font-bold">感想一覧</h3>
        @foreach ($museum->reviews as $review)
            <div class="border-b py-2">
                <p>{{ $review->content }}</p>

                {{-- お気に入り機能 --}}
                @auth
                    <form action="{{ route('review.favorite', $review->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-blue-500">
                            {{ $review->favorites->where('user_id', Auth::id())->count() ? '★ お気に入り解除' : '☆ お気に入り' }}
                        </button>
                    </form>
                @else
                    <p class="text-sm text-gray-500">ログインするとお気に入り登録できます。</p>
                @endauth
            </div>
        @endforeach
    </div>

@endsection
