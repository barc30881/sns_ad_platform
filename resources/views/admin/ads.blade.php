@extends('admin.layouts.app')

@section('title', '광고 관리')

@section('content')
    <h1 class="h2 pb-2 pb-lg-3">광고 관리</h1>
    <div class="input-group mb-4">
        <select name="status" class="form-select" onchange="this.form.submit()">
            <option value="">모든 상태</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>대기 중</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>지불됨</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>거부됨</option>
        </select>
        <button type="submit" class="btn btn-primary">필터</button>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>광고주</th>
                    <th>스토어 이름</th>
                    <th>유형</th>
                    <th>총액</th>
                    <th>상태</th>
                    <th>액션</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ads as $ad)
                    <tr>
                        <td>{{ $ad->id }}</td>
                        <td>{{ $ad->user->email }}</td>
                        <td>{{ $ad->store_name }}</td>
                        <td>{{ $ad->type }}</td>
                        <td>${{ number_format($ad->total, 2) }}</td>
                        <td>
                            <span class="badge {{ $ad->status == 'pending' ? 'bg-warning' : ($ad->status == 'paid' ? 'bg-success' : 'bg-danger') }}">{{ $ad->status }}</span>
                        </td>
                        <td>
                            @if ($ad->status == 'pending')
                                <form action="{{ route('admin.ads.approve', $ad->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">승인</button>
                                </form>
                                <form action="{{ route('admin.ads.reject', $ad->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">거부</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">광고가 없습니다.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $ads->links() }}
@endsection
