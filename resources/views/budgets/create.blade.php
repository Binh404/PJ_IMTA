@extends('layouts.app')

@section('title', 'Thêm Ngân sách')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0">➕ Thêm Ngân Sách</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('budgets.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="amount" class="form-label">💰 Số tiền</label>
                            <input type="number" name="amount" id="amount" class="form-control" placeholder="Nhập số tiền ngân sách..." required min="0">
                        </div>

                        <div class="mb-3">
                            <label for="period" class="form-label">🗓️ Thời gian</label>
                            <select name="period" id="period" class="form-select" required>
                                <option value="" disabled selected>-- Chọn chu kỳ ngân sách --</option>
                                <option value="monthly">Hàng tháng</option>
                                <option value="yearly">Hàng năm</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3">💾 Lưu Ngân Sách</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
