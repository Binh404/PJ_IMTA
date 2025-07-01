<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@yield('styles')
    <!-- Custom CSS -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Top Navbar (Cố định) */
        .navbar-top {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #343a40;
            color: white;
            z-index: 1030;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 20px;
        }

        .navbar-brand {
            margin: 0;
            font-size: 1.5rem;
        }

        /* Marquee chạy ngang trong thanh navbar */
        .marquee {
            white-space: nowrap;
            overflow: hidden;
            display: inline-block;
            animation: marquee 8s linear infinite;
            font-size: 1rem;
            margin-left: 20px;
        }

        @keyframes marquee {
            from { transform: translateX(100%); }
            to { transform: translateX(-100%); }
        }

        /* Sidebar Navigation */
        .sidebar {
            position: fixed;
            top: 64px;
            left: 0;
            height: calc(100% - 56px);
            width: 240px;
            background-color: #343a40;
            color: white;
            padding: 20px;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 8px;
            border-radius: 4px;
        }

        .sidebar a:hover, .sidebar .active {
            background-color: #495057;
        }

       /* Content */
.content {
    margin-top: 56px;
    padding: 20px;
    transition: all 0.3s ease;
}

.content.full-width {
    margin-left: 0;
    width: calc(100% - 20px); /* Giữ khoảng cách với viền */
}

.content.collapsed {
    margin-left: 240px;
    width: calc(100% - 260px); /* Trừ đi chiều rộng sidebar + khoảng cách */
}


        /* Toggle Button */
        .toggle-btn {
            position: fixed;
            top: 68px;
            /* left: 204px; */
            background-color: #343a40;
            color: white;
            cursor: pointer;
            z-index: 1040;
            transition: all 0.3s ease;
            padding: 8px 10px;
            border-radius: 4px;
            border: 1px solid #495057;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .toggle-btn:hover {
            background-color: #495057;
        }

        .toggle-btn.collapsed {
            left: 209px;
        }

        .toggle-btn i {
            font-size: 1.5rem;
            color: white;
        }

        .toggle-btn.square {
            width: 32px;
            height: 34px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
          /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>

    <!-- Top Navbar -->
    <nav class="navbar navbar-dark bg-dark navbar-top">
        <span class="navbar-brand">Dashboard</span>
        <div class="marquee">
            Xin chào mọi người! Chào mừng đến với hệ thống quản lý tài chính cá nhân của bình! (chạy máy tính sẽ hiển thị tốt hơn, tại tui chưa tối ưu)
        </div>
    </nav>

    <!-- Toggle Button -->
    <div class="toggle-btn square" id="toggle-btn">
        <i class="bi bi-chevron-double-left"></i>
    </div>

   <!-- Sidebar -->
<div class="sidebar hidden d-flex flex-column justify-content-between vh-100 p-3" id="sidebar">
    <div>
        <h4 class="mb-4">💼 Quản lý tài chính</h4>
        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active fw-bold' : '' }}">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
        <a href="{{ route('transactions.index') }}" class="{{ request()->is('transactions*') ? 'active fw-bold' : '' }}">
            <i class="fas fa-exchange-alt me-2"></i> Giao dịch
        </a>
        <a href="{{ route('budgets.index') }}" class="{{ request()->is('budgets*') ? 'active fw-bold' : '' }}">
            <i class="fas fa-wallet me-2"></i> Ngân sách
        </a>
        <a href="{{ route('goals.index') }}" class="{{ request()->is('goals*') ? 'active fw-bold' : '' }}">
            <i class="fas fa-bullseye me-2"></i> Mục tiêu
        </a>
        <a href="{{ route('savings.index') }}" class="{{ request()->is('savings*') ? 'active fw-bold' : '' }}">
            <i class="fas fa-piggy-bank me-2"></i> Khoản tiết kiệm
        </a>
    </div>

    <form action="{{ route('logout') }}" method="POST" class="mt-4">
    @csrf
    <button style="margin-bottom: 74px" type="submit" class="btn btn-danger w-100">
        <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
    </button>
</form>


</div>


  <!-- Main Content -->
<div class="content full-width" id="content">
    @yield('content')
</div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toggle Sidebar Script -->
    <script>
      const toggleBtn = document.getElementById('toggle-btn');
const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');

toggleBtn.addEventListener('click', function () {
    sidebar.classList.toggle('hidden');
    content.classList.toggle('full-width');
    content.classList.toggle('collapsed');
    toggleBtn.classList.toggle('collapsed');
    toggleBtn.innerHTML = sidebar.classList.contains('hidden') ?
        '<i class="bi bi-chevron-double-right"></i>' :
        '<i class="bi bi-chevron-double-left"></i>';
});

    </script>
 <!-- Footer -->
    <div class="footer">
        &copy; Quản lý tài chính by Le Quoc Binh
    </div>

    <style>

       /* Tùy chỉnh khoảng cách cho nút Đăng xuất */
.sidebar form {
    margin-bottom: 100px !important;  /* Điều chỉnh giá trị margin-top để nút Đăng xuất lên cao */
}
/* Responsive cho iPhone, màn hình nhỏ hơn 576px */
/* @media (max-width: 576px) {
    .sidebar {
        top: 75px;
        width: 170px;
    }
    .toggle-btn {
        top: 89px;
        left: 150px;
    }
    .btn.btn-success {
        width: 70%;
    }
    .content {
        margin-left: 170px;
    }
} */

    </style>
</body>
</html>
