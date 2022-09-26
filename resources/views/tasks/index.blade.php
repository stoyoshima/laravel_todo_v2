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
        <div class="contents sm:mx-48">
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
                        <div class="">
                        </div>
                    </div>
                </form>
            </div>
        
            @if ($tasks->isNotEmpty())
            <div class="mt-10 rounded-md">
                <div class="text-end m-5">
                    <a href="{{ url('/tasks',$tasks) }}" class="py-1 px-3 rounded-md border border-red-300 bg-red-300 hover:bg-white">完了タスク一覧</a>
                </div>
                <table class="w-full divide-y divide-gray-300">
                    <thead class="">
                        <tr class="w-full text-left bg-slate-100 pt-2">
                            <th class="">タスク</th>
                            <th class=""></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($tasks as $task)
                            <tr class="">
                                <td >
                                    {{ $task->name }}
                                </td>
                                <td class="w-52 h-20">
                                    <div class="flex justify-end h-full ">
                                        <div class="w-full h-full flex justify-center items-center">
                                            <form action="/tasks/{{ $task->id }}" method="post" class="">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="{{ $task->status }}">
                                                <div class="w-full h-full ">
                                                    <button type="submit" class="underline underline-offset-2 hover:text-cyan-500">完了</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="w-full h-full flex justify-center items-center">
                                            <a href="/tasks/{{ $task->id }}/edit/" class="underline underline-offset-2 hover:text-green-500">編集</a>
                                        </div>
                                        <div class="w-full h-full flex justify-center items-center">
                                            <form action="/tasks/{{ $task->id }}" method="post" onsubmit="return deleteTask();">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="underline underline-offset-2 hover:text-red-500">削除</button>
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