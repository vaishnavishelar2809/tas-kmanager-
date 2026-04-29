<!DOCTYPE html>
<html lang="mr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - My Tasks</title>
    
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
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        header {
            background: linear-gradient(135deg, #4c51bf, #667eea);
            color: white;
            padding: 30px 40px;
            text-align: center;
        }

        h1 {
            font-size: 2.8rem;
            font-weight: 700;
        }

        .subtitle {
            opacity: 0.9;
            margin-top: 8px;
            font-size: 1.1rem;
        }

        .add-task {
            padding: 40px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-group {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        input, select, button {
            padding: 14px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            font-size: 1rem;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }

        input[type="text"] {
            flex: 1;
            min-width: 250px;
        }

        button {
            background: #4c51bf;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        button:hover {
            background: #4338ca;
            transform: translateY(-2px);
        }

        .tasks-section {
            padding: 40px;
        }

        h2 {
            margin-bottom: 25px;
            color: #1e2937;
            font-size: 1.8rem;
        }

        .task-list {
            list-style: none;
        }

        .task-item {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .task-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #667eea;
        }

        .task-info {
            flex: 1;
        }

        .task-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1e2937;
        }

        .task-desc {
            color: #64748b;
            margin-top: 5px;
            font-size: 0.95rem;
        }

        .task-status {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }

        .status-completed {
            background: #d1fae5;
            color: #10b981;
        }

        .task-actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .edit-btn {
            background: #10b981;
            color: white;
        }

        .delete-btn {
            background: #ef4444;
            color: white;
        }

        .complete-btn {
            background: #3b82f6;
            color: white;
        }

        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>TaskFlow</h1>
        <p class="subtitle">Stay Organized • Get Things Done</p>
    </header>

    @if ($errors->any())
    <div style="background:red;color:white;padding:10px;margin-bottom:10px;border-radius:8px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- Add Task Form -->
    <div class="add-task">
        <form action="/task" method="POST">
    @csrf

    <input type="text" name="title" placeholder="Task Title" required>

    <input type="text" name="description" placeholder="Description (max 500 chars)" required maxlength="500">

    <select name="status">
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
    </select>

    <button type="submit">+ Add Task</button>
</form>
    </div>

    <div class="tasks-section">
        <h2>My Tasks ({{ count($tasks) }})</h2>
        
        <ul class="task-list">
            @foreach($tasks as $task)
            <li class="task-item">
                <div class="task-info">
                    <div class="task-title">{{ $task->title }}</div>
                    @if($task->description)
                        <div class="task-desc">{{ $task->description }}</div>
                    @endif
                </div>
                
                <span class="task-status {{ $task->status == 'completed' ? 'status-completed' : 'status-pending' }}">
                    {{ ucfirst($task->status) }}
                </span>

                <div class="task-actions">
                    <a href="/task/{{ $task->id }}/edit" class="btn edit-btn">Edit</a>
                    
                    <form action="/task/{{ $task->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn delete-btn">Delete</button>
                    </form>
                    
                    @if($task->status != 'completed')
                        <a href="/task/{{ $task->id }}/complete" class="btn complete-btn">Complete</a>
                    @endif
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

</body>
</html>