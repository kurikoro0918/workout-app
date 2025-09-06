<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>筋トレ記録</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom scrollbar for a sleek look */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #1e1e1e;
        }
        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-200">

<div class="container mx-auto p-4 md:p-8">

    <header class="text-center mb-10">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-100 mb-2">My Workout Log</h1>
        <p class="text-gray-400">日々の努力を記録し、成果を可視化しよう。</p>
    </header>

    @if(session('success'))
        <div class="bg-green-600 bg-opacity-30 border border-green-700 text-green-100 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="text-center mb-8">
        <a href="{{ route('workouts.create') }}" class="inline-flex items-center justify-center bg-gray-700 hover:bg-gray-600 text-gray-100 font-semibold py-3 px-6 rounded-xl transition-colors duration-200 shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            新しい記録を追加
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($workouts as $workout)
            <div class="bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-2xl font-bold text-gray-50">{{ $workout->exercise_name }}</h2>
                    <div class="flex space-x-2 opacity-70 hover:opacity-100 transition-opacity">
                        <a href="{{ route('workouts.edit', $workout->id) }}" class="text-gray-400 hover:text-blue-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.605 9.172a1 1 0 10-1.414 1.414L10.95 11.95l-3.232 3.232a1 1 0 00.342 1.616l1.267.317a1 1 0 001.026-.143l1.83-1.83 2.56-2.57z" />
                            </svg>
                        </a>
                        <form action="{{ route('workouts.destroy', $workout->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="space-y-2 text-gray-400">
                    <p><strong>重量:</strong> {{ $workout->weight ?? '-' }} kg</p>
                    <p><strong>回数:</strong> {{ $workout->reps ?? '-' }} 回</p>
                    <p><strong>セット:</strong> {{ $workout->sets ?? '-' }} セット</p>
                    <p><strong>メモ:</strong> {{ $workout->notes ?? 'なし' }}</p>
                </div>

                <p class="text-xs text-gray-500 mt-4">{{ $workout->created_at->format('Y年m月d日 H:i') }}</p>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 py-12">
                <p class="text-lg">まだ記録がありません。</p>
                <p>最初の記録を追加してみましょう！</p>
            </div>
        @endforelse
    </div>
</div>

</body>
</html>
