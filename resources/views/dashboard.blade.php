@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm border-primary">
                <!-- Header chung -->
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0 text-center">Dashboard Quản lý Tiết Kiệm</h4>
                </div>
                <!-- Body chung -->
                <div class="card-body">
                    <!-- Tổng số khoản tiết kiệm -->
                    <div class="text-center mb-4">
                        <h5>Tổng số khoản tiết kiệm hiện tại:</h5>
                        <h2 class="text-success">
                            {{ number_format($savings->sum('total_amount'), 0, ',', '.') }} VND
                        </h2>
                    </div>

                    <hr>

                    <!-- Biểu đồ tổng hợp -->
                    <h5 class="text-center">Số tiền tiết kiệm theo từng mục tiêu</h5>
                   <canvas id="savingsChart" width="1200" height="600" style="width: 100%; height: 300px;"></canvas>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- Thư viện Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const savingsData = @json($savings);
    const colors = ['rgba(54, 162, 235, 0.4)', 'rgba(255, 99, 132, 0.4)', 'rgba(255, 159, 64, 0.4)', 'rgba(75, 192, 192, 0.4)', 'rgba(153, 102, 255, 0.4)', 'rgba(255, 206, 86, 0.4)'];
    const borderColors = ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 206, 86, 1)'];

    const ctx = document.getElementById('savingsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: savingsData.map(saving => saving.goal_name),
            datasets: [{
                label: 'Số tiền tiết kiệm (VND)',
                data: savingsData.map(saving => saving.total_amount),
                backgroundColor: savingsData.map((_, index) => colors[index % colors.length]),
                borderColor: savingsData.map((_, index) => borderColors[index % borderColors.length]),
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
@section('styles')
<style>
    /* Điều chỉnh card và phần tử trong card */
    .card {
        margin: 15px;
    }

    /* Làm cho biểu đồ co giãn với màn hình */
    .card-body {
        padding: 1rem;
    }

    #savingsChart {
        width: 100% !important;
        height: auto !important;
    }

    /* Đảm bảo các phần tử luôn gọn gàng trên thiết bị di động */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 0 15px; /* giảm padding cho phù hợp trên màn hình nhỏ */
        }

        .card-header h4 {
            font-size: 1.25rem; /* Giảm kích thước tiêu đề card */
        }

        .card-body h5 {
            font-size: 1.125rem; /* Giảm kích thước tiêu đề phần nội dung */
        }

        .card-body h2 {
            font-size: 1.5rem; /* Giảm kích thước tổng số tiền tiết kiệm */
        }

        /* Biểu đồ trên màn hình nhỏ */
        #savingsChart {
            max-width: 100% !important;
            height: 300px !important; /* Đảm bảo biểu đồ có kích thước hợp lý trên màn hình nhỏ */
        }
    }

    /* Tối ưu cho thiết bị nhỏ (smartphone) */
    @media (max-width: 576px) {
        .card-body h5 {
            font-size: 1rem; /* Giảm kích thước tiêu đề phần nội dung */
        }

        .card-body h2 {
            font-size: 1.25rem; /* Giảm kích thước tổng số tiền tiết kiệm */
        }
    }
</style>
@endsection
