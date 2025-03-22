@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $specialExhibition->name }}</h1>
    <p>{{ $specialExhibition->description }}</p>
    <p><strong>開催期間:</strong> {{ $specialExhibition->start_date }} ～ {{ $specialExhibition->end_date }}</p>
    <p><strong>場所:</strong> {{ $specialExhibition->location }}</p>

    <h3>感想</h3>
    @foreach ($specialExhibition->reviews as $review)
        <div>
            <p>{{ $review->user->name }}: {{ $review->content }}</p>
        </div>
    @endforeach

    <form method="POST" action="{{ route('reviews.store', $specialExhibition->id) }}">
        @csrf
        <textarea name="content" placeholder="感想を投稿"></textarea>
        <button type="submit">投稿</button>
    </form>
</div>
@endsection
