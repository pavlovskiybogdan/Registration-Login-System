<?php

namespace App\src\Entities;

use Framework\Model\Model;
use Framework\Exceptions\QueryException;

/**
 * Class User
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
 */
class User extends Model
{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $country;
    public string $password;
    public string $password_confirm;
    public string $avatar;
    public string $token;

    /**
     * @param string $email
     * @return User|array
     * @throws QueryException
     */
    public function findByEmail(string $email)
    {
        return $this::table('users')->where('email', $email);
    }

    /**
     * @param string $token
     * @return User|array
     * @throws QueryException
     */
    public function findByToken(string $token): self
    {
        return $this::table('users')->where('token', $token);
    }

    /**
     * @return string
     */
    public function avatarPath(): string
    {
        $partial = explode('/app', $this->avatar);
        return 'app' . $partial[1];
    }

    /**
     * @return string
     */
    public function getFullname(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}