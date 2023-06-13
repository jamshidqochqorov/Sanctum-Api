<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
   use HttpResponse;
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'user_id'=>auth()->user()->id,
            'name'=>$request->name,
            'description'=>$request->description,
            'priority'=>$request->priority
        ]);
         return new TaskResource($task);
    }


    public function show($id)
    {
        $task = Task::find($id);
        if(!$task){
            return $this->error('','Task not fount',404);
        }
        return $this->isNotAuthorized($task)?$this->isNotAuthorized($task):new TaskResource($task);
    }


    public function update(Request $request, Task $task)
    {
        if($this->isNotAuthorized($task)){
            return $this->isNotAuthorized($task);
        }
        $task->update($request->all());
        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        return $this->isNotAuthorized($task)?$this->isNotAuthorized($task):$task->delete();
    }

    private function isNotAuthorized($task){

        if(Auth::user()->id !== $task->user_id){
            return $this->error('','You are not authorized to make this request',403);
        }
    }
}
