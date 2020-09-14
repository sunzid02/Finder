<?php

namespace App\Http\Controllers;

use App\Events\CurrentLocationEvent;
use App\Events\TestEvent;
use App\Repositories\CentralUserRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @var CentralUserRepositoryInterface
     */
    private $centralUserRepository;

    /**
     * Create a new controller instance.
     *
     * @param CentralUserRepositoryInterface $centralUserRepository
     */
    public function __construct(CentralUserRepositoryInterface $centralUserRepository)
    {
        $this->middleware('auth');
        $this->centralUserRepository = $centralUserRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Factory|Application|Response|View
     */
    public function index()
    {

        //        $users = $this->centralUserRepository->desiredUserList();
        //        dd($users);
        //        event(new TestEvent($users));
        //        event(new CurrentLocationEvent(Auth::user()));

        ////update user current location
        //        $this->centralUserRepository->updateCurrentLocation();

        //        $users = [];

        return view('home');
    }

    public function userList()
    {
        $users = $this->centralUserRepository->desiredUserList();
//        $users = [];

        if ( $users )
        {
            $data['user_list_size'] = count($users);
            $data['data'] = $users;
        }
        else
        {
            $data['user_list_size'] = 0;
            $data['data'] = [];
        }

        $response = json_encode($data);

        //        echo "<pre>";
        return $response;
    }
}
