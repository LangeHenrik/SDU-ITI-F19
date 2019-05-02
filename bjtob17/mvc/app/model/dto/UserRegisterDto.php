<?php


namespace app\model\dto;


use app\model\User;

class UserRegisterDto
{

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $hashedPassword;

    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $zip;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $email;

    /**
     * @var int
     */
    public $phone;

    /**
     * UserRegisterDto constructor.
     * @param string $username
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     * @param string $zip
     * @param string $city
     * @param string $email
     * @param string $phone
     */
    public function __construct(string $username, string $password, string $firstName, string $lastName, string $zip, string $city, string $email, string $phone)
    {
        $this->username = $username;
        $this->password = $password;
        $this->hashedPassword = User::generateHash($password);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->zip = $zip;
        $this->city = $city;
        $this->email = $email;
        $this->phone = $phone;
    }

    public static function fromArray(array $arr)
    {
        return new UserRegisterDto(
            $arr["username"],
            $arr["password"],
            $arr["firstName"],
            $arr["lastName"],
            $arr["zip"],
            $arr["city"],
            $arr["email"],
            $arr["phone"]
        );
    }


}