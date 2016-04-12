<?php

namespace App\Transformers;

use Response;
/**
 * Class ValidationErrorTransformer
 * @package namespace App\Transformers;
 */
class ErrorTransformer
{
    protected $_message;
    protected $_error;
    protected $_status;
    protected $_errorBag;

    public function __construct($message, $errorBag, $status)
    {
        $this->_message = $message;
        $this->_status = $status;
        $this->_errorBag = $errorBag;
    }
    /**
     * Transform the \ValidationError entity
     * @param \ValidationError $model
     *
     * @return array
     */
    public function transform()
    {
        return Response::json([
            'message' => $this->_message,
            'errorBag' => $this->_errorBag,
            'errors' => true,
            'status' => $this->_status
        ], $this->_status);
    }
}
