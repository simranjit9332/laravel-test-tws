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
                <div class="card-header">{{ __('Add Company') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ isset($company)?  route('editCompany') : route('saveCompany') }}"  enctype="multipart/form-data">  
                        @csrf
                        <div class="mb-3">
                            <label for="companyName" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="companyName"  name="companyName" value="{{isset($company)?$company['name']:''}}">
                        </div>
                        <div class="mb-3">
                            <label for="comoanyEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="companyEmail"  name="companyEmail" value="{{isset($company)?$company['email']:''}}">
                        </div>
                        <div class="mb-3">
                            <label for="comoanyEmail" class="form-label">Comppany Logo</label>
                            <input type="file" class="form-control" id="companyLogo"  name="companyLogo" value="{{isset($company)?$company['company_logo']:''}}">
                            @if(isset($company))
                             <img width="50px" class="pt-5" src="{{asset('images/'.$company['company_logo'])}}" />
                             <input type="hidden" name="companyUpdatedLogo" value="{{$company['company_logo']}}"/>
                             <input type="hidden" name="id" value="{{$company['id']}}"/>
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