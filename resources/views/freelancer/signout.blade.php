@extends('freelancer.layouts.app')

@section('title', '로그아웃')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>로그아웃</h2>
    </div>
    <div class="card">
        <div class="card-body text-center">
            <p>정말 로그아웃하시겠습니까?</p>
            <form action="{{ route('freelancer.signout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">로그아웃</button>
                <a href="{{ route('freelancer.dashboard') }}" class="btn btn-secondary">취소</a>
            </form>
        </div>
    </div>
@endsection
