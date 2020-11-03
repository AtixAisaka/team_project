<?php

namespace App\Http\Controllers;


use App\Events;
use App\UsersGoingEvents;
use App\events_image;
use Auth;
use Calendar;
use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Carbon\Carbon;
use Route;

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
            return view('events/events', compact('calendar_details', "user"));
        } else {
            return view('events/events', compact('calendar_details'));
        }
    }

    public function showEventList(){
        $today = Carbon::now();
        $passedevents = Events::whereDate('end_date', '<', $today->format('Y-m-d'))->get();
        $futureevents = Events::whereDate('start_date', '>', $today->format('Y-m-d'))->get();
        $activeevents = Events::whereDate('start_date', '<', $today->format('Y-m-d'))
            ->whereDate('end_date', '>', $today->format('Y-m-d'))
            ->get();
        if (Auth::check())
        {
            $authuser = Auth::user();
            $helpertable = UsersGoingEvents::all();
            return view('events/eventlist', compact("passedevents", "futureevents", "activeevents", "authuser", "helpertable"));
        } else {
            return view('events/eventlist', compact("passedevents", "futureevents", "activeevents"));
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

    public function showEditEvent($id, $param, $userid, $admin) {
        $event = Events::find($id);
        return view("events/editevent", compact("event", "param", "userid", "admin"));
    }

    public function showEventsHistory($value, $id, $admin) {
        $events = null;
        $allevents = null;
        $today = Carbon::now();
        $param = $value;

        if($value == 0) {
            $events = UsersGoingEvents::where("userid", "=", $id)->get();
            $allevents = Events::whereDate('end_date', '<', $today->format('Y-m-d'))->get();
        }
        else if($value == 1) {
            $events = UsersGoingEvents::where("userid", "=", $id)->get();
            $allevents = Events::whereDate('start_date', '<', $today->format('Y-m-d'))
                ->whereDate('end_date', '>', $today->format('Y-m-d'))
                ->get();
        }
        else if($value == 2) {
            $events = UsersGoingEvents::where("userid", "=", $id)->get();
            $allevents = Events::whereDate('start_date', '>', $today->format('Y-m-d'))->get();
        }

        return view("events/eventhistory", compact( "events", "allevents", "param", "id", "admin"));
    }

    public function showEventInfo($id, $param, $userid, $admin) {
        $event = Events::find($id);
        $usereventtable = UsersGoingEvents::where("eventid", "=", $id)->get();
        $count = UsersGoingEvents::where("eventid", "=", $id)->count();
        $usersgoing = "";
        $eventowner = DB::table('users')->where("id", "=", $event->userid)->value("name");
        $eventsImages = events_image::where("event_id", "=", $id)->get();
        $today = Carbon::now();

        $value = 0;
        if(Events::whereDate('end_date', '<', $today->format('Y-m-d'))->
        where("id", "=", $id)->exists()) $value = 1;

        foreach($usereventtable as $row) {
            if($usereventtable->last() == $row)
                $usersgoing .= DB::table('users')->where("id", "=", $row->userid)->value("name").".";
            else
                $usersgoing .= DB::table('users')->where("id", "=", $row->userid)->value("name").", ";
        }

        return view("events/showeventinfo", compact( "usersgoing", "count", "eventowner",
            "event", "eventsImages", "value", "param", "admin", "userid"));
    }

    public function updateEventAction($id, Request $request) {
        $events = Events::find($id);
        $events->event_name = $request['event_name'];
        $events->start_date = $request['start_date'];
        $events->end_date = $request['end_date'];
        $events->save();
        $param = $request->param;

        if($param != -1) return Redirect::to('/eventhistory/'.$param."&".$request->userid."&".$request->admin);
        else return Redirect::to('/eventlist');
    }

    public function deleteEventAction($id) {
        $event = Events::find($id);
        $event->delete();

        return Redirect::to('/eventlist');
    }

    public function deleteUserGoingEvent(Request $request) {
        $eventid = $request["eventid"];
        $userid = $request["userid"];
        $admin = $request["admin"];
        $value = $request["value"];

        UsersGoingEvents::where("eventid", "=", $eventid)
            ->where("userid", "=", $userid)
            ->delete();

        return Redirect::to('/eventhistory/'.$value."&".$userid."&".$admin);
    }

    public function addUserToEvent($id) {
        $eventid = $id;
        $userid = Auth::id();

        $add = new UsersGoingEvents();
        $add->userid = $userid;
        $add->eventid = $eventid;
        $add->save();

        return Redirect::to('eventlist');
    }

    public function removeUserFromEvent($id) {
        $eventid = $id;
        $userid = Auth::id();

        $remove = UsersGoingEvents::where([
            ['userid', '=', $userid],
            ['eventid', '=', $eventid]
        ]);
        $remove->delete();

        return Redirect::to('eventlist');
    }

    public function openImageUpload($id){
        if (Auth::check()) {
            $event = Events::find($id);
            $userId = Auth::id();
            $eventName = Events::where("id", "=", $id)->value("event_name");
            return view('events/upload', compact("eventName", "userId", "event"));
        } else {
            return view('events/events');
        }

    }

    public function deleteImage($id, $eventid, $param, $userid, $admin) {
        $image = events_image::find($id);
        $image->delete();

        return Redirect::to('/showEventInfo/'.$eventid."&".$param."&".$userid."&".$admin);
    }

    public function uploadImage(Request $request){

        $validator = Validator::make($request->all(), [
            'event' => 'required',
            'userId' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            if($request["helper"] == 0) {
                \Session::flash('warnning', 'Chýbajuci obrázok');
                return Redirect::to('uploadImage/'.$request['event'])->withInput()->withErrors($validator);
            } else return Redirect::to('upload');
        }
        $image = $request->file('image');
        $destination_path = 'public/images/users';
        $image_name = $image->getClientOriginalName();
        $path = $request->file('image')->storeAs($destination_path,$image_name);
        $events_image = new events_image;
        $events_image->image = $image_name;
        $events_image->event_id = $request['event'];
        $events_image->user_id = $request['userId'];
        $events_image->save();

        if($request["helper"] == 0) {
            \Session::flash('success', 'Obrázok pridaný');
             return Redirect::to('/uploadImage/'.$request['event']);
        } else return Redirect::to('/eventlist');
    }

}

