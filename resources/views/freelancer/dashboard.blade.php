@extends('freelancer.layouts.app')

@section('title', '내 광고')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>내 광고</h2>
    </div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h5>총 게시된 광고: {{ $totalAds }}</h5>
                </div>
                <div class="col-md-4">
                    <h5>총 수익: ${{ number_format($totalEarnings, 2) }}</h5>
                </div>
                <div class="col-md-4">
                    <h5>승인된 광고: {{ $verifiedAds }}</h5>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $totalAds ? ($verifiedAds / $totalAds * 100) : 0 }}%" aria-valuenow="{{ $verifiedAds }}" aria-valuemin="0" aria-valuemax="{{ $totalAds }}">{{ $verifiedAds }} / {{ $totalAds }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>광고 제목</th>
                    <th>게시 날짜</th>
                    <th>상태</th>
                    <th>보상 ($)</th>
                    <th>액션</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($submissions as $submission)
                    <tr>
                        <td>{{ $submission->ad->title }}</td>
                        <td>{{ $submission->created_at->format('Y-m-d') }}</td>
                        <td>
                            @switch($submission->status)
                                @case('pending')
                                    <span class="badge bg-warning">보류 중</span>
                                    @break
                                @case('approved')
                                    <span class="badge bg-success">승인됨</span>
                                    @break
                                @case('rejected')
                                    <span class="badge bg-danger">거부됨</span>
                                    @break
                                @case('paid')
                                    <span class="badge bg-primary">지급됨</span>
                                    @break
                            @endswitch
                        </td>
                        <td>${{ number_format($submission->reward, 2) }}</td>
                        <td>
                            <a href="{{ route('freelancer.ads') }}" class="btn btn-sm btn-outline-primary">광고 보기</a>
                            @if ($submission->status === 'rejected')
                                <a href="{{ route('freelancer.claim', $submission->ad_id) }}" class="btn btn-sm btn-outline-secondary">다시 게시</a>
                            @endif
                            <form action="{{ route('freelancer.delete-submission', $submission->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('이 제출을 삭제하시겠습니까?')">삭제</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">제출된 광고가 없습니다.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script>
        @if (session('already_claimed'))
            alert('이미 이 광고를 제출했습니다. 다른 광고를 확인하세요.');
        @endif
    </script>
@endsection
