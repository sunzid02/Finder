<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityRepositoryInterface;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * @var ActivityRepositoryInterface
     */
    private $activityRepository;
    private $like;
    private $dislike;

    public function __construct(ActivityRepositoryInterface $activityRepository)
    {

        $this->activityRepository = $activityRepository;
        $this->like = 'like';
        $this->dislike = 'dislike';
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


}
