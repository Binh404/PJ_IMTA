@extends('layouts.app')

@section('title', 'Sửa Giao Dịch')

@section('content')
    <div class="container mt-5">
        <h3 class="text-center">Sửa Giao Dịch</h3>

        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="type" class="form-label">Loại giao dịch</label>
                <select id="type" name="type" class="form-select" required>
                    <option value="income" {{ $transaction->type == 'income' ? 'selected' : '' }}>Thu nhập</option>
                    <option value="expense" {{ $transaction->type == 'expense' ? 'selected' : '' }}>Chi tiêu</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Số tiền</label>
                <input type="number" id="amount" name="amount" class="form-control" value="{{ $transaction->amount }}" required>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Ghi chú</label>
                <input type="text" id="note" name="note" class="form-control" value="{{ $transaction->note }}">
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Ngày giao dịch</label>
                <input type="date" id="date" name="date" class="form-control" value="{{ $transaction->date }}" required>
            </div>

            <button type="submit" class="btn btn-success">Cập nhật</button>
        </form>
    </div>
@endsection
