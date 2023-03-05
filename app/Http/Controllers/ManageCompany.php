<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\ManageCompanies;
use Illuminate\Http\Request;

class ManageCompany extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the Manage Company Page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $manageCompanies = new ManageCompanies();
        $companyList = $manageCompanies::simplePaginate(10);
        return view('manage.company',['companies'=>$companyList]);
    }
    /**
     * Show the add Company Form.
     */
    public function addCompany()
    {
        return view('add.company');
    }
    /**
     * Save the Company Details
     */
    public function saveCompany(Request $request)
    {
        $request->validate([
            'companyName' => 'required|max:255',
            'companyEmail' => 'required|email|max:255',
            'companyLogo' => 'required|min:6|max:255|dimensions:min_width=100,min_height=100,',
        ]);
        $originalImage = $request->file('companyLogo');
        $originalImage->move(public_path().'/images/', $img = 'img_'.Str::random(15).'.jpg');
        $manageCompanies = new ManageCompanies();
        $manageCompanies->name = $request->companyName;
        $manageCompanies->email = $request->companyEmail;
        $manageCompanies->company_logo = $img;
        $manageCompanies->save();
 
        return redirect()->back()->with('success', 'Company Successfully Saved!!');



    }
    public function updateCompany($id){
        $manageCompanies = new ManageCompanies();
        $company = $manageCompanies::Select("*")->where('id',$id)->first();
        return view('add.company',['company'=>$company]);
    }

    public function editCompany(Request $request){
        $manageCompanies = new ManageCompanies();
        if($request->companyLogo != null){
            $originalImage = $request->file('companyLogo');
            $originalImage->move(public_path().'/images/', $img = 'img_'.Str::random(15).'.jpg');
            $request->companyLogo = $img;
        }else{
            $request->companyLogo = $request->companyUpdatedLogo;
        }
        $updateCompany = manageCompanies::find($request->id);
        $inputs = ['name' => $request->companyName,'email' => $request->companyEmail,'company_logo' => $request->companyLogo];
        $updateCompany->update($inputs);         
        return redirect()->back()->with('success', 'Company Successfully Update!!');

    }

    public function deleteCompany($id){
        $manageCompanies = new ManageCompanies();
        $deleteCompany = $manageCompanies::find($id);
        if($deleteCompany->delete()){
            return redirect()->back()->with('success', 'Company Deleted Successfully!!');
        }
    }
    
    
}
