<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Calendar;
use Illuminate\Support\Facades\Redirect;

class EventsController extends Controller
{
    public function index(){
        return view('events');
    }

    public function addEvent(Request $request){
        $validator = Validator::make($request->all(),[
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        if($validator->false()){
            \Session::flash('warinig','Nesprávne alebo nekompletné udaje pre event');
            return Redirect::to('/events')->withInput()->withErrors($validator);
        }
        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->save();
        \Session::flash('success', 'event pridaný');
        return redirect::to('/events')

    }
}

