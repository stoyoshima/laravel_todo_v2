<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//追記
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //タスク未完了のもの（statusカラムがfalse）のみ表示
        $tasks = Task::where('status', false)->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //バリデーション
        $rules = [
            'task_name' => 'required|max:100',
        ];

        $messages = ['required' => '必須項目です',
                    'max' => '100文字以内で入力してください。'];
        
        Validator::make($request->all(), $rules, $messages)->validate();

        //EloquentによるDB操作

        //モデルをインスタンス化
        $task = new Task;
        //モデル->カラム名 = 値で、データを割り当てる
        $task->name = $request->input('task_name');
        //DB保存
        $task->save();

        return redirect('/tasks');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //【更新する】ボタンを押したとき
        if ($request->status === null) {
            $rules = [
                'task_name' => 'required|max:100',
            ];
            $messages = ['required' => '必須項目です', 'max' => '100文字以内で入力してください。'];
    
            Validator::make($request->all(), $rules, $messages)->validate();
            //タスクを検索
            $task = Task::find($id);
            //モデル->カラム名 = 値 で、データを割り当てる
            $task->name = $request->input('task_name');
            //DB保存
            $task->save();
        } else {
            //【完了】ボタンを押したとき
            $task = Task::find($id);

            $task->status = true;

            $task->save();
        }


        return redirect('/tasks');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Task::find($id)->delete();

        return redirect('/tasks');
    }
}
