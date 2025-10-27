@extends('admin.layouts.app')

@section('title', '결제 관리')

@section('content')
    <h1 class="h2 pb-2 pb-lg-3">결제 관리</h1>
    <div class="table-responsive">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>프리랜서</th>
                    <th>결제 ID</th>
                    <th>금액</th>
                    <th>방법</th>
                    <th>상태</th>
                    <th>지불일</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->freelancer->email }}</td>
                        <td>{{ $payment->payment_id }}</td>
                        <td>${{ number_format($payment->amount, 2) }}</td>
                        <td>{{ $payment->method }}</td>
                        <td>
                            <span class="badge {{ $payment->status == 'processing' ? 'bg-warning' : ($payment->status == 'completed' ? 'bg-success' : 'bg-danger') }}">{{ $payment->status }}</span>
                        </td>
                        <td>{{ $payment->paid_at ? $payment->paid_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">결제 내역이 없습니다.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $payments->links() }}
@endsection
