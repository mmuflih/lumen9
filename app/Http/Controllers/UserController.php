<?php

/**
 * Created by Muhammad Muflih Kholidin
 * https://github.com/mmuflih
 * muflic.24@gmail.com
 **/

namespace App\Http\Controllers;

use App\Context\UserController\AddByAdmin;
use App\Context\UserController\GetByAdmin;
use App\Context\UserController\ListByAdmin;
use App\Context\UserController\RegisterUserHandler;
use App\Context\UserController\SetPasswordHandler;
use Illuminate\Http\Request;
use Validator;

class UserController extends ApiController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email|unique:user_emails',
                'password' => 'required|confirmed',
                'name' => 'required',
            ]);
            $handler = RegisterUserHandler::fromRequest($request);
            $data = $handler->handle();
            return $this->responseData($data);
        } catch (\Exception $e) {
            return $this->responseException($e);
        }
    }

    public function setPassword(Request $request)
    {
        try {
            $this->validate($request, [
                'old_password' => 'required',
                'password' => 'sometimes|required|confirmed',
            ]);
            $handler = new SetPasswordHandler($request);
            $data = $handler->handle();
            return $this->responseData($data);
        } catch (\Exception $e) {
            return $this->responseException($e);
        }
    }

    /** ---------- admin area -------------- */
    public function addUserByAdmin(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:user_emails',
            'password' => 'required|confirmed',
            'name' => 'required',
        ];
        return $this->responseHandler(new AddByAdmin($request), $request, $rules);
    }

    public function getUserByAdmin($user_id)
    {
        return $this->responseReader(new GetByAdmin($user_id));
    }

    public function listUserByAdmin(Request $request)
    {
        return $this->responseHasPaginateReader(new ListByAdmin($request));
    }
}
