@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center">
        {{-- Header --}}
        <div class="w-full max-w-4xl bg-gray-100 text-center p-6 text-2xl font-bold">
            Museums in Tokyo
        </div>

        {{-- Site Overview --}}
        <div class="w-full max-w-4xl bg-gray-200 text-center p-4 mt-6">
            都内の美術館や博物館をまとめたサイトです。<br>
            各施設ページにアクセスし、特徴や見どころを確認することができます。<br>
            ユーザー登録することで施設のお気に入り登録や感想の投稿をすることができます。<br>
            各施設の直近の特別展の紹介もしています。<br>
            今後紹介する施設が増えていく予定です。（東京都以外も検討）
        </div>

        {{-- Area Section --}}
        <div class="grid grid-cols-4 gap-4 w-full max-w-4xl mt-6">
            @foreach ($museums as $museum)
                <div class="flex flex-col items-center border p-4">
                    <p class="mb-2">{{ $museum->name }}</p>
                    <p class="text-sm text-gray-600">{{ $museum->location }}</p>
                    <a href="{{ route('museum.show', ['id' => $museum->id]) }}" class="bg-gray-700 text-white px-4 py-2 rounded mt-2">詳細を見る</a>
                </div>
            @endforeach
        </div>


        {{-- Footer Navigation --}}
        <div class="flex justify-center space-x-4 mt-6">
            <a href="{{ route('login') }}" class="border px-4 py-2 rounded-full hover:bg-gray-200 transition">ログイン</a>
            <a href="{{ route('mypage') }}" class="border px-4 py-2 rounded-full hover:bg-gray-200 transition">マイページ</a>
            <a href="{{ route('register') }}" class="border px-4 py-2 rounded-full hover:bg-gray-200 transition">登録</a>
        </div>
    </div>
@endsection
