<?php

namespace App\Http\Controllers\Apis;

use CRM\Models\User;
use CRM\Transformers\UserTransformer;
use CRM\Users\UserRepository;

class UserController extends ApiController
{
    protected $userRepository;

    /**
     * UserController constructor.
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function users(User $user)
    {
        $paginatedUsers = $this->userRepository->getUsers($user);

        return $this->respondWithJson(
            (new UserTransformer())->transformCollection($paginatedUsers)
        );
    }
}
