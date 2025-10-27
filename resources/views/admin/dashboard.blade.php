@extends('admin.layouts.app')

@section('title', '관리자 대시보드')

@section('content')
    <h1 class="h2 pb-2 pb-lg-3">관리자 대시보드</h1>
    <div class="row g-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">총 광고 수</h6>
                    <p class="fs-4 fw-bold mb-0">{{ $totalAds }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">대기중인 광고</h6>
                    <p class="fs-4 fw-bold mb-0">{{ $pendingAds }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">총 제출 수</h6>
                    <p class="fs-4 fw-bold mb-0">{{ $totalSubmissions }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">대기중인 제출</h6>
                    <p class="fs-4 fw-bold mb-0">{{ $pendingSubmissions }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">총 사용자 수</h6>
                    <p class="fs-4 fw-bold mb-0">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">총 결제 금액</h6>
                    <p class="fs-4 fw-bold mb-0">${{ number_format($totalPayments, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <h3 class="h5">빠른 링크</h3>
        <a href="{{ route('admin.ads') }}" class="btn btn-primary me-2">광고 관리</a>
        <a href="{{ route('admin.submissions') }}" class="btn btn-primary me-2">제출 관리</a>
        <a href="{{ route('admin.users') }}" class="btn btn-primary me-2">사용자 관리</a>
        <a href="{{ route('admin.payments') }}" class="btn btn-primary me-2">결제 관리</a>
    </div>
@endsection
