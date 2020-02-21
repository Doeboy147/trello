<?php

namespace App\Http\Controllers;

use App\Task as Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class Task extends Controller
{
    function saveTask(Request $request)
    {
        try {
            $task = new Model();
            $task->body = $request['task'];
            $task->uuid = Uuid::generate()->string;
            $task->state = 'to-do';
            $task->save();
            return $task;
        } catch (QueryException $exception) {
            return print_r($exception->getMessage());

        }
    }

    function getTasks()
    {
        try {
            $tasks = Model::where('state', 'to-do')->orderBy('created_at', 'DESC')->paginate(10);
            return $tasks;
        } catch (QueryException $exception) {
            return print_r($exception->getMessage());
        }
    }

    function changeState($state, $uuid)
    {
        try {
            return Model::where('uuid', $uuid)->update([
                'state' => $state
            ]);
        } catch (QueryException $exception) {
            return print_r($exception->getMessage());
        }
    }

    function Tasks($state)
    {
        try {
            $doing = Model::where('state', $state)->orderBy('updated_at', 'DESC')->paginate(10);
            return $doing;
        } catch (QueryException $exception) {
            return print_r($exception->getMessage());
        }
    }

    function destroy($id)
    {
        try {
            return Model::where('uuid', $id)->delete();
        } catch (QueryException $exception) {
            return print_r($exception->getMessage());
        }

    }
}
