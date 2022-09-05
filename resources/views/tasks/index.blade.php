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

    <main>
        <div class="mx-auto">
            <div class="my-20">
                <p class="text-center text-2xl font-bold">今日は何をする？？</p> 
            </div>
            <form action="/tasks" method="post" class="">
                @csrf
                <input type="text" name="task_name" placeholder="掃除をする" class="border border-slate-400 w-full">
                @error('task_name')
                    <div>
                        <p class="text-red-600">{{ $message }}</p>
                    </div>
                @enderror
                <button type="submit" class="bg-red-300 hover:bg-red-200">追加する</button>
            </form>
        
            @if ($tasks->isNotEmpty())
                <div>タスク一覧</div>
                <table>
                    <thead>
                        <tr>タスク</tr>
                        <tr>アクション</tr>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>
                                        <div>
                                            {{ $task->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex">
                                            <div>
                                                <form action="/tasks/{{ $task->id }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="{{ $task->status }}">
                                                    <button type="submit" class="bg-cyan-200 hover:bg-cyan-400">完了</button>
                                                </form>
                                            </div>
                                            <div>
                                                <a href="/tasks/{{ $task->id }}/edit/" class="bg-amber-200 hover:bg-amber-400">編集</a>
                                            </div>
                                            <div>
                                                <form action="/tasks/{{ $task->id }}" method="post" onsubmit="return deleteTask();">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-cyan-200 hover:bg-cyan-400">削除</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </thead>
                </table>
            @endif
        </div>
    </main>
    
    <script>
        function deleteTask() {
            if (confirm('本当に削除しますか？')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>
</html>