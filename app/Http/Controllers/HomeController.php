<?php

namespace App\Http\Controllers;

use App\Repositories\CentralUserRepositoryInterface;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|Response|\Illuminate\View\View
     */
    public function index()
    {

        $users = $this->centralUserRepository->desiredUserList();

//        $users = [];

        return view('home', [
            'users' => $users
        ]);
    }
}
