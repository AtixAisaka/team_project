<?php

namespace App\Http\Controllers;


use App\Events;
use Auth;
use Calendar;
use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EventsController extends Controller
{

    public function index(){
        if (Auth::check())
        {
            $user = Auth::user();
            $events = Events::get();
            $event_list = [];
            foreach ($events as $key => $events) {
                $event_list[] = Calendar::event(
                    $events->event_name,
                    true,
                    new \DateTime($events->start_date),
                    new \DateTime($events->end_date.' +1 day')
                );
            }
            $calendar_details = Calendar::addEvents($event_list);

            return view('events', compact('calendar_details'), ["user" => $user]);
        } else return view("home");
    }

    public function showEventList(){
        if (Auth::check())
        {
            $user = Auth::user();
            $events = Events::all();

            return view('eventlist', ["events" => $events], ["user" => $user]);
        } else return view("home");
    }

    public function addEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'userid' => 'required',
            'end_date' => 'required'
        ]);

        if ($validator->fails()) {
            \Session::flash('warnning','Nekompletné alebo nesprávne dáta');
            return Redirect::to('/events')->withInput()->withErrors($validator);
        }

        $events = new Events;
        $events->event_name = $request['event_name'];
        $events->start_date = $request['start_date'];
        $events->end_date = $request['end_date'];
        $events->userid = $request['userid'];
        $events->save();

        \Session::flash('success','Event Pridaný');
        return Redirect::to('/events');

    }
}

