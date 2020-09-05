<?php

namespace App\Repositories;

interface ActivityRepositoryInterface
{
    public function updateAction($action, $userId);
}