<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Student Portal')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.0/base.css">
<script src="https://cdn.tailwindcss.com"></script>
    <style>
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        th { background: #e3342f; color: white; padding: 12px 16px; text-align: left; }
        td { padding: 12px 16px; border-bottom: 1px solid #eee; }
        .actions a { margin-right: 10px; text-decoration: none; font-size: 13px; }
        .edit { color: #2196F3; }
        .delete { color: #e53935; }
        .alert-success { background: #e6ffed; border: 1px solid #4CAF50; color: #2e7d32; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; }
        .empty { text-align: center; padding: 40px; color: #888; background: white; border-radius: 8px; }
        .error { color: #e53935; font-size: 13px; margin-bottom: 12px; }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-red-600 text-white px-8 py-4 flex justify-between items-center shadow">
        <span class="text-xl font-bold">🎓 Student Portal</span>
        @auth
        <div class="flex items-center gap-4">
            <span class="text-sm">👤 {{ auth()->user()->name }}</span>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="text-sm underline bg-transparent border-0 text-white cursor-pointer">Log out</button>
            </form>
        </div>
        @endauth
    </nav>
    <div class="max-w-5xl mx-auto mt-10 px-4">
        @yield('content')
    </div>
</body>
</html>