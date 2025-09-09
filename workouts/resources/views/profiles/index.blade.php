<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー一覧</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-900 text-gray-200">
<div class="container mx-auto p-4 md:p-8">
    <header class="text-center mb-10">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-100 mb-2">ユーザー一覧</h1>
        <p class="text-gray-400">他のユーザーの記録をチェックしよう！</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($users as $user)
            <a href="{{ route('profiles.show', $user->id) }}" class="bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1 block">
                <h2 class="text-2xl font-bold text-gray-50">{{ $user->name }}</h2>
                <p class="text-gray-400 mt-2">{{ $user->workouts_count }} 件の記録</p>
            </a>
        @empty
            <div class="col-span-full text-center text-gray-500 py-12">
                <p class="text-lg">ユーザーが見つかりません。</p>
            </div>
        @endforelse
    </div>
</div>
</body>
</html>
