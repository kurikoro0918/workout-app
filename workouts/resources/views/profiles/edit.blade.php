<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール編集</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

<div class="container mx-auto p-4 md:p-8">
    <header class="text-center mb-8">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-2">プロフィール編集</h1>
        <p class="text-gray-600">アカウント情報を更新しよう。</p>
    </header>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow-md max-w-xl mx-auto">
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-600 mb-1">ユーザー名</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-gray-50 text-gray-900 border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition duration-200">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-600 mb-1">メールアドレス</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-gray-50 text-gray-900 border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition duration-200">
            </div>

            <div>
                <label for="introduction" class="block text-sm font-medium text-gray-600 mb-1">自己紹介</label>
                <textarea id="introduction" name="introduction" rows="4" class="w-full bg-gray-50 text-gray-900 border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition duration-200">{{ old('introduction', $user->introduction) }}</textarea>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('workouts.index') }}" class="inline-flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-5 rounded-lg transition-colors duration-200 border border-gray-300">
                    戻る
                </a>
                <button type="submit" class="inline-flex items-center justify-center bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-5 rounded-lg transition-colors duration-200">
                    更新
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
