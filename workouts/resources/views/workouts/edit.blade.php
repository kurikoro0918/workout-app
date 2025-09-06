<!DOCTYPE html>
<html lang="ja">
<head>
    <title>記録編集</title>
</head>
<body>
<h1>記録編集</h1>
<form action="{{ route('workouts.update', $workout->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="exercise_name">種目名:</label><br>
    <input type="text" id="exercise_name" name="exercise_name" value="{{ $workout->exercise_name }}" required><br>

    <label for="weight">重量 (kg):</label><br>
    <input type="number" id="weight" name="weight" value="{{ $workout->weight }}"><br>

    <label for="reps">回数:</label><br>
    <input type="number" id="reps" name="reps" value="{{ $workout->reps }}"><br>

    <label for="sets">セット数:</label><br>
    <input type="number" id="sets" name="sets" value="{{ $workout->sets }}"><br>

    <label for="notes">メモ:</label><br>
    <textarea id="notes" name="notes">{{ $workout->notes }}</textarea><br>

    <button type="submit">記録を更新</button>
</form>
<a href="{{ route('workouts.index') }}">戻る</a>
</body>
</html>
