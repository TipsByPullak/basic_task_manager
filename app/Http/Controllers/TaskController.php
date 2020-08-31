<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Task;
use App\Member;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Fetch one task upon invoking team/{team_id}/tasks/{task_id}
     *
     * @param UUID team_id : The ID of the team
     * @param Task $task_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchTask($team_id, Task $task_id) {
        $data['teamID'] = $team_id;

        $validatedData = Validator::make($data, [
            'teamID' => 'UUID',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }

        return $task_id::where('teamID', '=', $team_id)->get();
    }

    /**
     * Fetch tasks upon invoking /teams/{team_id}/members/{member_id}/tasks
     *
     * @param UUID team_id : The ID of the team
     * @param UUID member_id : The ID of the member
     * @return Task model
     */
    public function fetchMemberTask($team_id, $member_id) {
        return DB::table('tasks')
            ->select('id', 'title', 'desc', 'assigneeID', 'status')
            ->where([
                ['teamID', '=', $team_id],
                ['memberID', '=', $member_id],
                ['status', '=', 'todo'],
            ])->get();
    }

    /**
     * Fetch all tasks of a team upon invoking /teams/{team_id}/tasks
     *
     * @param UUID team_id : The ID of the team
     * @return \Illuminate\Http\JsonResponse model JSON or collection response
     */
    public function fetchAllTasks($team_id) {
        $data['teamID'] = $team_id;

        $validatedData = Validator::make($data, [
            'teamID' => 'required|UUID',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }

        return Task::where([
            ['teamID', '=', $team_id],
            ['status', '=', 'todo'],
            ])->get();
    }

    public function createTask(Request $request, $team_id) {
        //Validation of request
        $validatedData = Validator::make($request->all(), [
            'title' => 'required|string',
            'desc' => 'nullable|string',
            'assigneeID' => 'nullable|UUID',
            'status' => ['nullable',
                Rule::in(['todo', 'done']),
                ],
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }
        $data['teamID'] = $team_id;

        $validatedData = Validator::make($data, [
            'teamID' => 'required|UUID',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }

        $assignee_id = $request->input('assigneeID');
        if(Member::where([
            ['id', '=', $assignee_id],
            ['teamID', '=', $team_id],
            ])->get()->isEmpty()
        ) {
            return response()->json('Assignee does not belong to the specified team', 400);
        }

        $task = new Task();
        $task->title = $request->input('title');
        $task->desc = $request->input('desc');
        $task->assigneeID = $assignee_id;
        $task->status = $request->input('status');
        $task->teamID = $team_id;

        $task->save();
        return response()->json($task, 200);
    }

    public function patchTask(Request $request, $team_id, Task $task){
        $validatedData = Validator::make($request->all(), [
            'title' => 'nullable|string',
            'desc' => 'nullable|string',
            'assigneeID' => 'nullable|UUID',
            'status' => ['nullable',
                Rule::in(['todo', 'done']),
            ],
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }
        $data['teamID'] = $team_id;

        $validatedData = Validator::make($data, [
            'teamID' => 'required|UUID',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }

        $assignee_id = $request->input('assigneeID');

        if(Member::where([
                ['id', '=', $assignee_id],
                ['teamID', '=', $team_id],
            ])->get()->isEmpty()
        ) {
            return response()->json('Assignee does not belong to the specified team', 400);
        }

        $task->update(array_filter($request->all(), function($var) {
            return !empty($var);
        }));
        return response()->json($task, 200);
    }
}
