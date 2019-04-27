<?php


namespace app\service\impl;


use app\model\dto\UserApiDto;
use app\model\dto\UserRegisterDto;
use app\model\User;
use app\repository\IUserRepository;
use app\service\IUserService;

class UserService implements IUserService
{
    /**
     * @var IUserRepository
     */
    private $userRepository;


    /**
     * UserService constructor.
     * @param IUserRepository $userRepository
     */
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    function findAll(): array
    {
        return $this->userRepository->findAll();
    }

    function findById(int $id): ?User
    {
        // TODO: Implement findById() method.
    }

    function create(UserRegisterDto $userDto): array
    {
        $errors = [];
        $user = $this->findByUsername($userDto->username);

        if ($user !== null) {
            array_push($errors, 'Username already taken');
        }  else if (strlen($userDto->firstName) <= 1) {
            array_push($errors, "First name must have at least two character");
        }
        else if (strlen($userDto->lastName) <= 1) {
            array_push($errors, "Last name must have at least two character");
        }
        else if (strlen($userDto->zip) < 4) {
            array_push($errors, "Zip must be 4 numbers");
        }
        else if (strlen($userDto->city) <= 1) {
            array_push($errors, "City name must be at least two characters");
        }
        else if (strlen($userDto->email) <= 1 || strpos($userDto->email, "@") === false) {
            array_push($errors, "Email must be at least two characters, and contain the '@' character");
        }
        else if (strlen($userDto->phone) < 8) {
            array_push($errors, "Phone number must be at least eight characters");
        }

        if (count($errors) > 0) {
            return $errors;
        }

        $success = $this->userRepository->create($userDto);
        if (!$success) {
            array_push($errors, "Database error occurred");
        }

        return $errors;
    }

    function findByUsername(string $username): ?User
    {
        return $this->userRepository->findByUsername($username);
    }
}