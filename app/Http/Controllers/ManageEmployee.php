<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\ManageEmployees;
use App\Models\ManageCompanies;
use Illuminate\Http\Request;

class ManageEmployee extends Controller
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
        $manageEmployee = new ManageEmployees();
        $employeeList = $manageEmployee::simplePaginate(10);
        return view('manage.employee',['employees'=>$employeeList]);
    }
    /**
     * Show the add Company Form.
     */
    public function addEmployee()
    {
        return view('add.employee');
    }
    /**
     * Save the Company Details
     */
    public function saveEmployee(Request $request)
    {
        $request->validate([
            'firstName' => 'required|max:255',
            'LastName' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|min:11|numeric',
        ]);
        $manageEmployee = new ManageEmployees();
        $manageEmployee->first_name = $request->firstName;
        $manageEmployee->last_name = $request->LastName;
        $manageEmployee->company_id = $request->company;
        $manageEmployee->email = $request->email;
        $manageEmployee->phone = $request->phone;
        $manageEmployee->save();
 
        return redirect()->back()->with('success', 'Employee Successfully Saved!!');
    }
    public function updateEmployee($id){
        $manageEmployee = new ManageEmployees();
        $manageCompanies = new ManageCompanies();
        $companyList = $manageCompanies::select("id","name")->get();
        $employee = $manageEmployee::Select("*")->where('id',$id)->first();
        return view('add.employee',['employee'=>$employee,'companyList'=>$companyList]);
    }

    public function editEmployee(Request $request){
        $manageEmployee = new ManageEmployees();
        $updateEmployee = $manageEmployee::find($request->id);
        $inputs = ["first_name"=> $request->firstName,'last_name'=>$request->LastName,
        'company_id'=>$request->company,'email'=>$request->email,'phone'=>$request->phone];
        $updateEmployee->update( $inputs);         
        return redirect()->back()->with('success', 'Employee Successfully Update!!');

    }

    public function deleteemployee($id){
        $manageEmployee = new ManageEmployees();
        $deleteemployee = $manageEmployee::find($id);
        if($deleteemployee->delete()){
            return redirect()->back()->with('success', 'Employee Delete Successfully!!');
        }
    }

    public function getCompanyById($id){
        $manageCompanies = new ManageCompanies();
        $companyList = $manageCompanies::select("name")->where('id',$id)->first();

        return $companyList['name'];
    }

    public function getCompanies(){
        $manageCompanies = new ManageCompanies();
        $companyList = $manageCompanies::select("id","name")->get();

        return $companyList;
    }
    
    
}
