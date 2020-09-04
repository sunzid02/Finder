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

                    {{--                    loggedIn user Profile--}}
                    {{--                    <div class="row">--}}
                    {{--                        <div class="col-md-6">--}}
                    {{--                            <div class="card">--}}
                    {{--                                <img class="card-img-top" src="{{url('uploads/'.Auth::user()->profile_image )}}" alt="{{ Auth::user()->name }}"--}}
                    {{--                                    height="200"--}}
                    {{--                                     width="200"--}}
                    {{--                                >--}}
                    {{--                                <div class="card-body">--}}
                    {{--                                    <h4 class="card-title"> Name: {{ Auth::user()->name }}</h4>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}




                    {{-- other user list    --}}
                    <div class="row">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Picture</th>
                                <th>Distance </th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td> {{ $user->name }}</td>
                                            <td>
                                                <img class="card-img-top" src="{{url('uploads/'.$user->profile_image )}}" alt="{{ $user->name }}"
                                                     height="200"
                                                     width="200"
                                                >
                                            </td>
                                            <td> {{ $user->distance }} km </td>
                                            <td> Like me! </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <h4>No users available</h4>
                                    </tr>
                                    @endforelse
                            </tbody>
                        </table>
                    </div>


                </div>


            </div>
        </div>
    </div>
</div>
@endsection
