<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class Main extends Controller
{
    public function home(){

        // get available tasks
        $tasks = Task::where('visible', 1)
                ->orderBy('created_at', 'desc')
                ->get();

        return view('home', ['tasks' => $tasks]);
    }

    public function list_invisibles(){

        // get invisible tasks
        $tasks = Task::where('visible', 0)
                ->orderBy('created_at', 'desc')
                ->get();

        return view('home', ['tasks' => $tasks]);
    }

    public function new_task(){

        // display new task form
        return view('new_task_frm');
    }

    public function new_task_submit(Request $request){

        // get the new task Definition
        $new_task = $request->input('text_new_task');

        // save task in to database
        $task = new Task();
        $task->task = $new_task;
        $task->visible = 0;
        $task->save();

        // return to the main pageY
        return redirect()->route('home');
    }

    public function task_done($id){

        // update to the task - done
        $task = Task::find($id);
        $task->done = new \DateTime();
        $task->save();
        return redirect()->route('home');
    }


    public function task_undone($id){

        // update to the task - undone
        $task = Task::find($id);
        $task->done = null;
        $task->save();
        return redirect()->route('home');
    }

    public function edit_task($id){

        // get selected task
        $task = Task::find($id);

        // display edit task form
        return view('edit_task_frm', ['task' => $task]);
    }

    public function edit_task_submit(Request $request){

        // get form inputs
        $id_task = $request->input('id_task');
        $edit_task = $request->input('text_edit_task');

        // update task
        $task = Task::find($id_task);
        $task->task = $edit_task;
        $task->save();

        // display tasks table
        return redirect()->route('home');


    }

    public function task_invisible($id){

        // make task task_invisible
        $task = Task::find($id);
        $task->visible = 0;
        $task->save();

        return redirect()->route('home');
    }

    public function task_visible($id){

        // make task task_invisible
        $task = Task::find($id);
        $task->visible = 1;
        $task->save();

        return redirect()->route('home');
    }
}
