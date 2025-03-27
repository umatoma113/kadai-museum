@extends('layouts.app')

@section('content')
<div class="container max-w-2xl mx-auto">
    <div class="border border-gray-300 rounded-lg p-4 shadow-md text-center">
        <h1 class="text-2xl font-bold mb-4 inline-block">{{ $specialExhibition->title }}</h1>
        <p class="mb-6">{!! nl2br($specialExhibition->description) !!}</p>
        <p class="text-lg font-semibold mb-6"><strong>開催期間:</strong> {{ $specialExhibition->start_date }} ～ {{ $specialExhibition->end_date }}</p>

        <p class="mb-6">
            <strong>公式サイト</strong>
            <a href="{{ $specialExhibition->special_exhibition_website }}" target="_blank" class="bg-gray-700 text-white px-4 py-2 rounded inline-block text-center">
                特別展公式
            </a>
        </p>

        <div class="border border-gray-300 rounded-lg p-4 shadow-md mt-6">
            <form method="POST" action="{{ route('reviews.store', ['museum' => $museum->id, 'specialExhibition' => $specialExhibition->id]) }}" class="mt-4">
                @csrf
                <textarea name="content" placeholder="感想を投稿" class="w-full p-2 border border-gray-300 rounded"></textarea>
                <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded mt-2">投稿</button>
            </form>
        </div>

        <div class="border border-gray-300 rounded-lg p-4 shadow-md mt-6 overflow-y-auto" style="max-height: 500px;">
            <h3 class="text-lg font-bold text-center">感想</h3>
            @foreach ($specialExhibition->reviews as $review)
                <div class="border-b border-gray-300 p-2 mb-2">
                    <p class="text-gray-700">{{ $review->content }}</p>
                    @auth
                        @if(in_array($review->id, $favoritedReviewIds))
                            <form action="{{ route('review.favorite.remove', $review) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-black-500 px-3 py-1 border rounded">
                                    お気に入り解除
                                </button>
                            </form>
                        @else
                            <form action="{{ route('review.favorite.add', $review) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-black-500 px-3 py-1 border rounded">
                                    お気に入り
                                </button>
                            </form>
                        @endif
                    @endauth
            @endforeach
        </div>
    </div>
</div>
@endsection
