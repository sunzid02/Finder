import React, { Component } from 'react';
import ReactDOM from 'react-dom';



export default class Index extends Component {
    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-heading">Dashboard</div>

                            <div className="panel-body">
                                @if (session('status'))
                                <div className="alert alert-success">
                                    {{session('status')}}
                                </div>
                                @endif

                                You are logged in!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<Index /> , document.getElementById('app'));
}