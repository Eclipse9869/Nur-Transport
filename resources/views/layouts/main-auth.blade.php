<!DOCTYPE html>
<html lang="en" class="min-h-screen">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nur Trans - Login/Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <style>
    * {
      font-family: 'Poppins', sans-serif !important;
    }
  </style>
  <style>
    .glass {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.2);
  }
    .slide-panel {
      transition: transform 0.5s ease-in-out;
    }
    select option {
      background-color: #ffffff;
      color: #111827;
    }
    input:-webkit-autofill {
      -webkit-box-shadow: 0 0 0 1000px rgba(255, 255, 255, 0.95) inset !important;
      -webkit-text-fill-color: #111827 !important;
    }
  </style>
</head>
<body class="w-full min-h-screen flex items-center justify-center bg-gray-150 text-[#111827] font-sans">
  @yield('content')
</body>
</html>
