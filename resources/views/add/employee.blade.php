@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-10">
            @if (count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->has('success'))
            <div class="alert alert-success" role="alert"> 
                    {{ session()->get('success') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Add Employee') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ isset($employee)?  route('editEmployee') : route('saveEmployee') }}"  enctype="multipart/form-data">  
                        @csrf
                        <div  class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="firstName" class="form-label">Employee First Name</label>
                            <input type="text" class="form-control" id="firstName"  name="firstName" value="{{isset($employee)?$employee['first_name']:''}}">
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="LastName" class="form-label">Employee Last Name</label>
                            <input type="text" class="form-control" id="LastName"  name="LastName" value="{{isset($employee)?$employee['last_name']:''}}">
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="company" class="form-label">Company</label>
                            <Select class="form-control" id="company"  name="company" >
                                <option value=""> Select Company</option>
                                @foreach (App\Http\Controllers\ManageEmployee::getCompanies() as $key => $company)
                                 <option value="{{$company->id}}" {{ (isset($employee)&& $employee['company_id'] == $company->id)?'selected':''}} > {{$company->name}}</option>
                                @endforeach
                            </Select>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email"  name="email" value="{{isset($employee)?$employee['email']:''}}">
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="phone" class="form-label">Employee Phone</label>
                            <input type="text" class="form-control" id="phone"  name="phone" value="{{isset($employee)?$employee['phone']:''}}">
                        </div>
                           @if(isset($employee))
                             <input type="hidden" name="id" value="{{$employee['id']}}"/>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection