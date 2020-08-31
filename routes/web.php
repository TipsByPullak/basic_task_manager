<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Welcome page landing
Route::get('/', function () {
    return view('welcome');
});

//Routes for TeamController
Route::get('/teams/{team}', 'TeamController@fetch');
Route::post('/teams', 'TeamController@createTeam');

//Routes for MemberController
Route::get('/teams/{team_id}/members/{member_id}', 'MemberController@fetch');
Route::post('/teams/{team_id}/member', 'MemberController@create');
Route::delete('teams/{team_id}/members/{member}', 'MemberController@remove');

//Routes for TaskController
Route::get('/teams/{team}/tasks/{task_id}', 'TaskController@fetchTask');
Route::get('/teams/{id}/tasks', 'TaskController@fetchAllTasks');
Route::get('/teams/{team_id}/members/{member_id}/tasks', 'TaskController@fetchMemberTask');
Route::post('/teams/{team_id}/tasks', 'TaskController@createTask');
Route::patch('teams/{team_id}/tasks/{task}', 'TaskController@patchTask');

