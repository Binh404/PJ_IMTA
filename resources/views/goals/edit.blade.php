@extends('layouts.app')

@section('title', 'Chỉnh sửa mục tiêu tiết kiệm')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary bg-gradient">
                    <h4 class="card-title mb-0 text-white">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa mục tiêu tiết kiệm
                    </h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('goals.update', $goal->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Tên mục tiêu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $goal->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label">Số tiền cần <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $goal->amount) }}" required min="0">
                                    <span class="input-group-text">VND</span>
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="current_amount" class="form-label">Đã tiết kiệm</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('current_amount') is-invalid @enderror" id="current_amount" name="current_amount" value="{{ old('current_amount', $goal->current_amount) }}" min="0">
                                    <span class="input-group-text">VND</span>
                                    @error('current_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $goal->start_date) }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">Ngày kết thúc <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $goal->end_date) }}" required>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="ongoing" {{ old('status', $goal->status) == 'ongoing' ? 'selected' : '' }}>Đang tiến hành</option>
                                <option value="completed" {{ old('status', $goal->status) == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="failed" {{ old('status', $goal->status) == 'failed' ? 'selected' : '' }}>Thất bại</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('goals.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Cập nhật mục tiêu
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i> Tiến độ hiện tại
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small text-muted mb-1">
                            <span>Tiến độ</span>
                            <span>{{ round(($goal->current_amount / $goal->amount) * 100) }}%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ ($goal->current_amount / $goal->amount) * 100 }}%;"
                                aria-valuenow="{{ ($goal->current_amount / $goal->amount) * 100 }}"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="text-muted small">Đã tiết kiệm</div>
                            <div class="fw-bold text-success">{{ number_format($goal->current_amount) }} VND</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small">Mục tiêu</div>
                            <div class="fw-bold">{{ number_format($goal->amount) }} VND</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small">Còn lại</div>
                            <div class="fw-bold text-danger">{{ number_format($goal->amount - $goal->current_amount) }} VND</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .form-label {
        font-weight: 500;
    }
</style>
@endsection

@section('scripts')
<script>
    // Kiểm tra ngày kết thúc phải sau ngày bắt đầu
    document.getElementById('start_date').addEventListener('change', function() {
        document.getElementById('end_date').min = this.value;
    });

    // Set giá trị min cho end_date khi trang load
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('end_date').min = document.getElementById('start_date').value;
    });
</script>
