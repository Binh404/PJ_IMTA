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

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Gemini Chat Widget</title>
  <style>
    @keyframes bounce-glow {
      0%, 100% {
        transform: translateY(0);
        box-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff;
      }
      50% {
        transform: translateY(-10px);
        box-shadow: 0 0 20px #00f2ff, 0 0 40px #00f2ff;
      }
    }

    #gemini-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 60px;
      height: 60px;
      font-size: 28px;
      background-color: #00f2ff;
      color: white;
      border: none;
      border-radius: 50%;
      cursor: pointer;
      z-index: 9999;
      animation: bounce-glow 2s infinite ease-in-out;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 10px #00f2ff;
      transition: transform 0.3s ease;
    }

    #gemini-button:hover {
      transform: scale(1.2);
    }

    #chat-box {
      position: fixed;
      bottom: 90px;
      right: 20px;
      width: 320px;
      max-height: 500px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
      z-index: 9998;
      display: none;
      flex-direction: column;
      overflow: hidden;
      font-family: sans-serif;
    }

    #chat-header {
      background: #007BFF;
      color: white;
      padding: 10px;
      font-weight: bold;
      border-radius: 10px 10px 0 0;
    }

    #chat-messages {
      padding: 10px;
      height: 300px;
      overflow-y: auto;
      font-size: 14px;
    }

    #chat-input {
      display: flex;
      padding: 10px;
      border-top: 1px solid #eee;
    }

    #chat-question {
      flex: 1;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    #send-btn {
      margin-left: 5px;
      padding: 8px 12px;
      background: #28a745;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
  </style>

<!-- Nút 🤖 bật/tắt chat -->
<button id="gemini-button" title="Trợ lý AI Gemini">🤖</button>

<!-- Khung chat -->
<div id="chat-box">
  <div id="chat-header">💬 Gemini AI</div>
  <div id="chat-messages">
    <div><i>🤖 Xin chào! Bạn cần hỏi gì hôm nay?</i></div>
  </div>
  <div id="chat-input">
    <input type="text" id="chat-question" placeholder="Nhập câu hỏi...">
    <button id="send-btn">Gửi</button>
  </div>
</div>

<script type="module">
import { GoogleGenerativeAI } from "https://esm.run/@google/generative-ai";

const apiKey = "AIzaSyD0ARz3_JsEmCm8qDO9DA3n47p6je4M3Xk";
const genAI = new GoogleGenerativeAI(apiKey);

window.addEventListener("DOMContentLoaded", () => {
  const chatBox = document.getElementById("chat-box");
  const toggleButton = document.getElementById("gemini-button");
  const input = document.getElementById("chat-question");
  const sendBtn = document.getElementById("send-btn");
  const messages = document.getElementById("chat-messages");

  toggleButton.addEventListener("click", () => {
    chatBox.style.display = chatBox.style.display === "none" ? "flex" : "none";
  });

  async function sendToGemini() {
    const question = input.value.trim();
    if (!question) return;

    messages.innerHTML += `<div><b>Bạn:</b> ${question}</div>`;
    input.value = "...";

    try {
      const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
      const result = await model.generateContent(question);
      const response = await result.response;
      const text = response.text();

      messages.innerHTML += `<div><b>🤖 Gemini:</b> ${text}</div>`;
    } catch (e) {
      messages.innerHTML += `<div><b>🤖 Lỗi:</b> Không thể trả lời.</div>`;
    }

    input.value = "";
    messages.scrollTop = messages.scrollHeight;
  }

  sendBtn.addEventListener("click", sendToGemini);
  input.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      event.preventDefault();
      sendToGemini();
    }
  });
});
</script>

