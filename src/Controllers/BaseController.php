<?php

namespace Treefung\Course\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use Qcmaker\Bjkjcloud\Models\User;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($data = null, $message = null) {

        return $this->_result(true, $message, $data);
    }

    public function fail($message = null) {


        return $this->_result(false, $message, null);
    }

    private function _result($success, $message, $data) {

        $json = [
            'success' => $success,
            'message' => $message,
            'data'    => $data,
        ];

        if($success) {
            unset($json['message']);
        }

        if(!$success) {
            unset($json['data']);
        }


        return Response::json($json);
    }

    public function loginUser() {

        $token = Cookie::get('token');

        if(!$token) {
            throw new Exception('未登录', 200, null);
        }

        $userId = decrypt($token);

        $user = User::query()->find($userId);

        return $user;
    }
}
