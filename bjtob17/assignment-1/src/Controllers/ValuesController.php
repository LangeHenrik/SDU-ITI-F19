<?php
namespace Controllers;


use Routing\IRequest;

class ValuesController extends BaseController
{
    public function values(IRequest $request)
    {
        return $this->json([1,2,3,4,5]);
    }
}