@extends('layouts.app')

@section('title', 'Chỉnh sửa Khoản tiết kiệm')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-warning text-dark text-center rounded-top-4">
                    <h4 class="mb-0">✏️ Chỉnh sửa Khoản Tiết Kiệm</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('savings.update', $saving->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="goal_id" class="form-label">🎯 Mục tiêu</label>
                            <select name="goal_id" id="goal_id" class="form-select" required>
                                @foreach($goals as $goal)
                                    <option value="{{ $goal->id }}" {{ $goal->id == $saving->goal_id ? 'selected' : '' }}>
                                        {{ $goal->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">💰 Số tiền</label>
                            <input type="number" name="amount" id="amount" class="form-control" value="{{ $saving->amount }}" required min="0">
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">📝 Ghi chú</label>
                            <textarea name="note" id="note" class="form-control" rows="4" placeholder="Nhập ghi chú chi tiết...">{{ $saving->note }}</textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning btn-lg rounded-3">💾 Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
