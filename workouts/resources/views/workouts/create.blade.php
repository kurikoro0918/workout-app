<!DOCTYPE html>
<html lang="ja">
<head>
    <title>新規記録追加</title>
</head>
<body>
<h1>新規記録追加</h1>
<form action="{{ route('workouts.store') }}" method="POST">
    @csrf
    <label for="exercise_name">種目名:</label><br>
    <input type="text" id="exercise_name" name="exercise_name" required><br>

    <label for="weight">重量 (kg):</label><br>
    <input type="number" id="weight" name="weight"><br>

    <label for="reps">回数:</label><br>
    <input type="number" id="reps" name="reps"><br>

    <label for="sets">セット数:</label><br>
    <input type="number" id="sets" name="sets"><br>

    <label for="notes">メモ:</label><br>
    <textarea id="notes" name="notes"></textarea><br>

    <button type="submit">記録を保存</button>
</form>
<a href="{{ route('workouts.index') }}">戻る</a>
</body>
</html>
