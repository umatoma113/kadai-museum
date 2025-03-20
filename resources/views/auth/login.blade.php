@extends('layouts.app')

@section('content')

    <div class="prose mx-auto text-center">
        <h2>Log in</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('login') }}" class="w-1/2">
            @csrf

            <div class="form-control my-4">
                <label for="email" class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" name="email" class="input input-bordered w-full border-black">
            </div>

            <div class="form-control my-4">
                <label for="password" class="label">
                    <span class="label-text">Password</span>
                </label>
                <input type="password" name="password" class="input input-bordered w-full border-black">
            </div>

            <button type="submit" class="btn btn-primary btn-block normal-case">ログイン</button>

            {{-- ユーザー登録ページへのリンク --}}
            <p class="mt-2">New user? <a class="link link-hover text-info" href="{{ route('register') }}">登録</a></p>
        </form>
    </div>
@endsection