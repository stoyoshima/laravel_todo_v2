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
                <p class="text-center text-2xl font-bold">完了したタスク一覧</p> 
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            <div class="text-start pt-10">
                <a href="/tasks" class="underline underline-offset-2 hover:text-sky-400">戻る</a>
            </div>
        </div>
    </main>
</body>
</html>