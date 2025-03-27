@extends('layouts.app')

@section('content')
    {{-- マイページのタイトル --}}
    <div class="w-full max-w-4xl mx-auto bg-gray-100 text-center p-6 text-2xl font-bold">
        {{ Auth::user()->name }} のマイページ
    </div>

    <div class="w-full max-w-4xl mx-auto grid grid-cols-2 gap-4 mt-6 h-96 overflow-y-auto">
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

        <div class="border p-4 mt-4 mx-auto w-full max-w-4xl h-96 overflow-y-auto">
            <h3 class="text-lg font-bold">投稿した感想</h3>
            @forelse ($reviews as $review)
                <div class="border-b py-2">
                    <a href="{{ route('special_exhibition.show', ['museum' => $review->specialExhibition->museum->id, 'specialExhibition' => $review->specialExhibition->id]) }}" class="text-blue-500">
                        {{ $review->specialExhibition->museum->name }} - {{ $review->specialExhibition->title }}
                    </a>
                    <p class="text-gray-600">{{ $review->content }}</p>
                    <form action="{{ route('review.destroy', $review->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">削除</button>
                    </form>
                </div>
            @empty
                <p>まだ感想を投稿していません。</p>
            @endforelse
        </div>
    </div>

    <div class="border p-4 mt-4 mx-auto w-full max-w-4xl h-96 overflow-y-auto">
        <h3 class="text-lg font-bold">お気に入りした感想</h3>
        @forelse ($reviewFavorites as $reviewFavorite)
            <div class="border-b py-2">
                <a href="{{ route('special_exhibition.show', ['museum' => $reviewFavorite->review->specialExhibition->museum->id, 'specialExhibition' => $reviewFavorite->review->specialExhibition->id]) }}" class="text-blue-500">
                    {{ $reviewFavorite->review->specialExhibition->museum->name }} - {{ $reviewFavorite->review->specialExhibition->title }}
                </a>
                <p>{{ $reviewFavorite->review->content }}</p>
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
