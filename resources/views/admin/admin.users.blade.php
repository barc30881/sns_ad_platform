@extends('admin.layouts.app')

@section('title', '사용자 관리')

@section('content')
    <h1 class="h2 pb-2 pb-lg-3">사용자 관리</h1>
    <div class="input-group mb-4">
        <select name="role" class="form-select" onchange="this.form.submit()">
            <option value="">모든 역할</option>
            <option value="freelancer" {{ request('role') == 'freelancer' ? 'selected' : '' }}>프리랜서</option>
            <option value="advertiser" {{ request('role') == 'advertiser' ? 'selected' : '' }}>광고주</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>관리자</option>
        </select>
        <button type="submit" class="btn btn-primary">필터</button>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>이메일</th>
                    <th>역할</th>
                    <th>액션</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <form action="{{ route('admin.users.update-role', $user->id) }}" method="POST">
                                @csrf
                                <select name="role" class="form-select d-inline-block w-auto">
                                    <option value="freelancer" {{ $user->role == 'freelancer' ? 'selected' : '' }}>프리랜서</option>
                                    <option value="advertiser" {{ $user->role == 'advertiser' ? 'selected' : '' }}>광고주</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>관리자</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">업데이트</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">사용자가 없습니다.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
@endsection
