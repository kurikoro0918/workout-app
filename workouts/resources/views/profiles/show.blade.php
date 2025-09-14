<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}のプロフィール</title>
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

    <header class="text-center mb-8">
        <div class="w-24 h-24 mx-auto bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold text-4xl mb-4">
            {{ mb_substr($user->name, 0, 1) }}
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">{{ $user->name }}</h1>

        @if ($user->introduction)
            <p class="text-gray-600 max-w-lg mx-auto">{{ $user->introduction }}</p>
        @endif

        <div class="mt-6">
            <a href="{{ route('timeline.index') }}" class="inline-block bg-white hover:bg-gray-50 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors duration-200 border border-gray-300">
                タイムラインに戻る
            </a>
        </div>
    </header>

    <hr class="my-8 border-gray-300">

    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ $user->name }}の筋トレ記録</h2>
    <div class="max-w-2xl mx-auto space-y-6">
        @forelse ($workouts as $workout)
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">{{ $workout->exercise_name }}</h3>
                    <p class="text-xs text-gray-500">{{ $workout->created_at->format('Y年m月d日 H:i') }}</p>
                </div>

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
