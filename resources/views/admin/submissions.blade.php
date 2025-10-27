@extends('admin.layouts.app')

@section('title', '제출 관리')

@section('content')
    <h1 class="h2 pb-2 pb-lg-3">제출 관리</h1>
    <div class="input-group mb-4">
        <select name="status" class="form-select" onchange="this.form.submit()">
            <option value="">모든 상태</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>대기 중</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>승인됨</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>거부됨</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>지불됨</option>
        </select>
        <button type="submit" class="btn btn-primary">필터</button>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>프리랜서</th>
                    <th>광고 ID</th>
                    <th>SNS 링크</th>
                    <th>보상</th>
                    <th>상태</th>
                    <th>액션</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($submissions as $submission)
                    <tr>
                        <td>{{ $submission->id }}</td>
                        <td>{{ $submission->freelancer->email }}</td>
                        <td>{{ $submission->ad_id }}</td>
                        <td>
                            @foreach ($submission->sns_links as $link)
                                <a href="{{ $link }}" target="_blank">{{ $link }}</a><br>
                            @endforeach
                        </td>
                        <td>${{ number_format($submission->reward, 2) }}</td>
                        <td>
                            <span class="badge {{ $submission->status == 'pending' ? 'bg-warning' : ($submission->status == 'approved' ? 'bg-success' : ($submission->status == 'rejected' ? 'bg-danger' : 'bg-primary')) }}">{{ $submission->status }}</span>
                        </td>
                        <td>
                            @if ($submission->status == 'pending')
                                <form action="{{ route('admin.submissions.approve', $submission->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">승인</button>
                                </form>
                                <form action="{{ route('admin.submissions.reject', $submission->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">거부</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">제출이 없습니다.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $submissions->links() }}
@endsection
