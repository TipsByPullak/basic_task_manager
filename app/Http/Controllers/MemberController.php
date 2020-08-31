<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Member;
use App\Task;

class MemberController extends Controller
{
    /**
     * Fetch details of a member
     *
     * @param UUID team_id : ID of the relevant team
     * @param Member $member_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch($team_id, Member $member_id) {
        $data['teamID'] = $team_id;
        $data['id'] = $member_id;

        $validatedData = Validator::make($data, [
            'teamID' => 'UUID',
            'id' => 'required|UUID',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }

        return $member_id::where('teamID', '=', $team_id)->get();
    }

    /**
     * Create a team member
     *
     * @param Request $request
     * @param UUID team_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request, $team_id)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:255|alpha_dash',
            'email' => 'required|email',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }

        $member = new Member();
        $member->name = $request->input('name');
        $member->email = $request->input('email');
        $member->teamID = $team_id;
        $member->save();

        return response()->json($member, 200);
    }

    /**
     * Create a team member
     *
     * @param UUID team_id
     * @param Member member
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove($team_id, Member $member)
    {
        $data['id'] = $team_id;
        $validatedData = Validator::make($data, [
            'id' => 'UUID',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }

        if(!(Task::where([
            ['assigneeID', '=', $member->id],
            ['status', '=', 'todo'],
        ])->get()->isEmpty()
        )) {
            return response()->json('Member cannot be deleted, please reassign all tasks from this member to someone else before trying again', 400);
        }

        $member->delete();

        return response()->json([], 204);
    }
}
