@extends('layouts.app')

@section('custom_css')

    <style>


        #imgtd
        {
            border:1px solid pink;
            width: 120px;
            float: left;
            margin: 3px;
            padding: 3px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">User List</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif






                        {{-- other user list    --}}
                        <div class="row">




                            {{--                    jquery fetch data starts--}}

                            {{-- other user list    --}}
                            <div id="usersDiv">
                                <table class="table" id="usersTable">
                                    <thead>
                                    <tr id="tabHeader">
                                        <th>Sl.</th>
                                        <th>Name</th>
                                        <th>Picture</th>
                                        <th>Distance </th>
                                        <th>Gender </th>
                                        <th>Age </th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="usersTableBody">

                                    </tbody>
                                </table>

                            </div>

                            {{--                    jquery fetch data ends--}}

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>

        $(function(){
            ////get users
            $.ajax({
                url: '{{'home-users'}}',
                type: 'GET',
                success: function (res) {

                    const response = JSON.parse(res);
                    const userListSize = response.user_list_size;
                    const users = response.data;

                    var userRow = '';

                    if (userListSize > 0 )
                    {
                        $.each(users, function (index, user) {
                            userRow += '<tr>';

                            //serial
                            userRow += '<td>' + '#' +
                                ++index + '</td>';

                            //username
                            userRow += '<td>' +
                                user.name + '</td>';

                            // profile picture
                            userRow += '<td>' +
                                     '<img class="card-img-top" src="' + user.profile_image_path + '"    alt="' + user.profile_image + '"  width="150px" height="150px" />'
                            + '</td>';

                            // distance
                            userRow += '<td>' +
                                user.distance + ' km'+ '</td>';
                            '</td>';

                            // gender
                            userRow += '<td>' +
                                user.gender + '</td>';

                            // age
                            userRow += '<td>' +
                                user.age + '</td>';

                            // action
                            if (user.activity_name == 'None')
                            {
                                userRow += '<td>' +
                                    '<button class="btn btn-primary"     id="' +"likeBtn"+ user.id + '"    onclick="like('+ user.id+ ')" >' +
                                    '' +
                                    'Like ' +
                                    '</button>'+' ' +

                                    '<button class="btn btn-danger"     id="' +"dislikeBtn"+ user.id + '"    onclick="dislike('+ user.id+ ')" >' +
                                    '' +
                                    'Dislike ' +
                                    '</button>'
                                    + '</td>';

                            }
                            else if (user.activity_name == 'like')
                            {
                                userRow += '<td>' +
                                    '<button class="btn btn-primary"     id="' +"likeBtn"+ user.id + '"   disabled   onclick="like('+ user.id+ ')" >' +
                                    '' +
                                    'Like ' +
                                    '</button>'+' ' +

                                    '<button class="btn btn-danger"     id="' +"dislikeBtn"+ user.id + '"    onclick="dislike('+ user.id+ ')" >' +
                                    '' +
                                    'Dislike ' +
                                    '</button>'
                                    + '</td>';

                            }
                            else if(user.activity_name == 'dislike')
                            {
                                userRow += '<td>' +
                                    '<button class="btn btn-primary"     id="' +"likeBtn"+ user.id + '"    onclick="like('+ user.id+ ')" >' +
                                    '' +
                                    'Like ' +
                                    '</button>'+' ' +

                                    '<button class="btn btn-danger"     id="' +"dislikeBtn"+ user.id + '"  disabled  onclick="dislike('+ user.id+ ')" >' +
                                    '' +
                                    'Dislike ' +
                                    '</button>'

                                    + '</td>';

                            }


                            userRow += '</tr>';

                        })

                    }
                    else
                    {
                        $("#tabHeader").hide();
                        userRow += '<h3 style="margin-left: 10px"> No Users found </h3>';


                    }


                    $('#usersTableBody').append(userRow);

                }
            });



        });




        function like(userId) {
            $.ajax({
                url: '{{ url('like') }}/'+userId,

                type: 'GET',
                success: function(res) {
                    console.log(res);
                    alert( JSON.parse(res).message );

                    if (JSON.parse(res).match_notification === true)
                    {
                        alert('It\'s a Match!');
                    }

                    $("#likeBtn"+userId).attr("disabled", true);
                    $("#dislikeBtn"+userId).prop("disabled", false);

                },
                error: function () {
                    alert('Try again later');
                }
            });

        }

        function dislike(userId) {
            $.ajax({
                url: '{{ url('dislike') }}/'+userId,
                type: 'GET',
                success: function(res) {
                    console.log(res);
                    alert( JSON.parse(res).message );

                    $("#dislikeBtn"+userId).attr("disabled", true);
                    $("#likeBtn"+userId).prop('disabled', false);

                },
                error: function () {
                    alert('Try again later');
                }
            });
        }




        // $(document).ready(function(){
        //     $("#likeBtn").click(function(){
        //
        //        $("#likeBtn").attr("disabled", true);
        //     });
        //
        //     $("#dislikeBtn").click(function(){
        //        alert('disliked');
        //         $("#dislikeBtn").attr("disabled", true);
        //     });
        // });
    </script>
@endsection
