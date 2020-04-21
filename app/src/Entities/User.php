<?php

namespace App\src\Entities;

use Framework\Model\Model;
use Framework\Exceptions\QueryException;

/**
 * Class User
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $country
 * @property string $password
 * @property string $password_confirm
 * @property string $avatar
 * @property string $token
 * @property string $fullname
 * @package App\src\Entities
 */
class User extends Model
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $firstname;

    /**
     * @var string
     */
    public $lastname;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string;
     */
    public $password_confirm;

    /**
     * @var string
     */
    public $avatar;

    /**
     * @var string
     */
    public $token;

    /**
     * @param string $email
     * @return $this
     * @throws QueryException
     */
    public function findByEmail(string $email) : self
    {
        return $this::table('users')->where('email', $email);
    }

    /**
     * @param string $token
     * @return User|array
     * @throws QueryException
     */
    public function findByToken(string $token) : self
    {
        return $this::table('users')->where('token', $token);
    }

    /**
     * @return string
     */
    public function avatarPath() : string
    {
        $partial = explode('/app', $this->avatar);
        return 'app' . $partial[1];
    }

    /**
     * @return string
     */
    public function getFullname() : string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}