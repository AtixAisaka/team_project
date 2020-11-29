<?php

namespace App\Http\Controllers;


use App\Events;
use App\UsersGoingEvents;
use App\events_image;
use Auth;
use Session;
use App\Tags;
use Calendar;
use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Carbon\Carbon;
use Route;

class UsersController extends Controller
{

    public function getSessionData() {
        $name = Session::get('username');
        $role = Session::get('userrole');
        return array("name" => $name, "role" => $role);
    }

    public function doFilter($array) {
        $name = $array["name"];
        $role = $array["role"];

        //query builder ty kokos
        $usersquery = DB::table('users');

        if($name!=""){
            $usersquery = $usersquery->where("name", 'LIKE', '%'.$name.'%');
        }
        if($role!=""){
            $usersquery = $usersquery->where("role", "=", $role);
        }

        $users = $usersquery->get();

        Session::put('username', $name);
        Session::put('userrole', $role);

        return view('users/userlist', compact("users"));
    }

    public function filterUsers(Request $request){
        $name = $request["name"];
        $role = $request["role"];
        return $this->doFilter(array("name" => $name, "role" => $role));
    }

    public function showUserList(){
        $users = DB::table('users')->get();
        return view('users/userlist', compact("users"));
    }

    public function showEditUser($id) {
        $user = DB::table('users')->where("id", "=", $id)->first();
        return view("users/edituser", compact("user"));
    }

    public function showUserInfo(Request $request) {
        $id = $request["id"];
        $helper = $request["helper"];
        $param = $request["param"];

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

        return view("showeventinfo", compact( "usersgoing", "count", "eventowner",
            "event", "eventsImages", "value", "helper", "param"));
    }

    public function updateUserAction(Request $request) {
        DB::table('users')->where("id", "=", $request["id"])->update(array(
            'name'=>$request['name'],
            'email'=>$request['email'],
            'role'=>$request['role'],
        ));

        return $this->showFilters();
    }

    public function deleteUserAction($id) {
        DB::table('users')->where("id", "=", $id)->delete();
        UsersGoingEvents::where("userid", "=", $id)->delete();
        events_image::where("user_id", "=", $id)->delete();
        Tags::where("userid", "=", $id)->delete();
        $events = Events::where("userid", "=", $id)->get();
        foreach($events as $row) {
            UsersGoingEvents::where("eventid", "=", $row->id)->delete();
            events_image::where("event_id", "=", $row->id)->delete();
        }
        Events::where("userid", "=", $id)->delete();

        return $this->showFilters();
    }

    public function showFilters() {
        $array = $this->getSessionData();
        return $this->doFilter($array);
    }
}

