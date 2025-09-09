<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>筋トレタイムライン</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">

<div class="container mx-auto p-4 md:p-8">

    <header class="text-center mb-10">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-2">タイムライン</h1>
        <p class="text-gray-600">みんなの今日の頑張りをチェック！</p>
        <div class="mt-4 flex justify-center space-x-4">
            @auth
                <a href="{{ route('workouts.index') }}" class="inline-block bg-white hover:bg-gray-50 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors duration-200 border border-gray-300">
                    自分の記録へ
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                        ログアウト
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="inline-block bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                    ログイン/記録する
                </a>
            @endauth
        </div>
    </header>

    <div class="max-w-xl mx-auto space-y-6">
        @forelse ($workouts as $workout)
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 transform hover:-translate-y-1">
                <a href="{{ route('profiles.show', $workout->user->id) }}" class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold text-lg">
                        {{ mb_substr($workout->user->name, 0, 1) }}
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-800">{{ $workout->user->name }}</h3>
                        <p class="text-xs text-gray-500">{{ $workout->created_at->diffForHumans() }}</p>
                    </div>
                </a>

                <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $workout->exercise_name }}</h2>
                <div class="space-y-1 text-gray-600">
                    <p><strong>重量:</strong> {{ $workout->weight ?? '-' }} kg</p>
                    <p><strong>回数:</strong> {{ $workout->reps ?? '-' }} 回</p>
                    <p><strong>セット:</strong> {{ $workout->sets ?? '-' }} セット</p>
                    @if ($workout->notes)
                        <p class="mt-2 text-gray-600">{{ $workout->notes }}</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 py-12">
                <p class="text-lg">まだ記録がありません。</p>
            </div>
        @endforelse
    </div>
</div>

</body>
</html>
