@extends('layouts.app')

@section('title', 'Thêm Giao dịch')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-info text-white text-center rounded-top-4">
                    <h4 class="mb-0">💸 Thêm Giao Dịch</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="type" class="form-label">📂 Loại giao dịch</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="" disabled selected>-- Chọn loại --</option>
                                <option value="income">Thu nhập</option>
                                <option value="expense">Chi tiêu</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">💰 Số tiền</label>
                            <input type="number" name="amount" id="amount" class="form-control" placeholder="Nhập số tiền" required min="0">
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">📝 Ghi chú</label>
                            <textarea name="note" id="note" class="form-control" rows="3" placeholder="Nhập ghi chú..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">📅 Ngày</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-info btn-lg rounded-3 text-white">➕ Thêm Giao Dịch</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
