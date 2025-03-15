@extends('layouts.app')

@section('content')
    {{-- マイページのタイトル --}}
    <div class="w-full max-w-4xl bg-gray-100 text-center p-6 text-2xl font-bold">
        {{ Auth::user()->name }} のマイページ
    </div>

    {{-- お気に入り & 行った展覧会 --}}
    <div class="w-full max-w-4xl grid grid-cols-2 gap-4 mt-6">
        {{-- お気に入り一覧 --}}
        <div class="border p-4">
            <h2 class="text-xl font-bold mb-2">お気に入り</h2>
            <ul>
                @foreach ($favorites as $favorite)
                    <li>{{ $favorite->name }}</li>
                @endforeach
            </ul>
        </div>

        {{-- 行った展覧会 --}}
        <div class="border p-4">
            <h2 class="text-xl font-bold mb-2">行った展覧会</h2>
            <ul>
                @foreach ($visitedExhibitions as $exhibition)
                    <li>{{ $exhibition->title }} - {{ $exhibition->review }}</li>
                @endforeach
            </ul>
            <button class="bg-gray-700 text-white px-4 py-2 rounded mt-4" onclick="location.href='{{ route('exhibition.edit') }}'">編集</button>
        </div>
    </div>

    {{-- 感想表示 --}}
    <div class="w-full max-w-4xl border p-4 mt-6">
        <h2 class="text-xl font-bold mb-2">感想</h2>
        <ul>
            @foreach ($favoriteReviews as $review)
                <li>{{ $review->content }} - <span class="text-gray-500">{{ $review->user->name }}</span></li>
            @endforeach
        </ul>
    </div>

    {{-- ナビゲーションボタン --}}
    <div class="flex justify-center space-x-6 mt-6">
        <a href="{{ route('museum_top') }}" class="border px-4 py-2 rounded-full">トップページ</a>
        <a href="{{ route('logout') }}" class="border px-4 py-2 rounded-full">ログアウト</a>
    </div>
@endsection
