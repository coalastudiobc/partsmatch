<?php

namespace App\Exceptions;

use Exception;

class AjaxValidationException extends Exception
{
    private $validator;
    public function __construct($validator)
    {
        $this->validator = $validator;
    }
    public function render($request)
    {
        $response = [
            'success' => false,
            'message' => $this->validator->errors()->all(),
        ];
        if (request('errortype'))
            $response['errortype'] = request('errortype');
        return response()->json($response);
    }
}
