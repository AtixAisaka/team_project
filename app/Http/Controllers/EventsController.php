<?php

namespace App\Http\Controllers;


use App\Events;
use App\UsersGoingEvents;
use Auth;
use Calendar;
use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;

class EventsController extends Controller
{

    public function index(){
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

        if (Auth::check()) {
            $user = Auth::user();
            return view('events', compact('calendar_details', "user"));
        } else {
            return view('events', compact('calendar_details'));
        }
    }

    public function showEventList(){
        $events = Events::all();
        $users = DB::table('users')->get();
        if (Auth::check())
        {
            $authuser = Auth::user();
            $helpertable = UsersGoingEvents::all();
            return view('eventlist', compact("events", "users", "authuser", "helpertable"));
        } else {
            return view('eventlist', compact("events", "users"));
        }
    }

    public function addEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'userid' => 'required',
            'helper' => 'required',
            'end_date' => 'required'
        ]);

        if ($validator->fails()) {
            if($request["helper"] == 0) {
                \Session::flash('warnning', 'Nekompletné alebo nesprávne dáta');
                return Redirect::to('/events')->withInput()->withErrors($validator);
            } else return Redirect::to('/eventlist');
        }

        $events = new Events;
        $events->event_name = $request['event_name'];
        $events->start_date = $request['start_date'];
        $events->start_date = $request['start_date'];
        $events->end_date = $request['end_date'];
        $events->userid = $request['userid'];
        $events->save();

        if($request["helper"] == 0) {
            \Session::flash('success', 'Event Pridaný');
            return Redirect::to('/events');
        } else return Redirect::to('/eventlist');
    }

    public function showEditEvent($id) {
        $event = Events::find($id);
        return view("editevent", ["event" => $event]);
    }

    public function showEventInfo($id) {
        $event = Events::find($id);
        $usereventtable = UsersGoingEvents::all();
        $count = 0;
        $usersgoing = "";

        foreach($usereventtable as $row) {
            if($row->eventid == $id ) {
                $count++;
            }
        }

        $helpercnt = 0;
        foreach($usereventtable as $row) {
            if($row->eventid == $id ) {
                if($helpercnt == $count-1) $usersgoing .= DB::table('users')->where("id", "=", $row->userid)->value("name").".";
                else $usersgoing .= DB::table('users')->where("id", "=", $row->userid)->value("name").", ";
                $helpercnt++;
            }
        }
        return view("showeventinfo", compact( "usersgoing", "count", "event"));
    }

    public function updateEventAction($id, Request $request) {
        $events = Events::find($id);
        $events->event_name = $request['event_name'];
        $events->start_date = $request['start_date'];
        $events->end_date = $request['end_date'];
        $events->save();

        return Redirect::to('/eventlist');
    }

    public function deleteEventAction($id) {
        $event = Events::find($id);
        $event->delete();

        return Redirect::to('/eventlist');
    }

    public function addUserToEvent($id) {
        $eventid = $id;
        $userid = Auth::id();

        $add = new UsersGoingEvents();
        $add->userid = $userid;
        $add->eventid = $eventid;
        $add->save();

        return Redirect::to('/eventlist');
    }

    public function removeUserFromEvent($id) {
        $eventid = $id;
        $userid = Auth::id();

        $remove = UsersGoingEvents::where([
            ['userid', '=', $userid],
            ['eventid', '=', $eventid]
        ]);
        $remove->delete();

        return Redirect::to('/eventlist');
    }
}

