@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        Hello !!
                        <div class="col-md-6">
                            <div class="card">
                                <img class="card-img-top" src="{{url('uploads/'.Auth::user()->profile_image )}}" alt="{{ Auth::user()->name }}">
                                <div class="card-body">
                                    <h4 class="card-title"> Name: {{ Auth::user()->name }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    </div>
</div>
@endsection
