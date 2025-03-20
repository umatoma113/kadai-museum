@extends('layouts.app')

@section('content')

    <div class="prose mx-auto text-center">
        <h2>Sign up</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('register') }}" class="w-1/2">
            @csrf

            <div class="form-control my-4">
                <label for="name" class="label">
                    <span class="label-text">名前</span>
                </label>
                <input type="text" name="name" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="email" class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" name="email" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="password" class="label">
                    <span class="label-text">パスワード</span>
                </label>
                <input type="password" name="password" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="password_confirmation" class="label">
                    <span class="label-text">パスワード確認</span>
                </label>
                <input type="password" name="password_confirmation" class="input input-bordered w-full">
            </div>

            <button type="submit" class="btn btn-primary btn-block normal-case">登録</button>
        </form>
    </div>
@endsection