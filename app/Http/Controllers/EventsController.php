<?php

namespace App\Http\Controllers;


use App\Events;
use App\Fakulty;
use App\Katedry;
use App\Tags;
use App\Tag;
use App\EventsHasTags;
use App\UsersGoingEvents;
use App\events_image;
use Auth;
use Calendar;
use phpDocumentor\Reflection\DocBlock\Description;
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
        $fakulty = Fakulty::get();
        $katedry = Katedry::get();
        $tags = Tag::get();
        $event_list = [];
        foreach ($events as $key => $events) {
            $event_list[] = Calendar::event(
                $events->event_name,
                true,
                new \DateTime($events->start_date),
                new \DateTime($events->end_date.' +1 day'),
                null,
                // Add color and link on event
                [
                    'color' => '#32CD32',
                    'url' => url("/showEventInfo/{$events->id}")."&-1&-1&-1",
                ]
            );
        }
        $calendar_details = Calendar::addEvents($event_list);

        if (Auth::check()) {
            $user = Auth::user();
            return view('events/events', compact('calendar_details', "user", "fakulty", "katedry", "tags"));
        } else {
            return view('events/events', compact("calendar_details", "fakulty", "katedry", "tags"));
        }
    }

    public function showEventList(){
        $today = Carbon::now();
        $passedevents = Events::whereDate('end_date', '<', $today->format('Y-m-d'))->get();
        $futureevents = Events::whereDate('start_date', '>', $today->format('Y-m-d'))->get();
        $activeevents = Events::whereDate('start_date', '<=', $today->format('Y-m-d'))
            ->whereDate('end_date', '>=', $today->format('Y-m-d'))
            ->get();

        $fakulty = Fakulty::get();
        $katedry = Katedry::get();
        $tags = Tags::get();
        $selected_tag = "";

        if (Auth::check())
        {
            $authuser = Auth::user();
            $helpertable = UsersGoingEvents::all();
            return view('events/eventlist', compact("passedevents", "futureevents", "activeevents",
                "fakulty", "katedry", "tags", "authuser", "helpertable", "selected_tag"));
        } else {
            return view('events/eventlist', compact("passedevents", "futureevents", "activeevents",
                "fakulty", "katedry", "tags", "selected_tag"));
        }
    }

    public function filterEvents(Request $request){
        $today = Carbon::now();
        $type = $request["type"];
        $pracovisko = $request["pracovisko"];
        $start_date = $request["start_date"];
        $end_date = $request["end_date"];
        $tag = $request->get("tag");

        //query builder ty kokos
        $querypassedevents = Events::query();
        $queryfutureevents = Events::query();
        $queryactiveevents = Events::query();
        $querypassedevents= $querypassedevents->whereDate('end_date', '<', $today->format('Y-m-d'));
        $queryfutureevents= $queryfutureevents->whereDate('start_date', '>', $today->format('Y-m-d'));
        $queryactiveevents= $queryactiveevents->whereDate('start_date', '<=', $today->format('Y-m-d'))
            ->whereDate('end_date', '>=', $today->format('Y-m-d'));

        if($type!=""){
            $querypassedevents = $querypassedevents->where("type", "=", $type);
            $queryfutureevents = $queryfutureevents->where("type", "=", $type);
            $queryactiveevents = $queryactiveevents->where("type", "=", $type);
        }
        if($pracovisko!=""){
            if(substr($pracovisko, 0, 1) == ".") {
                $pracovisko = substr($pracovisko, 1);
                $querypassedevents = $querypassedevents->where("idkatedry", "=", $pracovisko);
                $queryfutureevents = $queryfutureevents->where("idkatedry", "=", $pracovisko);
                $queryactiveevents = $queryactiveevents->where("idkatedry", "=", $pracovisko);
            } else {
                $querypassedevents = $querypassedevents->where("idfakulty", "=", $pracovisko);
                $queryfutureevents = $queryfutureevents->where("idfakulty", "=", $pracovisko);
                $queryactiveevents = $queryactiveevents->where("idfakulty", "=", $pracovisko);
            }
        }
        if($start_date!=""){
            $querypassedevents = $querypassedevents->whereDate('start_date', '>=', $start_date);
            $queryfutureevents = $queryfutureevents->whereDate('start_date', '>=', $start_date);
            $queryactiveevents = $queryactiveevents->whereDate('start_date', '>=', $start_date);
        }
        if($end_date!=""){
            $querypassedevents = $querypassedevents->whereDate('end_date', '<=', $end_date);
            $queryfutureevents = $queryfutureevents->whereDate('end_date', '<=', $end_date);
            $queryactiveevents = $queryactiveevents->whereDate('end_date', '<=', $end_date);
        }
        if($tag!=""){
            $length = count($tag);
            $array = array();
            foreach($tag as $row){
                $eventhastags = EventsHasTags::where('idtag', '=', $row)->select("idevent")->get();
                foreach ($eventhastags as $item) {
                    if(!in_array($item->idevent, $array)) $array[] = $item->idevent;
                }
            }

            $found = false;
            foreach($array as $row) {
                $pom = 0;
                $eventhastag = EventsHasTags::where("idevent", '=', $row)->select("idtag")->get();
                foreach ($eventhastag as $item) {
                    if(in_array($item->idtag, $tag)) $pom++;
                    else break;
                }
                if ($pom == $length) {
                    $querypassedevents = $querypassedevents->where("id", "=", $row);
                    $queryfutureevents = $queryfutureevents->where("id", "=", $row);
                    $queryactiveevents = $queryactiveevents->where("id", "=", $row);
                    $found = true;
                    break;
                }
            }

            if(!$found) {
                $querypassedevents = $querypassedevents->where('id', '=', 999999);
                $queryfutureevents = $queryfutureevents->where('id', '=', 999999);
                $queryactiveevents = $queryactiveevents->where('id', '=', 999999);
            }
        }


        $passedevents = $querypassedevents->get();
        $futureevents = $queryfutureevents->get();
        $activeevents = $queryactiveevents->get();

        $fakulty = Fakulty::get();
        $katedry = Katedry::get();
        $tags = Tags::get();

        if (Auth::check())
        {
            $authuser = Auth::user();
            $helpertable = UsersGoingEvents::all();
            return view('events/eventlist', compact("passedevents", "futureevents", "activeevents",
                "fakulty", "katedry", "tags", "authuser", "helpertable"));
        } else {
            return view('events/eventlist', compact("passedevents", "futureevents", "activeevents",
                "fakulty", "katedry", "tags"));
        }
    }

    public function addEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'userid' => 'required',
            'helper' => 'required',
            'type' => 'required',
            'event_place' => 'required',
            'idfakulty' => 'required',
            'idkatedry' => 'required',
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
        $events->type = $request['type'];
        $events->event_place = $request['event_place'];
        $events->idfakulty = $request['idfakulty'];
        $events->idkatedry = $request['idkatedry'];
        $events->ishidden = false;
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

        $eventabout = null; //katedra/fakulta

        if($event->type == 3) $eventabout = "Event Univerzity Konštantína Filozofa";
        else if($event->type == 2) $eventabout = Fakulty::where("id", "=", $event->idfakulty)->value("name");
        else if($event->type == 1) $eventabout = Katedry::where("id", "=", $event->idkatedry)->value("name");
        else $eventabout = "Študentský event";

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
            "event", "eventsImages", "value", "param", "admin", "userid", "eventabout"));
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

    public function hideEventAction($id, $value) {
        $events = Events::find($id);
        $boolean = null;
        if($value == 0) $boolean = false;
        else if($value == 1) $boolean = true;
        $events->ishidden = $boolean;
        $events->save();

        return Redirect::to('/eventlist');
    }

    public function deleteEventAction($id) {
        $event = Events::find($id);
        $event->delete();
        $remove = UsersGoingEvents::where('eventid', '=', $id);
        $remove->delete();
        $remove = EventsHasTags::where('idevent', '=', $id);
        $remove->delete();
        $remove = events_image::where('event_id', '=', $id);
        $remove->delete();

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

    public function test_tags(){
        $event = Events::find(1);
        $tag = Tag::Where('id', 1)->Where('id',2)->get();
        $tag = Tag::find(2);
        // $event->tags this finds tags that event has
        // $tag->Events this finds Events that given tag has
        return $tag->Events;
    }

    public function tag_filter(Request $request){
        if($request->tags != "") {
            $today = Carbon::now();
            $selected_tag = $request->tags;
            // this finds tag
            $tag = Tag::find($request->tags);
            // this finds where tags meet with events based on date
            $passedevents = $tag->Events->where('end_date', '<', $today->format('Y-m-d'));
            $futureevents = $tag->Events->where('start_date', '>', $today->format('Y-m-d'));
            $activeevents = $tag->Events->where('start_date', '<=', $today->format('Y-m-d'))->where('end_date', '>=', $today->format('Y-m-d'));
            $fakulty = Fakulty::get();
            $katedry = Katedry::get();
            $tags = Tag::get();

            if (Auth::check()) {
                $authuser = Auth::user();
                $helpertable = UsersGoingEvents::all();
                return view('events/eventlist', compact("passedevents", "futureevents", "activeevents",
                    "fakulty", "katedry", "tags", "authuser", "helpertable", "selected_tag"));
            } else {
                return view('events/eventlist', compact("passedevents", "futureevents", "activeevents",
                    "fakulty", "katedry", "tags", "selected_tag"));
            }
        }else{
            return redirect()->action('EventsController@showEventList');
        }

    }

    public function tagsView(){
        if (Auth::check()) {
            if(Auth::user()->role==4){
                $user_Id = Auth::id();
                $user_Tags = Tag::get();
            }else{
            $user_Id = Auth::id();
            $user_Tags = Tag::get()->where("user_id", '=', $user_Id);
            }
            return  view('events/tag', compact("user_Id", "user_Tags"));
        } else {
            return redirect('/events');
        }

    }
    public function addtagsView(){
        if (Auth::check()) {
            return  view('events/addtags');
        } else {
            return redirect('/events');
        }

    }

    public function addtag(Request $request){
        if (Auth::check()) {
            $user_Id = Auth::id();
            $tag_name = $request->tag_name;
            $tag = new Tags();
            $tag->name = $tag_name;
            $tag->user_id = $user_Id;
            $tag->save();
            return  view('events/addtags');
        } else {
            return redirect('/events');
        }

    }

    public function deletetag($id){
        $remove = Tags::where('id', '=', $id);
        $remove->delete();
        $remove = EventsHasTags::where('idtag', '=', $id);
        $remove->delete();


        return Redirect::to('/tags');
    }
    public function editTagView($id) {
        if (Auth::check()) {
            $tag = Tags::find($id);
            $tag_name = $tag->name;
            return view("events/edittag", compact("id", "tag_name"));
        }else {
            return redirect('/events');
        }
    }

    public function edittagAction(Request $request) {
        if (Auth::check()) {
        $tag = Tags::find($request->id);
        $tag->name = $request['tag_name'];
        $tag->save();


        return Redirect::to('/tags');}
        else return Redirect::to('/events');
    }

}

