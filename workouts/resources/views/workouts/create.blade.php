<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新しい記録を追加</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Style the custom number buttons */
        .number-input-container {
            position: relative;
        }
        .number-btn {
            position: absolute;
            right: 0;
            width: 32px;
            height: 50%;
            background-color: #3f3f46;
            color: #d1d5db;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.2s;
            border: 1px solid #4b5563;
        }
        .number-btn:hover {
            background-color: #52525b;
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
    <!-- Google Fonts for a modern look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-200">

<div class="container mx-auto p-4 md:p-8">

    <!-- Header Section -->
    <header class="text-center mb-8">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-100 mb-2">新しい記録を追加</h1>
        <p class="text-gray-400">今日のワークアウトを記録しよう。</p>
    </header>

    <!-- Error Message -->
    @if ($errors->any())
        <div class="bg-red-600 bg-opacity-30 border border-red-700 text-red-100 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-gray-800 p-6 rounded-xl shadow-lg max-w-xl mx-auto">
        <form action="{{ route('workouts.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="exercise_name" class="block text-sm font-medium text-gray-400 mb-1">種目名</label>
                <input type="text" id="exercise_name" name="exercise_name" value="{{ old('exercise_name') }}" placeholder="例：ベンチプレス" class="w-full bg-gray-700 text-gray-50 border border-gray-600 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition duration-200">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="number-input-container">
                    <label for="weight" class="block text-sm font-medium text-gray-400 mb-1">重量 (kg)</label>
                    <input type="number" id="weight" name="weight" value="{{ old('weight') }}" placeholder="0" class="w-full bg-gray-700 text-gray-50 border border-gray-600 rounded-lg py-2 px-3 pr-10 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition duration-200">
                    <div class="number-btn number-btn-up" data-target="weight">▲</div>
                    <div class="number-btn number-btn-down" data-target="weight">▼</div>
                </div>
                <div class="number-input-container">
                    <label for="reps" class="block text-sm font-medium text-gray-400 mb-1">回数</label>
                    <input type="number" id="reps" name="reps" value="{{ old('reps') }}" placeholder="0" class="w-full bg-gray-700 text-gray-50 border border-gray-600 rounded-lg py-2 px-3 pr-10 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition duration-200">
                    <div class="number-btn number-btn-up" data-target="reps">▲</div>
                    <div class="number-btn number-btn-down" data-target="reps">▼</div>
                </div>
                <div class="number-input-container">
                    <label for="sets" class="block text-sm font-medium text-gray-400 mb-1">セット数</label>
                    <input type="number" id="sets" name="sets" value="{{ old('sets') }}" placeholder="0" class="w-full bg-gray-700 text-gray-50 border border-gray-600 rounded-lg py-2 px-3 pr-10 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition duration-200">
                    <div class="number-btn number-btn-up" data-target="sets">▲</div>
                    <div class="number-btn number-btn-down" data-target="sets">▼</div>
                </div>
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-400 mb-1">メモ</label>
                <textarea id="notes" name="notes" rows="4" placeholder="今日の調子はどうだった？" class="w-full bg-gray-700 text-gray-50 border border-gray-600 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition duration-200">{{ old('notes') }}</textarea>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('workouts.index') }}" class="inline-flex items-center justify-center bg-gray-700 hover:bg-gray-600 text-gray-100 font-semibold py-2 px-5 rounded-lg transition-colors duration-200">
                    戻る
                </a>
                <button type="submit" class="inline-flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-5 rounded-lg transition-colors duration-200">
                    記録を保存
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Find all number buttons
        const upButtons = document.querySelectorAll('.number-btn-up');
        const downButtons = document.querySelectorAll('.number-btn-down');

        // Function to update the input value
        const updateValue = (targetId, increment) => {
            const input = document.getElementById(targetId);
            let currentValue = parseInt(input.value) || 0;
            currentValue += increment;
            if (currentValue < 0) {
                currentValue = 0; // Prevent negative values
            }
            input.value = currentValue;
        };

        // Add event listeners to up buttons
        upButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.getAttribute('data-target');
                updateValue(targetId, 10);
            });
        });

        // Add event listeners to down buttons
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
