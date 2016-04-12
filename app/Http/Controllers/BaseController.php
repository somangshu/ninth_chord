<?php

namespace App\Http\Controllers;

use App\Transformers\ErrorTransformer;
use App\Transformers\SuccessMessageTransformer;
use Log;

class BaseController extends Controller
{
    public function successMessage($data, $message, $error, $status)
    {
        $success = new SuccessMessageTransformer($data, $message, $error, $status);

        return $success->transform();
    }

    public function errorMessage($message, $errors, $status)
    {
        $error = new ErrorTransformer($message, $errors, $status);

        return $error->transform();
    }

    public function logError($error, $data = [])
    {
        return (empty($data)) ? Log::error($error) : Log::error($error, $data);
    }

}
