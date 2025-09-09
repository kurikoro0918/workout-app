<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記録を編集</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .number-input-container {
            position: relative;
        }
        .number-btn {
            position: absolute;
            right: 0;
            width: 32px;
            height: 50%;
            background-color: #e5e7eb;
            color: #4b5563;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.2s;
            border: 1px solid #d1d5db;
        }
        .number-btn:hover {
            background-color: #d1d5db;
        }
        .number-btn-up {
            top: 0;
            border-top-right-radius: 8px;
        }
        .number-btn-down {
            bottom: 0;
            border-bottom-right-radius: 8px;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

<div class="container mx-auto p-4 md:p-8">

    <header class="text-center mb-8">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-2">記録を編集</h1>
        <p class="text-gray-600">変更を保存して、ワークアウトをアップデートしよう。</p>
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
        <form action="{{ route('workouts.update', $workout->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="exercise_name" class="block text-sm font-medium text-gray-600 mb-1">種目名</label>
                <input type="text" id="exercise_name" name="exercise_name" value="{{ old('exercise_name', $workout->exercise_name) }}" placeholder="例：ベンチプレス" class="w-full bg-gray-50 text-gray-900 border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition duration-200">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="number-input-container">
                    <label for="weight" class="block text-sm font-medium text-gray-600 mb-1">重量 (kg)</label>
                    <input type="number" id="weight" name="weight" value="{{ old('weight', $workout->weight) }}" placeholder="0" class="w-full bg-gray-50 text-gray-900 border border-gray-300 rounded-lg py-2 px-3 pr-10 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition duration-200">
                    <div class="number-btn number-btn-up" data-target="weight">▲</div>
                    <div class="number-btn number-btn-down" data-target="weight">▼</div>
                </div>
                <div class="number-input-container">
                    <label for="reps" class="block text-sm font-medium text-gray-600 mb-1">回数</label>
                    <input type="number" id="reps" name="reps" value="{{ old('reps', $workout->reps) }}" placeholder="0" class="w-full bg-gray-50 text-gray-900 border border-gray-300 rounded-lg py-2 px-3 pr-10 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition duration-200">
                    <div class="number-btn number-btn-up" data-target="reps">▲</div>
                    <div class="number-btn number-btn-down" data-target="reps">▼</div>
                </div>
                <div class="number-input-container">
                    <label for="sets" class="block text-sm font-medium text-gray-600 mb-1">セット数</label>
                    <input type="number" id="sets" name="sets" value="{{ old('sets', $workout->sets) }}" placeholder="0" class="w-full bg-gray-50 text-gray-900 border border-gray-300 rounded-lg py-2 px-3 pr-10 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition duration-200">
                    <div class="number-btn number-btn-up" data-target="sets">▲</div>
                    <div class="number-btn number-btn-down" data-target="sets">▼</div>
                </div>
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-600 mb-1">メモ</label>
                <textarea id="notes" name="notes" rows="4" placeholder="今日の調子はどうだった？" class="w-full bg-gray-50 text-gray-900 border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition duration-200">{{ old('notes', $workout->notes) }}</textarea>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('workouts.index') }}" class="inline-flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-5 rounded-lg transition-colors duration-200 border border-gray-300">
                    戻る
                </a>
                <button type="submit" class="inline-flex items-center justify-center bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-5 rounded-lg transition-colors duration-200">
                    記録を更新
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const upButtons = document.querySelectorAll('.number-btn-up');
        const downButtons = document.querySelectorAll('.number-btn-down');

        const updateValue = (targetId, increment) => {
            const input = document.getElementById(targetId);
            let currentValue = parseInt(input.value) || 0;
            currentValue += increment;
            if (currentValue < 0) {
                currentValue = 0;
            }
            input.value = currentValue;
        };

        upButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.getAttribute('data-target');
                updateValue(targetId, 10);
            });
        });

        downButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.getAttribute('data-target');
                updateValue(targetId, -10);
            });
        });
    });
</script>

</body>
</html>
