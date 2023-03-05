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
                <a href="{{route('addCompany')}}" class="btn btn-primary">Add Company</a>
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
                                <th scope="col">Company Email</th>
                                <th scope="col">Company Logo</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($companies)>0)
                        @foreach ($companies as $key => $company)
                            <tr>
                                <th scope="row">{{$key+ 1}}</th>
                                <td>{{$company->name}}</td>
                                <td>{{$company->email}}</td>
                                <td><img width="50px" src="{{asset('images/'.$company->company_logo)}}" /></td>
                                <td>
                                    <div>
                                        <span class="pe-1"><a href="/admin/updatecompany/{{$company->id}}">Edit</a></span>|
                                        <span class="ps-1"><a href="/admin/deletecompany/{{$company->id}}">Delete</a></span>
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
                    {!! $companies->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
