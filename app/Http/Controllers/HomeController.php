<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Register;

class HomeController extends Controller
{
    public function index()
    {
        $data['show'] = "Home Page";
        $data['datetime'] = now()->format('d/m/Y h:i a');
        return view("admin.home", $data);
    }

    public function about()
    {
        $data['show'] = "About Page";
        $data['datetime'] = now()->format('d/m/Y h:i a');
        return view("admin.about", $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['show'] = "Post Page";
        $data['datetime'] = now()->format('d/m/Y h:i a');
        $data['depts'] = Department::get();
        return view("admin.post", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'mobile' => 'required|numeric|digits:11|regex:/(01)[0-9]{9}/',
            'email' => 'required|email|max:50',
            'dept_id' => 'required',
            'uname' => 'required|max:50',
            'pass' => 'required|max:100',
        ]);
        if($validate->fails()){ 
            return back()->withErrors($validate)->withInput();
        }

        $insert = new Register();
        $insert->name = $request->name;
        $insert->mobile = $request->mobile;
        $insert->email = $request->email;
        $insert->department_id = $request->dept_id;
        $insert->username = $request->uname;
        $insert->password = Hash::make($request->pass);
        $insert->save();
        return back()->with('success', 'Post submitted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data['lists'] = Register::with('dept')->select('id','name','department_id','mobile','email','created_at')->paginate(1);
        return view('admin.datalist', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['edit'] = Register::where('id', $id)->first();
        return view('admin.dataedit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'mobile' => 'required|numeric|digits:11|regex:/(01)[0-9]{9}/',
            'email' => 'required|email|max:50',
        ]);
        if($validate->fails()){ 
            return back()->withErrors($validate)->withInput();
        }

        $update = Register::find($request->id);
        $update->name = $request->name;
        $update->mobile = $request->mobile;
        $update->email = $request->email;
        $update->save();
        return redirect('/data')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Register::find($id)->delete();
        return back()->with('success', 'Data deleted successfully!');
    }
}
