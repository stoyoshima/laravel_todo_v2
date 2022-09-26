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
    <header class="bg-red-300 h-20">
        <div class="mx-auto px-4">
            <div class="py-6">
                <p class="text-white text-xl">ToDoアプリ</p>
            </div>
        </div>
    </header>
    <div class="mx-48 sm:contents">
        <div class="my-20">
            <p class="text-center text-2xl font-bold">タスク編集画面</p> 
        </div>
        <div class="mx-48">
            <form action="/tasks/{{ $task->id }}" method="post">
                @csrf
                @method('PUT')
                <input type="text" name="task_name" value="{{ $task->name }}" class="border border-slate-400 w-full h-14 rounded-md">
                @error('task_name')
                    <div>
                        <p class="text-red-600">{{ $message }}</p>
                    </div>
                @enderror
                <div class="flex p-7 justify-between">
                    <div>
                        <a href="/tasks" class="underline underline-offset-2 hover:text-sky-400">戻る</a>
                    </div>
                    <div>
                        <button type="submit" class="bg-yellow-200 hover:bg-yellow-400 rounded-md w-80 h-10">更新する</button>
                    </div>
                    <div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>