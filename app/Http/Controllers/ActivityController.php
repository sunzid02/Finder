<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityRepositoryInterface;
use App\Repositories\CentralUserRepositoryInterface;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * @var ActivityRepositoryInterface
     */
    private $activityRepository;
    private $like;
    private $dislike;
    /**
     * @var CentralUserRepositoryInterface
     */
    private $centralUserRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository, CentralUserRepositoryInterface $centralUserRepository)
    {

        $this->activityRepository = $activityRepository;
        $this->like = 'like';
        $this->dislike = 'dislike';
        $this->centralUserRepository = $centralUserRepository;
    }

    public function like( Request $request )
    {
       $response =  $this->activityRepository->updateAction($this->like, $request->userId);

        return json_encode($response);
    }


    public function dislike( Request $request )
    {
        $response =  $this->activityRepository->updateAction($this->dislike, $request->userId);

        return json_encode($response);
    }

    public function map( Request $request )
    {
        $users =  $this->centralUserRepository->desiredUserList('map');
//        dd(json_encode($users));
//        dd($users);

        return view('map', [
            'users' => $users,
//            'users' => json_encode($users),
        ]);

//         var allUserJson = <?= $users; <!--;-->
//<!--        -->
//<!--        // var allUserArr = ;p-->
//<!--        console.log(allUserJson);-->

    }


}
