<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;

class ApiController extends Controller {
    protected $statusCode = Response::HTTP_OK;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respondWithPagination(LengthAwarePaginator $pagination, $data)
    {
        $data = array_merge($data, [
            'pagination' => [
                'total' => $pagination->total(),
                'count' => $pagination->count(),
                'current_page' => $pagination->currentPage(),
                'last_page' => $pagination->lastPage(),
                'per_page' => $pagination->perPage()
            ]
        ]);

        return $this->respond($data);
    }

    public function respondCreated($data = [], $message = 'Successfully created!')
    {
        return $this->setStatusCode(Response::HTTP_CREATED)->respond([
            'data' => $data,
            'message' => $message
        ]);
    }

    public function respondUpdated($data = [], $message = 'Successfully updated!')
    {
        return $this->setStatusCode(Response::HTTP_ACCEPTED)->respond([
            'data' => $data,
            'message' => $message
        ]);
    }

    public function respondDeleted($data = [], $message = 'Successfully deleted!')
    {
        return $this->setStatusCode(Response::HTTP_ACCEPTED)->respond([
            'data' => $data,
            'message' => $message
        ]);
    }

    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respondNotValid($errorBag = [])
    {
        return $this->setStatusCode(
            Response::HTTP_UNPROCESSABLE_ENTITY)
                ->respondWithValidationErrors($errorBag);
    }

    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    public function respondWithValidationErrors($errorBag)
    {
        return $this->respond([
            'errors' => $errorBag,
            'status_code' => $this->getStatusCode()
        ]);
    }
}
