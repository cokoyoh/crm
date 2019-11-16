<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    protected $statusCode = 200;

    /**
     * @return int
     */
    private function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return ApiController
     */
    private function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondCreated($message)
    {
        return $this->setStatusCode(201)
            ->respond(['message' => $message]);
    }

    public function respondSuccess(array $data)
    {
        return $this->setStatusCode(200)
            ->respond($data);
    }

    public function respondWithJson($data)
    {
        return $data;
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondFailedValidation($message)
    {
        return $this->setStatusCode(422)
            ->respond([
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)
            ->respondWithError($message);
    }

    /**
     * @param $data
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    private function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }
}
