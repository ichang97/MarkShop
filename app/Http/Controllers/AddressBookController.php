<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ErrorHandleController;

class AddressBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get member
        $member = session()->get('member_login');

        $address = DB::table('address_books')->where('member_id', '=', $member['member_id'])->get();

        return view('address_book.index', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            //get session member data
            $member = session()->get('member_login');

            //get default value
            //if you're never store address book. after add that, the default is true.
            //but if you're ever store address  book. after add that, the default is false

            $find_address = DB::table('address_books')->where('member_id', '=', $member['member_id'])->get();
            if(count($find_address) != 0){ $default = 0; }else{ $default = 1; }

            $address_book = DB::table('address_books')->insert([
                'address_name' => $request->txt_addressname,
                'receiver_name' => $request->txt_receiver_name,
                'home_number' => $request->txt_hourseno,
                'building_name' => $request->txt_buildingname,
                'floor_no' => $request->txt_floorno,
                'street' => $request->txt_street,
                'sub_district' => $request->txt_sub_district,
                'district' => $request->txt_district,
                'province' => $request->txt_province,
                'postal_code' => $request->txt_postal_code,
                'member_id' => $member['member_id'],
                'default' => $default,
                'created_at' => now(),
                'updated_at' => now()

            ]);

            if($address_book){
                $result = $handle->ShowSuccessMsg("Success!", "Add address completed.");
                return redirect()->route('address_book.index')->with('result', $result);
            }else{
                $result = $handle->ShowErrorMsg("Error!", "Add address error, Please try again.");
                return redirect()->route('address_book.index')->with('result', $result);
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
}
