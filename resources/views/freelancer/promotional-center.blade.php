@extends('freelancer.layouts.app')

@section('title', '프로모션 센터')

@section('content')
    <h1 class="h2 pb-2 pb-lg-3">환영합니다! 프로모션 센터에 오신 것을 환영합니다! 이 캠페인이나 플랫폼 링크를 소셜 미디어에 공유하여 보너스를 받고 프리랜서 명성을 높이세요.</h1>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">당신의 추천 링크</h5>
            <div class="input-group">
                <input type="text" id="referralLink" class="form-control" value="{{ $referralLink }}" readonly>
                <button class="btn btn-primary" type="button" onclick="copyReferralLink()">복사</button>
            </div>
            <p class="mt-3">추천으로부터 총 수익: ${{ number_format($totalEarnings, 2) }}</p>
            <p class="mt-2">대기 중 수익: ${{ number_format($pendingEarnings, 2) }}</p>
        </div>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">추천 방법</h5>
            <ul class="list-unstyled">
                <li><i class="fi-check me-2"></i>이 링크를 소셜 미디어에 공유하세요.</li>
                <li><i class="fi-check me-2"></i>친구가 등록하면 보너스를 받으세요.</li>
                <li><i class="fi-check me-2"></i>보너스 금액은 관리자가 설정합니다.</li>
            </ul>
        </div>
    </div>
    <script>
        function copyReferralLink() {
            const link = document.getElementById('referralLink');
            link.select();
            document.execCommand('copy');
            alert('추천 링크가 복사되었습니다!');
        }
    </script>
@endsection
