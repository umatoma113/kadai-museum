@extends('layouts.app')

@section('content')
    {{-- マイページのタイトル --}}
    <div class="w-full max-w-4xl mx-auto bg-gray-100 text-center p-6 text-2xl font-bold">
        {{ Auth::user()->name }} のマイページ
    </div>

    <div class="w-full max-w-4xl mx-auto grid grid-cols-2 gap-4 mt-6">
        {{-- お気に入り一覧 --}}
        <div class="border p-4">
            <h2 class="text-xl font-bold mb-2">お気に入り</h2>
            @if ($favorites->isEmpty())
                <p>お気に入り登録された施設はありません。</p>
            @else
                <ul>
                    @foreach ($favorites as $favorite)
                        <li>
                            <a href="{{ route('museum.show', $favorite->museum->id) }}" class="text-sky-300">
                                {{ $favorite->museum->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- 行った展覧会 --}}
        <div class="border p-4">
            <h2 class="text-xl font-bold mb-2">行った展覧会</h2>
            <ul>
                @foreach ($visitedSpecialExhibitions as $exhibition)
                    <li>
                        {{ $exhibition->title }} -
                        @foreach ($exhibition->reviews as $review)
                            {{ $review->content }}
                        @endforeach
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="border p-4 mt-4 mx-auto w-full max-w-4xl">
        <h3 class="text-lg font-bold">お気に入りした感想</h3>
        @forelse (Auth::user()->reviewFavorites as $favorite)
            <div class="border-b py-2">
                <a href="{{ route('museum.show', $favorite->review->specialExhibition->museum->id) }}" class="text-blue-500">
                    {{ $favorite->review->specialExhibition->museum->name }}
                </a>
                <p>{{ $favorite->review->content }}</p>
            </div>
        @empty
            <p>お気に入りにした感想はありません。</p>
        @endforelse
    </div>


    <div class="flex justify-center space-x-6 mt-6">
        <a href="{{ route('museum_top') }}" class="border px-4 py-2 rounded-full">トップページ</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="border px-4 py-2 rounded-full">ログアウト</button>
        </form>
    </div>
@endsection
