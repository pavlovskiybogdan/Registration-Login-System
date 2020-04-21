<?php

namespace App\src\Controllers\Auth;

use App\src\Entities\User;
use App\src\Services\AuthService;
use Framework\Application;
use Framework\View\View;
use Framework\Helpers\Json;
use Framework\Helpers\Session;
use Framework\Controller\Controller;
use Framework\Exceptions\QueryException;

class AuthController extends Controller
{
    /**
     * @return Json|mixed
     * @throws QueryException
     */
    public function actionChangePassword()
    {
        if (Application::$app->request->isPost) {
            return new Json(AuthService::changePassword());
        }

        return View::render404();
    }

    /**
     * @return mixed|void
     * @throws QueryException
     */
    public function actionSendResetLink()
    {
        if (Application::$app->request->isPost) {
            return new Json(AuthService::sendResetPasswordLink());
        }

        return View::render404();
    }

    /**
     * @return mixed
     * @throws QueryException
     */
    public function actionRegister()
    {
        if (Application::$app->request->isPost) {
            return new Json(AuthService::create());
        }

        return View::render404();
    }

    /**
     * @return Json|mixed
     * @throws QueryException
     */
    public function actionLogin()
    {
        if (Application::$app->request->isPost) {
            return new Json(AuthService::login());
        }

        return View::render404();
    }

    /**
     * @return Json|mixed
     * @throws QueryException
     */
    public function getUserEmail()
    {
        $model = new User();

        if (Application::$app->request->isPost) {
            $params = Application::$app->request->bodyParams;
            $user = $model->findByEmail($params->email);
            return new Json((array)$user);
        }

        return View::render404();
    }

    public function actionLogout() : void
    {
        Session::destroy();
        $this->redirect('/login');
    }
}