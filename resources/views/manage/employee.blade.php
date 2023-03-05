@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row ">
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-10">
            @if(session()->has('success'))
                <div class="alert alert-success" role="alert"> 
                        {{ session()->get('success') }}
                </div>
            @endif
            <div class="col-sm-12 text-end py-3 pe-2">
                <a href="{{route('addEmployee')}}" class="btn btn-primary">Add Employee</a>
            </div>
            <div class="card">
                <div class="card-header">{{ __('View Companies') }}</div>
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                       <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($employees)>0)
                        @foreach ($employees as $key => $employee)
                            <tr>
                                <th scope="row">{{$key+ 1}}</th>
                                <th>{{App\Http\Controllers\ManageEmployee::getCompanyById($employee->company_id)}}</th>
                                <td>{{$employee->first_name}}{{isset($employee->last_name)??$employee->last_name}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->phone}}</td>
                                <td>
                                    <div>
                                        <span class="pe-1"><a href="/admin/updateemployee/{{$employee->id}}">Edit</a></span>|
                                        <span class="ps-1"><a href="/admin/deleteemployee/{{$employee->id}}">Delete</a></span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @else
                          <th colspan="5" class="text-center">No data found</th>
                        @endif
                        </tbody>
                    </table>
                    <div class="col-sm-12 text-center py-3">
                    {!! $employees->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
