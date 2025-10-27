@extends('freelancer.layouts.app')

@section('title', '결제 내역')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>결제 내역</h2>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>결제 ID</th>
                    <th>지급 날짜</th>
                    <th>금액 ($)</th>
                    <th>방법</th>
                    <th>상태</th>
                    <th>증빙</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ $payment->payment_id }}</td>
                        <td>{{ $payment->paid_at ? $payment->paid_at->format('Y-m-d H:i') : '-' }}</td>
                        <td>${{ number_format($payment->amount, 2) }}</td>
                        <td>{{ ucfirst($payment->method) }}</td>
                        <td>
                            @switch($payment->status)
                                @case('processing')
                                    <span class="badge bg-warning">처리 중</span>
                                    @break
                                @case('paid')
                                    <span class="badge bg-success">지급됨</span>
                                    @break
                                @case('failed')
                                    <span class="badge bg-danger">실패</span>
                                    @break
                            @endswitch
                        </td>
                        <td>
                            @if ($payment->evidence)
                                <a href="{{ $payment->evidence }}" target="_blank" class="btn btn-sm btn-outline-primary">증빙 보기</a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">결제 내역이 없습니다.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
