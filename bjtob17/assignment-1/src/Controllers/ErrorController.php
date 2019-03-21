<?php
namespace Controllers;

use DependencyInjector\DependencyInjectionContainer;
use Models\Dto\UserDto;
use Repositories\Interfaces\IPhotoRepository;
use Repositories\Interfaces\IUserRepository;
use Routing\IRequest;

class ErrorController extends BaseController
{

    /**
     * @param DependencyInjectionContainer $di
     * @param $config
     */
    public function __construct(DependencyInjectionContainer $di, $config)
    {
        parent::__construct($config);
    }

    public function notFound(IRequest $request)
    {
        return $this->html("error", ["page_title" => "404 Not Found", "error" => 404]);
    }

    public function methodNotAllowed(IRequest $request)
    {
        return $this->html("error", ["page_title" => "405 Method not allowed", "error" => 405]);
    }

}
