@extends('layouts.app')

@section('title', 'Thêm Khoản tiết kiệm')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-success text-white text-center rounded-top-4">
                    <h4 class="mb-0">🌱 Thêm Khoản Tiết Kiệm</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('savings.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="goal_id" class="form-label">🎯 Mục tiêu</label>
                            <select name="goal_id" id="goal_id" class="form-select" required>
                                <option value="" disabled selected>-- Chọn mục tiêu --</option>
                                @foreach($goals as $goal)
                                    <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">💰 Số tiền</label>
                            <input type="number" name="amount" id="amount" class="form-control" placeholder="Nhập số tiền..." required min="0">
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">📝 Ghi chú</label>
                            <textarea name="note" id="note" class="form-control" placeholder="Ví dụ: tiết kiệm mỗi tháng" rows="4"></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg rounded-3">💾 Lưu Khoản Tiết Kiệm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
