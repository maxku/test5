<?php

namespace App\Http\Controllers;

use App\Record;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    // Check input values
    public function checkValidator($input)
    {
        $rules = [
            'mark'   => 'required|in:BMW,Mercedes,Opel,Honda',
            'color'  => 'required|in:Red,Blue,White,Black',
            'number' => 'required|alpha_num|unique:records',
            'user'   => 'required|integer|exists:users,id',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return [
                'fail'   => true,
                'errors' => $validator->getMessageBag()->toArray(),
            ];
        }
    }

    // Main page
    public function getIndex()
    {
        return view('admin/index');
    }

    // Builds list of records
    public function getList()
    {
        $records = Record::all();
        $users = User::all();
        return view('admin/list', ['records' => $records, 'users' => $users]);
    }

    public function getCreate()
    {
        $users = User::all();
        $result = [];
        foreach ($users as $user) {
            $result["$user->id"] = $user->email;
        }

        return view('admin/create', ['users' => $result]);
    }

    // Create new record in DB
    public function postCreate()
    {
        // Validate
        if (is_array($res = AdminController::checkValidator(Input::all()))) {
            return $res;
        }

        $record = new Record;

        $record->mark = Input::get('mark');
        $record->color = Input::get('color');
        $record->number = Input::get('number');
        $record->user_id = Input::get('user');

        $record->save();

        return ['url' => 'admin'];
    }

    // Delete record from DB
    public function getDelete($id)
    {
        $rec = Record::find($id);
        $rec->delete();

        return Redirect('admin');
    }

}
