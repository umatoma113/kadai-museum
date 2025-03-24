@extends('layouts.app')

@section('content')
    <div class="border p-4">
        <h1 class="text-center text-lg font-bold">博物館</h1>
        <h2 class="text-center text-xl font-bold">{{ $museum->name }}</h2>

        @auth
            @if(auth()->user()->favorites->contains($museum->id))
                <form method="POST" action="{{ route('museum.favorite.destroy', $museum->id) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-black px-4 py-2 rounded">
                        お気に入り解除
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('museum.favorite.store', $museum->id) }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-sky-300 text-black px-4 py-2 rounded">
                        お気に入り
                    </button>
                </form>
            @endif
        @endauth
    </div>

    <div class="border p-4 mt-4 text-center">
        <h3 class="text-lg font-bold mb-4">特別展・企画展</h3>
        <a href="{{ $museum->official_website }}" target="_blank" class="bg-gray-700 text-white px-4 py-2 rounded inline-block text-center">
            公式ページ
        </a>
    </div>

    <div class="flex flex-col gap-4 mt-4 w-full max-w-screen-lg mx-auto">
        <div class="border p-4 text-center h-auto">
            <h3 class="text-lg font-bold">特徴</h3>
            <p class="mt-2">{{ $museum->description }}</p>
        </div>
        <div class="border p-4 text-center h-auto">
            <h3 class="text-lg font-bold">見どころ</h3>
            <p class="mt-2">{!! nl2br(e($museum->highlights)) !!}</p>
        </div>
        <div class="border p-4 text-center h-auto">
            <h3 class="text-lg font-bold">アクセス</h3>
            <p class="mt-2">{{ $museum->access }}</p>
        </div>
    </div>

    <div class="border p-4 mt-4">
        <h3 class="text-lg font-bold">企画展・特別展</h3>
        <div class="flex flex-wrap gap-4">
            @foreach ($museum->specialExhibitions as $specialexhibition)
                <div class="border p-4 w-60 text-center">
                    <h4 class="font-bold">{{ $specialexhibition->title }}</h4>
                    <p class="text-sm text-gray-500">{{ $specialexhibition->date }}</p>

                    @auth
                        <form method="POST" action="{{ route('special_exhibition.toggle_visit', $specialexhibition->id) }}">
                            @csrf
                            <button type="submit" class="text-xl">
                                @if(auth()->user()->visitedExhibitions->contains($specialexhibition->id))
                                    ★
                                @else
                                    ☆
                                @endif
                            </button>
                        </form>
                    @endauth

                <a href="{{ route('special_exhibition.show', $specialexhibition->id) }}">
                    <button class="bg-gray-700 text-white px-4 py-2 rounded mt-2">詳しく</button>
                </a>
                </div>
            @endforeach
        </div>
    </div>


@endsection
