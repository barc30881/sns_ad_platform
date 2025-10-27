@extends('freelancer.layouts.app')

@section('title', '결제 정보')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>결제 정보</h2>
    </div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('freelancer.save-payment-settings') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="full_name" class="form-label">전체 이름 (PayPal 계정과 동일)</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $paymentSetting?->full_name) }}" required>
                    <div class="invalid-feedback">전체 이름을 입력하세요.</div>
                </div>
                <div class="mb-3">
                    <label for="paypal_email" class="form-label">PayPal 이메일 주소</label>
                    <input type="email" class="form-control" id="paypal_email" name="paypal_email" value="{{ old('paypal_email', $paymentSetting?->paypal_email) }}" required>
                    <div class="invalid-feedback">유효한 PayPal 이메일을 입력하세요.</div>
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">국가</label>
                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $paymentSetting?->country) }}" required>
                    <div class="invalid-feedback">국가를 입력하세요.</div>
                </div>
                <button type="submit" class="btn btn-primary">저장 및 검증</button>
            </form>
            @if ($paymentSetting && $paymentSetting->is_verified)
                <div class="alert alert-success mt-3">결제 정보가 검증되었습니다.</div>
            @elseif ($paymentSetting)
                <div class="alert alert-warning mt-3">결제 정보가 검증 대기 중입니다.</div>
            @endif
        </div>
    </div>
    <script>
        // Auto-detect country (optional, requires API like ipapi.co)
        fetch('https://ipapi.co/json/')
            .then(response => response.json())
            .then(data => {
                if (!document.getElementById('country').value) {
                    document.getElementById('country').value = data.country_name;
                }
            })
            .catch(error => console.log('Country detection failed', error));
    </script>
@endsection
