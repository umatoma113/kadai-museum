@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center">
        {{-- Header --}}
        <div class="w-full max-w-4xl bg-gray-100 text-center p-6 text-2xl font-bold">
            MUSEUM(仮) 都内？上野エリア？山手線沿線？
        </div>

        {{-- Site Overview --}}
        <div class="w-full max-w-4xl bg-gray-200 text-center p-4 mt-6">
            美術館や博物館をまとめたサイトです。<br>
            各施設ページにアクセスし、特徴や見どころを確認することができます。<br>
            ユーザー登録することで施設のお気に入り登録や感想の投稿をすることができます。
        </div>

        {{-- Area Section --}}
        <div class="grid grid-cols-4 gap-4 w-full max-w-4xl mt-6">
            @foreach (["東京都美術館", "国立西洋美術館", "国立科学博物館", "東京国立博物館"] as $name)
                <div class="flex flex-col items-center border p-4">
                    <p class="mb-2">{{ $name }}</p>
                    <p class="text text-gray-600">上野駅</p>
                    <button class="bg-gray-700 text-white px-4 py-2 rounded">button</button>
                </div>
            @endforeach
        </div>
        <div class="grid grid-cols-4 gap-4 w-full max-w-4xl mt-6">
            @foreach ([
                ["国立新美術館", "乃木坂"],
                ["東京国立近代美術館", "竹橋"],
                ["太田記念美術館", "原宿"],
                ["江戸東京博物館", "両国"]
            ] as [$name, $location])
            <div class="flex flex-col items-center border p-4">
                <p class="mb-2">{{ $name }}</p>
                <p class="text-sm text-gray-600">{{ $location }}</p>
                <button class="bg-gray-700 text-white px-4 py-2 rounded mt-2">button</button>
            </div>
            @endforeach
        </div>

        {{-- Footer Navigation --}}
        <div class="flex space-x-6 mt-6">
            <a href="{{ route('login') }}" class="border px-4 py-2 rounded-full">ログイン</a>
            <a href="{{ route('mypage') }}" class="border px-4 py-2 rounded-full">マイページ</a>
            <a href="{{ route('register') }}" class="border px-4 py-2 rounded-full">Sign up</a>
        </div>
    </div>
@endsection