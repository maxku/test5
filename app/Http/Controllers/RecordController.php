<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class RecordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Check input values
    public function checkValidator($input)
    {
        $rules = [
            'mark'   => 'required|in:BMW,Mercedes,Opel,Honda',
            'color'  => 'required|in:Red,Blue,White,Black',
            'number' => 'required|alpha_num|unique:records',
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
        return view('/');
    }

    // Builds list of records
    public function getList()
    {
        if (!Auth::check()) {
            return false;
        }
        $records = Record::where('user_id', '=', Auth::id())->get();
        return view('record/list', ['records' => $records]);
    }

    public function getCreate()
    {
        return view('record/create', ['record' => '']);
    }

    // Create new record in DB
    public function postCreate()
    {
        // Validate
        if (is_array($res = RecordController::checkValidator(Input::all()))) {
            return $res;
        }

        $record = new Record;

        $record->mark = Input::get('mark');
        $record->color = Input::get('color');
        $record->number = Input::get('number');
        $record->user_id = Auth::id();

        $record->save();

        return ['url' => '/'];
    }

    // Delete record from DB
    public function getDelete($id)
    {
        if (!Auth::check()) {
            return false;
        }

        $rec = Record::find($id);
        if ($rec->user_id == Auth::id()) {
            $rec->delete();
        }
        return Redirect('/');
    }

}
