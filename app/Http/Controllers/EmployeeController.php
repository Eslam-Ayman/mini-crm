<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\company;
use Gate;
use App\Notifications\RegisterEmployee;
use Notification;

class EmployeeController extends Controller
{
    public function __construct()
    {
        // you must know that the next statement in the comment mean that this middleware will be applied on nothing because you say only nothing 
        // so you must remove the seconde argument
        // and by the way i you say except nothing it will not ignore any action because
        // you didn't mention anyone and in this case the middleware will be applied on the all action in this controller

        // $this->middleware('auth', ['only'=>['']]);
        $this->middleware('auth');
        $this->middleware('CheckRole', ['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // auth()->user()->can('show-employee', var is here);
        // auth()->user()->cannot('adminRole');
        // $request->user()->can('show-employee', auth()->user()); // auth()->user() >>> return model
        // $request->user()->cannot('show-employee', auth()->user());
        // $this->authorize('show-employee', auth()->user());
        // Gate::allows('show-employee', auth()->user());
        // Gate::denies('adminRole');
        if(Gate::denies('adminRole')){
            $allEmployees = user::where('company_id', auth()->user()->company_id)
                        ->orderBy('created_at', 'desc')->paginate(10);
            return view('employee.index')->with('employees', $allEmployees);
        }
        $allEmployees = user::orderBy('created_at', 'desc')->paginate(10);
        return view('employee.index')->with('employees', $allEmployees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = company::orderBy('created_at', 'desc')->get();
        foreach ($companies as $company)
            $company_arr[$company->id] = $company->name;
        return view('employee.create')->with('company_arr', $company_arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                                    'f_name'=>'required',
                                    'l_name'=>'required',
                                    'email'=>'email|nullable',
                                    'phone'=>'nullable',
                                    'company_id'=>'required',
                                    'password'=>'required',
                                    ]);
        $bool = user::where('email', $request->email)->first();
        if ($bool && $request->email != null)
            return redirect('/employee/create')->with('error', 'Sorry , your Employee EMAIL is allready exists :(');
        $employee = new user();
        $employee->f_name = $request->f_name;
        $employee->l_name = $request->l_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->role = $request->role;
        $employee->company_id = $request->company_id;
        $employee->password = bcrypt($request->password);
        $employee->save();
        // you can use any of this two next methods but to use any of them must use trait called "Notifiable" use it at user moel
        // $employee->notify(new RegisterEmployee($request));
        // notification::send($employee, new RegisterEmployee($request));
        return redirect('/employee')->with('success', 'your Employee has CREATED successfully :)');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // the difference between both of two next lines that the first one will proceed into if clause
        // but the seconde one will will throw exception

        // if (! $this->authorize('show-employee', user::findOrFail($id))) 
        if (Gate::denies('show-employee', user::findOrFail($id)) && Gate::denies('adminRole'))
            return redirect('/employee')->with('error', 'you unauthorized to show this profile');

        $employee = user::findOrFail($id);
        return view('employee.show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = user::findOrFail($id);
        $companies = company::orderBy('created_at', 'desc')->get();
        foreach ($companies as $company)
            $company_arr[$company->id] = $company->name;
        return view('employee.edit')->with(['employee'=> $employee, 'company_arr'=>$company_arr]);
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
        $this->validate($request, [
                                    'f_name'=>'required',
                                    'l_name'=>'required',
                                    'email'=>'email|nullable',
                                    'phone'=>'nullable',
                                    ]);
        $employee = user::findOrFail($id);
        $bool = user::where('email', $request->email)->first();
        if ($bool && $request->email != null && $request->email !== $employee->email)
            return redirect('/employee/create')->with('error', 'Sorry , your Employee EMAIL is allready exists :(');
        $employee->f_name = $request->f_name;
        $employee->l_name = $request->l_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->password = $request->password === null ? $employee->password : $request->password;
        $employee->role = $request->role;
        $employee->company_id = $request->company_id;
        $employee->save();
        return redirect('/employee')->with('success', 'your Employee has UPDATED successfully :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = user::find($id);
        $employee->delete();
        return redirect('/employee')->with('success', 'this Employee has DELETED successfully');
    }
}
