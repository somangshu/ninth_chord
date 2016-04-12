<?php

namespace app\Transformers;

use Response;

/**
 * Class SuccessMessageTransformer.
 */
class SuccessMessageTransformer
{
    protected $_data;
    protected $_message;
    protected $_error;
    protected $_status;

    public function __construct($data, $message, $error, $status)
    {
        $this->_data = $data;
        $this->_message = $message;
        $this->_status = $status;
    }
    /**
     * Transform the \ValidationError entity.
     *
     * @param \ValidationError $model
     *
     * @return array
     */
    public function transform()
    {
        return Response::json([
            'data' => $this->_data,
            'message' => $this->_message,
            'errors' => false,
            'status' => $this->_status,
        ], $this->_status, [], JSON_NUMERIC_CHECK);
    }
}
