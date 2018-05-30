<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\company;
use App\user;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'CheckRole'], ['except'=>['']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allCompanies = company::orderBy('created_at', 'desc')->paginate(10);
        return view('company.index')->with('companies', $allCompanies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
                                    'name'=>'required',
                                    'email'=>'email|nullable',
                                    'website'=>'url|nullable',
                                    'logo_path'=>'image|max:1999|dimensions:min_width=100,min_height=100'
                                    ]);
        $bool = company::where('email', $request->email)->first();
        if ($bool && $request->email != null)
            return redirect('/company/create')->with('error', 'Sorry , your Company EMAIL is allready exists :(');
        $fileToStore = 'storage/logos/noImage.jpg';
        $company = new company();
        if ($request->hasFile('logo_path')) {
            $path = $request->file('logo_path')->store('public/logos');
            $fileToStore = $this->getUrl($path);
        }
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo_path = $fileToStore;
        $company->website = $request->website;
        $company->save();
        return redirect('/company')->with('success', 'your Company has CREATED successfully :)');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = company::findOrFail($id);
        $users = $company->users()->paginate(10);
        return view('company.show')->with(['company'=> $company,  'users'=>$users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = company::findOrFail($id);
        return view('company.edit')->with(['company'=> $company]);
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
                                    'name' => 'required',
                                    'email' => 'email|nullable',
                                    'website' => 'url|nullable',
                                    'logo_path' => 'image|max:1999|dimensions:min_width=100,min_height=100'
                                    ]);
        $company = company::findOrFail($id);
        $bool = company::where('email', $request->email)->first();
        if ($bool && $request->email != null && $company->email !== $request->email)
            return redirect('/company/create')->with('error', 'Sorry , your Company EMAIL is allready exists :(');
        $fileToStore = $company->logo_path;
        if ($request->hasFile('logo_path')) {
            if ($company->logo_path !== 'storage/logos/noImage.jpg')
                storage::delete($this->geturl($company->logo_path));
            $path = $request->file('logo_path')->store('public/logos');
            $fileToStore = $this->getUrl($path);
        }
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo_path = $fileToStore;
        $company->website = $request->website;
        $company->save();
        return redirect('/company')->with('success', 'your Company has UPDATED successfully :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = company::find($id);
        $company->delete();
        if ($company->logo_path !== 'storage/logos/noImage.jpg')
            storage::delete($this->getUrl($company->logo_path));
        user::where('company_id', $company->id)->delete();
        return redirect('/company')->with('success', 'this company has DELETED successfully');
    }

    public function getUrl($path)
    {
        $arr_string = explode('/', $path);
        if ($arr_string[0] === 'public')
            $arr_string[0] = 'storage';
        elseif ($arr_string[0] === 'storage')
            $arr_string[0] = 'public';
        $path = join('/', $arr_string);
        return $path;
    }
}
