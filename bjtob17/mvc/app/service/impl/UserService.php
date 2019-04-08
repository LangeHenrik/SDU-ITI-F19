<?php


namespace app\service\impl;


use app\model\dto\UserDto;
use app\model\User;
use app\repository\IUserRepository;
use app\service\IEntityService;
use app\service\IUserService;

class UserService implements IUserService
{
    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * @var IEntityService
     */
    private $entityService;

    /**
     * UserService constructor.
     * @param IUserRepository $userRepository
     * @param IEntityService $entityService
     */
    public function __construct(IUserRepository $userRepository, IEntityService $entityService)
    {
        $this->userRepository = $userRepository;
        $this->entityService = $entityService;
    }


    function findAll(): array
    {
        return $this->entityService->formatMultiple($this->userRepository->findAll());
    }

    function findById(int $id): ?User
    {
        // TODO: Implement findById() method.
    }

    function create(UserDto $userDto)
    {
        // TODO: Implement create() method.
    }
}