<?php
namespace App\Core\Response;

use App\Core\ViewRenderer\View;

class ResponseObject
{

    private $_response = "";
    private $_headers = [];

    public function __construct($value)
    {
        $this->setResponse($value);
    }

    /**
     * @param $value mixed
     */
    public function setResponse($value)
    {
        if(is_string($value) || is_numeric($value)) {
            $this->_response = $value;
        } else if(is_array($value)) {
            $this->_response = json_encode($value);
        } else if($value instanceof View) {
            $this->_response = $value->render();
        } else if($value instanceof Redirect) {
            $this->_response = null;
            $this->_headers['Location'] = $value->getUrl();
        }
    }

    /**
     * @return mixed
     */
    public function getResponse() {
        return $this->_response;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->_headers;
    }

}