<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ErrorHandleController;
use Illuminate\Support\Facades\Hash;


class MemberController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get member data from session
        $session_data = session()->get('member_login');
        $member = DB::table('members')
                    ->where('id', '=', $session_data['member_id'])
                    ->get();

        return view('members.index',compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $handle = new ErrorHandleController();

        $validated = $request->validate([
            'txt_firstname' => 'required|max:100',
            'txt_lastname' => 'required|max:100',
            'txt_dob' => 'required',
            'txt_username' => 'required|max:20',
            'txt_password' => 'required'
        ]);

        if($validated){
            //strtotime convert
            $dob = strtotime($request->txt_dob);
            $dob = date("Y-m-d", $dob);

            $members = DB::table('members')->insert([
                'firstname' => $request->txt_firstname,
                'lastname' => $request->txt_lastname,
                'dob' => $dob,
                'username' => $request->txt_username,
                'password' => Hash::make($request->txt_password),
                'member_type' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            if($members){
                $result = $handle->ShowSuccessMsg("Success!", "Register Conpleted.");
                return redirect()->route('index')->with('result', $result);
            }else{
                $result = $handle->ShowErrorMsg("Error!", "Register Error, Please try again.");
                return redirect()->route('index')->with('result', $result);
            }
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function member_login(Request $request){

        $handle = new ErrorHandleController();

        $request->validate([
            'txt_username' => 'required',
            'txt_password' => 'required'
        ]);

        $member = DB::table('members')
                ->select(
                    'members.id as member_id', 'members.firstname', 'members.lastname', 'members.username',
                    'members.password'
                )    
                ->where('username', '=', $request->txt_username)
                ->first();

        if($member && Hash::check($request->txt_password, $member->password)){
            //create session user_login
            $member_login = session()->get('member_login');
            $member_login = [
                'username' => $member->username,
                'firstname' => $member->firstname,
                'lastname' => $member->lastname,
                'member_id' => $member->member_id
            ];

            session()->put('member_login', $member_login);

            $result = $handle->ShowSuccessMsg("Success!", "You are loged in.");
            
            return redirect()->route('index')->with('login_result', $result);
        }else{
            $result = $handle->ShowErrorMsg("Error!", "Username or Password is not correct.");

            return redirect()->route('index')->with('login_result', $result);
        }
    }

    public function member_logout(){
        session()->forget('member_login');

        return redirect()->route('index');
    }
}
