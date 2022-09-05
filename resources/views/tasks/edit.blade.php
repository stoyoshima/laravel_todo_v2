<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoアプリ</title>

    <!-- css読み込み -->
    @vite('resources/css/app.css')
</head>
<body>
    <header>
        <div>
            <p>ToDoアプリ編集画面</p>
        </div>
    </header>

    <div>
        <form action="/tasks/{{ $task->id }}" method="post">
            @csrf
            @method('PUT')

            <div>
                <input type="text" name="task_name" value="{{ $task->name }}" class="border-2">
                @error('task_name')
                    <div>
                        <p class="text-red-600">{{ $message }}</p>
                    </div>
                @enderror
                <div>
                    <a href="/tasks" class="">戻る</a>
                    <button type="submit" class="bg-teal-200 hover:bg-teal-400">更新する</button>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>