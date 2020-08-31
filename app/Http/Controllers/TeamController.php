<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Team;

class TeamController extends Controller
{
    /**
     * Fetch team
     *
     * @param Team $team
     * @return Team model
     */
    public function fetch(Team $team) {
        return $team;
    }

    /**
     * Create team
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse model with status code
     */
    public function createTeam(Request $request) {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:255|alpha_dash',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }

        return response()->json(Team::create($request->all()), 200);

    }
}
