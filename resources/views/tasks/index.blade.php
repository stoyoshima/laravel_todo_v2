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
        <div class="mx-48">
            <div class="my-20">
                <p class="text-center text-2xl font-bold">今日は何をする？？</p> 
            </div>
            <div class="mx-48">
                <form action="/tasks" method="post" class="">
                    @csrf
                    <input type="text" name="task_name" placeholder="掃除をする" class="border border-slate-400 w-full h-14 rounded-md">
                    @error('task_name')
                        <div>
                            <p class="text-red-600">{{ $message }}</p>
                        </div>
                    @enderror
                    <div class="flex p-7 justify-between">
                        <div>
                        </div>
                        <div>
                            <button type="submit" class="bg-red-300 hover:bg-red-200 rounded-md w-80 h-10">追加する</button>
                        </div>
                        <div>
                        </div>
                    </div>
                </form>
            </div>
        
            @if ($tasks->isNotEmpty())
            <div class="mt-10 rounded-md">
                <table class="w-full">
                    <thead class="">
                        <tr class="w-full text-left bg-slate-100 pt-2">
                            <th class="">タスク</th>
                            <th class=""></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="">
                                    {{ $task->name }}
                                </td>
                                <td class="w-52 h-20">
                                    <div class="flex justify-end h-full text-center">
                                        <div class="w-full h-full bg-cyan-200 hover:bg-cyan-400 ">
                                            <form action="/tasks/{{ $task->id }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="{{ $task->status }}">
                                                <button type="submit" class="">完了</button>
                                            </form>
                                        </div>
                                        <div class="w-full h-full">
                                            <a href="/tasks/{{ $task->id }}/edit/" class="">編集</a>
                                        </div>
                                        <div class="w-full h-full">
                                            <form action="/tasks/{{ $task->id }}" method="post" onsubmit="return deleteTask();">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="">削除</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
            </div>
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