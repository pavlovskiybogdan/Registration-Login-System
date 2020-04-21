<?php

namespace App\src\Services;

use App\src\Entities\User;
use Framework\Application;
use Framework\Helpers\Session;
use Framework\Helpers\QueryBuilder;
use Framework\Helpers\FIleUploader;
use Framework\Exceptions\QueryException;

class AuthService
{
    /**
     * @return array|null
     * @throws QueryException
     * @throws \Exception
     */
    public static function create()
    {
        $entity = new User();
        $files = Application::$app->request->files();

        $user = $entity->associate(Application::$app->request->body);

        if ($user->password !== $user->password_confirm) {
            throw new \Error('Invalid properties');
        }

        if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            throw new \Error('Invalid properties');
        }

        if (!empty($files['avatar']['name'])) {
            $avatar = FIleUploader::uploadAvatar($files['avatar']);
        }

        self::startLoginSession($user->email);

        return QueryBuilder::table('users')->insert([
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'country' => $user->country,
            'avatar' => !empty($avatar) ? $avatar : FIleUploader::DEFAULT_AVATAR_PATH,
            'token' => bin2hex(random_bytes(15)),
            'password' => password_hash($user->password, PASSWORD_DEFAULT)
        ]);
    }

    /**
     * @return bool
     * @throws QueryException
     */
    public static function login() : bool
    {
        $user = new User();
        $credentials = Application::$app->request->body;
        $candidate = $user->findByEmail($credentials['email']);

        if (empty($candidate->password)) {
            return false;
        }

        if (!password_verify($credentials['password'], $candidate->password)) {
            return false;
        }

        self::startLoginSession($candidate->email);

        return true;
    }

    /**
     * @return bool
     * @throws QueryException
     */
    public static function sendResetPasswordLink() : bool
    {
        $user = new User();
        $params = Application::$app->request->bodyParams;
        $candidate = $user->findByEmail($params->email);

        if (empty($candidate->token)) {
            return false;
        }

        return Application::$app->mailer->sendResetLink($params->email, $candidate->token);
    }

    /**
     * Reset user password and update token
     * @throws QueryException
     * @throws \Exception
     */
    public static function changePassword()
    {
        $body = Application::$app->request->body;

        if (empty($body['token']) || empty($body['password'])) {
            return false;
        }

        $candidate = User::table('users')->findByToken($body['token']);

        if (empty($candidate->token)) {
            return false;
        }

        return $candidate->update([
            'password' => password_hash($body['password'], PASSWORD_DEFAULT),
            'token' => bin2hex(random_bytes(15))
        ]);
    }

    /**
     * @return bool
     */
    public static function isUserLoggedIn() : bool
    {
        return (bool)Session::get('user_logged');
    }

    /**
     * @param string $email
     */
    private static function startLoginSession(string $email)
    {
        Session::set('user_logged', 1);
        Session::set('email', $email);
        Session::set('success_login', 1);
    }
}