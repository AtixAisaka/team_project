<?php

namespace App\Http\Controllers;


use App\Events;
use App\Fakulty;
use App\Katedry;
use App\Tags;
use App\EventsHasTags;
use App\UsersGoingEvents;
use App\events_image;
use Auth;
use Calendar;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Session;
use GuzzleHttp\Client;
use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function index(){
        $events = Events::get();
        $fakulty = Fakulty::get();
        $katedry = Katedry::get();
        $tags = Tags::get();
        $event_list = [];

        Session::put('type', "");
        Session::put('pracovisko', "");
        Session::put('start_date', "");
        Session::put('end_date', "");
        Session::put('tag', "");
        Session::put('name', "");

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
            return view('events/events', compact('calendar_details',  "user", "fakulty", "katedry", "tags"));
        } else {
            return view('events/events', compact("calendar_details", "fakulty", "katedry", "tags"));
        }
    }

    public function showEventList(){
        $events = Events::all();

        $fakulty = Fakulty::get();
        $katedry = Katedry::get();
        $tags = Tags::get();

        Session::put('type', "");
        Session::put('type2', "");
        Session::put('pracovisko', "");
        Session::put('start_date', "");
        Session::put('end_date', "");
        Session::put('tag', "");
        Session::put('name', "");

        if (Auth::check())
        {
            $authuser = Auth::user();
            $helpertable = UsersGoingEvents::all();
            return view('events/eventlist', compact("events",
                "fakulty", "katedry", "tags", "authuser", "helpertable"));
        } else {
            return view('events/eventlist', compact("events",
                "fakulty", "katedry", "tags"));
        }
    }

    public function filterEventsCalendar(Request $request){
        $name = $request["name"];
        $type = $request["type"];
        $pracovisko = $request["pracovisko"];
        $start_date = $request["start_date"];
        $end_date = $request["end_date"];
        $tag = $request->get("tag");

        //query builder ty kokos
        $eventsquery = Events::query();

        if($name!=""){
            $eventsquery = $eventsquery->where("event_name", 'LIKE', '%'.$name.'%');
        }
        if($type!=""){
            $eventsquery = $eventsquery->where("type", "=", $type);
        }
        if($pracovisko!=""){
            if(substr($pracovisko, 0, 1) == ".") {
                $pracovisko = substr($pracovisko, 1);
                $eventsquery = $eventsquery->where("idkatedry", "=", $pracovisko);
            } else {
                $eventsquery = $eventsquery->where("idfakulty", "=", $pracovisko);
            }
        }
        if($start_date!=""){
            $eventsquery = $eventsquery->whereDate('start_date', '>=', $start_date);
        }
        if($end_date!=""){
            $eventsquery = $eventsquery->whereDate('end_date', '<=', $end_date);
        }
        if($tag!=""){
            $length = count($tag);
            $array = array();
            $first = $tag[0];

            $eventhastags = EventsHasTags::where('idtag', '=', $first)->select("idevent")->get();
            foreach ($eventhastags as $item) {
                if(!in_array($item->idevent, $array)) $array[] = $item->idevent;
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
                    $eventsquery = $eventsquery->where("id", "=", $row);
                    $found = true;
                    break;
                }
            }

            if(!$found) {
                $eventsquery = $eventsquery->where('id', '=', -1);;
            }
        }

        $events = $eventsquery->get();

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
                    'color' => '#74c377',
                    'url' => url("/showEventInfo/{$events->id}")."&-1&-1&-1",
                ]
            );
        }
        $calendar_details = Calendar::addEvents($event_list);

        $fakulty = Fakulty::get();
        $katedry = Katedry::get();
        $tags = Tags::get();

        Session::put('type', $request["type"]);
        Session::put('pracovisko', $request["pracovisko"]);
        Session::put('start_date', $request["start_date"]);
        Session::put('end_date', $request["end_date"]);
        Session::put('tag', $request["tag"]);
        Session::put('name', $request["name"]);

        if (Auth::check())
        {
            $user = Auth::user();
            return view('events/events', compact('calendar_details', "user", "fakulty", "katedry", "tags"));
        } else {
            return view('events/events', compact('calendar_details', "fakulty", "katedry", "tags"));
        }
    }

    public function getSessionData() {
        $type = Session::get('type');
        $type2 = Session::get('type2');
        $pracovisko = Session::get('pracovisko');
        $start_date = Session::get('start_date');
        $end_date = Session::get('end_date');
        $tag = Session::get('tag');
        $name = Session::get('name');
        return array("type" => $type, "type2" => $type2, "pracovisko" => $pracovisko, "start_date" => $start_date,
            "end_date" => $end_date, "tag" => $tag, "name" => $name);
    }

    public function doFilter($array) {
        $type = $array["type"];
        $pracovisko = $array["pracovisko"];
        $start_date = $array["start_date"];
        $end_date = $array["end_date"];
        $tag = $array["tag"];
        $name = $array["name"];
        $type2 = $array["type2"];

        //query builder ty kokos
        $eventsquery = Events::query();
        $today = Carbon::now();

        if($type2!="") {
            if($type2 == "0") {
                $eventsquery = $eventsquery->where('end_date', '<', $today->format('Y-m-d'));
            }
            else if($type2 == "1") {
                $eventsquery = $eventsquery->where('start_date', '<=', $today->format('Y-m-d'))
                    ->where('end_date', '>=', $today->format('Y-m-d'));
            }
            else if($type2 == "2") {
                $eventsquery = $eventsquery->where('start_date', '>', $today->format('Y-m-d'));
            }
        }
        if($name!=""){
            $eventsquery = $eventsquery->where("event_name", 'LIKE', '%'.$name.'%');
        }
        if($type!=""){
            $eventsquery = $eventsquery->where("type", "=", $type);
        }
        if($pracovisko!=""){
            if(substr($pracovisko, 0, 1) == ".") {
                $pracovisko = substr($pracovisko, 1);
                $eventsquery = $eventsquery->where("idkatedry", "=", $pracovisko);
            } else {
                $eventsquery = $eventsquery->where("idfakulty", "=", $pracovisko);
            }
        }
        if($start_date!=""){
            $eventsquery = $eventsquery->whereDate('start_date', '>=', $start_date);
        }
        if($end_date!=""){
            $eventsquery = $eventsquery->whereDate('end_date', '<=', $end_date);
        }
        if($tag!=""){
            $length = count($tag);
            $array = array();
            $first = $tag[0];

            $eventhastags = EventsHasTags::where('idtag', '=', $first)->select("idevent")->get();
            foreach ($eventhastags as $item) {
                if(!in_array($item->idevent, $array)) $array[] = $item->idevent;
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
                    $eventsquery = $eventsquery->where("id", "=", $row);
                    $found = true;
                    break;
                }
            }

            if(!$found) {
                $eventsquery = $eventsquery->where('id', '=', -1);;
            }
        }

        $events = $eventsquery->get();

        $fakulty = Fakulty::get();
        $katedry = Katedry::get();
        $tags = Tags::get();

        Session::put('type', $type);
        Session::put('type2', $type2);
        Session::put('pracovisko', $pracovisko);
        Session::put('start_date', $start_date);
        Session::put('end_date', $end_date);
        Session::put('tag', $tag);
        Session::put('name', $name);

        if (Auth::check())
        {
            $authuser = Auth::user();
            $helpertable = UsersGoingEvents::all();
            return view('events/eventlist', compact("events",
                "fakulty", "katedry", "tags", "authuser", "helpertable"));
        } else {
            return view('events/eventlist', compact("events",
                "fakulty", "katedry", "tags"));
        }
    }

    public function filterEvents(Request $request){
        $name = $request["name"];
        $type = $request["type"];
        $type2 = $request["type2"];
        $pracovisko = $request["pracovisko"];
        $start_date = $request["start_date"];
        $end_date = $request["end_date"];
        $tag = $request->get("tag");

        return $this->doFilter(array("type" => $type, "type2" => $type2, "pracovisko" => $pracovisko, "start_date" => $start_date, "end_date" => $end_date,
            "tag" => $tag, "name" => $name));
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

        if($request->has('tags0')){
            $find_event = Events::where('userid',$request['userid'])->orderBy('created_at', 'desc');
            $event_id = $find_event->first('id');
            $length = count($request["tags0"]);
            for($i=0; $i<$length; $i++) {
                $event_has_tags = new EventsHasTags;
                $event_has_tags->idtag = $request["tags0"][$i];
                $event_has_tags->idevent = $event_id->id;
                $event_has_tags->save();
            }
        }
        if($request["helper"] == 0) {
            \Session::flash('success', 'Event Pridaný');
            return Redirect::to('/events');
        } else return Redirect::to('/eventlist');
    }

    public function showEditEvent($id, $param, $userid, $admin) {
        $event = Events::find($id);
        $fakulty = Fakulty::get();
        $katedry = Katedry::get();
        return view("events/editevent", compact("event", "fakulty", "katedry", "param", "userid", "admin"));
    }

    public function showEventsHistory($value, $id, $admin) {
        $events = UsersGoingEvents::where("userid", "=", $id)->get();
        $allevents = null;
        $param = $value;

        if($value == 0) {
            $allevents = Events::where("userid", "=", $id)->get();
        } else if($value == 1) {
            if (count($events) != 0) {
                $alleventsq = Events::query();
                foreach ($events as $row) {
                    $alleventsq = $alleventsq->where("id", "=", $row->eventid);
                }
                $allevents = $alleventsq->get();
            } else $allevents = Events::where("id", "=", "-1");
        }

        return view("events/eventhistory", compact(  "allevents", "param", "id", "admin"));
    }

    public function showEventInfo($id, $param, $userid, $admin) {
        $event = Events::find($id);
        $usereventtable = UsersGoingEvents::where("eventid", "=", $id)->get();
        $usertagtable = EventsHasTags::where("idevent", "=", $id)->get();
        $count = UsersGoingEvents::where("eventid", "=", $id)->count();
        $usersgoing = "";
        $eventtags = "";
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

        foreach($usertagtable as $row) {
            if($usertagtable->last() == $row)
                $eventtags .= DB::table('tags')->where("id", "=", $row->idtag)->value("name").".";
            else
                $eventtags .= DB::table('tags')->where("id", "=", $row->idtag)->value("name").", ";
        }


        return view("events/showeventinfo", compact( "eventtags","usersgoing", "count", "eventowner",
            "event", "eventsImages", "value", "param", "admin", "userid", "eventabout"));
    }

    public function updateEventAction($id, Request $request) {
        $array = $this->getSessionData();

        $events = Events::find($id);
        $events->event_name = $request['event_name'];
        $events->event_place = $request['event_place'];
        if($events->type == 2) $events->idfakulty = $request['idfakulty'];
        else if($events->type == 1) $events->idkatedry = $request['idkatedry'];
        $events->start_date = $request['start_date'];
        $events->end_date = $request['end_date'];
        $events->save();

        $param = $request->param;

        if($param != -1) return Redirect::to('/eventhistory/'.$param."&".$request->userid."&".$request->admin);
        else return $this->doFilter($array);
    }

    public function hideEventAction($id, $value) {
        $array = $this->getSessionData();

        $events = Events::find($id);
        $boolean = null;
        if($value == 0) $boolean = false;
        else if($value == 1) $boolean = true;
        $events->ishidden = $boolean;
        $events->save();

        return $this->doFilter($array);
    }

    public function deleteEventAction($id) {
        $array = $this->getSessionData();
        $event = Events::find($id);
        $event->delete();
        $remove = UsersGoingEvents::where('eventid', '=', $id);
        $remove->delete();
        $remove = EventsHasTags::where('idevent', '=', $id);
        $remove->delete();
        $remove = events_image::where('event_id', '=', $id);
        $remove->delete();

        return $this->doFilter($array);
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
        $array = $this->getSessionData();

        $eventid = $id;
        $userid = Auth::id();

        $add = new UsersGoingEvents();
        $add->userid = $userid;
        $add->eventid = $eventid;
        $add->save();

        return $this->doFilter($array);
    }

    public function removeUserFromEvent($id) {
        $array = $this->getSessionData();

        $eventid = $id;
        $userid = Auth::id();

        $remove = UsersGoingEvents::where([
            ['userid', '=', $userid],
            ['eventid', '=', $eventid]
        ]);
        $remove->delete();

        return $this->doFilter($array);
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

    public function tagsView(){
        if (Auth::check()) {
            if(Auth::user()->role==4){
                $user_Id = Auth::id();
                $user_Tags = Tags::get();
            }else{
                $user_Id = Auth::id();
                $user_Tags = Tags::get()->where("user_id", '=', $user_Id);
            }
            return view('events/tag', compact("user_Id", "user_Tags"));
        } else {
            return redirect('/events');
        }

    }

    public function addtagsView(){
        if (Auth::check()) {
            return view('events/addtags');
        } else {
            return redirect('/events');
        }

    }

    public function addtag(Request $request){
        if (Auth::check()) {
            $tag_name = $request->tag_name;
            $tag = new Tags();
            $tag->name = $tag_name;
            $tag->user_id = Auth::id();
            $tag->save();
            return  view('events/addtags');
        } else {
            return redirect('/events');
        }

    }

    public function deletetag($id){
        if (Auth::check()) {
        $remove = Tags::where('id', '=', $id);
        $remove->delete();
        $remove = EventsHasTags::where('idtag', '=', $id);
        $remove->delete();

        return Redirect::to('/tags');
        }else {
            return redirect('/events');
        }
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

    public function eventTagInfoView($idevent) {
        if (Auth::check()) {
            $event_tags = EventsHasTags::all()->where('idevent','=', $idevent)->pluck('idtag');;
            $event = Events::find($idevent);
            $tags = Tags::find($event_tags);
            $alltags = Tags::all();

            return view("events/eventTagInfo", compact("tags", "event", "alltags"));
        }else {
            return redirect('/events');
        }
    }

    public function eventaddTagInfo(Request $request) {
        if (Auth::check()) {
            $array = array();
            $length = count($request->tag);
            $eventhastag = EventsHasTags::where("idevent", '=', $request->idevent)->select("idtag")->get();
            foreach ($eventhastag as $item) {
                if(!in_array($item->idtag, $array)) $array[] = $item->idtag;
            }
            for($i=0; $i<$length; $i++) {
                if(!in_array($request->tag[$i], $array)){
                $event_has_tags = new EventsHasTags;
                $event_has_tags->idtag = $request->tag[$i];
                $event_has_tags->idevent = $request->idevent;
                $event_has_tags->save();}
            }


            return Redirect::to("/eventtags/".$request->idevent);
        }else {
            return redirect('/events');
        }
    }

    public function deletetagInfo($id, $idevent){
        if (Auth::check()) {
            $remove = EventsHasTags::where('idtag', '=', $id)->where('idevent','=',$idevent);
            $remove->delete();

            return Redirect::to("/eventtags/".$idevent);
        }else {
            return redirect('/events');
        }
    }

}

