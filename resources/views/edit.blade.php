<!DOCTYPE html>
<html lang="mr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Edit Task</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.container {
    background: white;
    padding: 40px;
    border-radius: 20px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    text-align: center;
}

h1 {
    margin-bottom: 20px;
    color: #4c51bf;
    font-size: 2rem;
}

input, select {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    font-size: 1rem;
}

input:focus, select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102,126,234,0.2);
}

button {
    width: 100%;
    padding: 12px;
    background: #4c51bf;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #4338ca;
    transform: translateY(-2px);
}

.back {
    display: inline-block;
    margin-top: 15px;
    color: #4c51bf;
    text-decoration: none;
    font-weight: 600;
}

.back:hover {
    text-decoration: underline;
}
</style>

</head>
<body>

<div class="container">

    <h1>✏️ Edit Task</h1>

    <form action="/task/{{ $task->id }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ $task->title }}" required>

        <input type="text" name="description" value="{{ $task->description }}">

        <select name="status">
            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>
                Completed
            </option>
        </select>

        <button type="submit">Update Task</button>
    </form>

    <a href="/" class="back">← Back to Tasks</a>

</div>

</body>
</html>