<?php

/**
 *
 * @author Tarkiman | tarkiman@itasoft.co.id / tarkiman.zone@gmail.com 
 */

namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\I18n\Time;

class Auth extends BaseController
{
    protected $authModel;
    protected $dateTime;

    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->dateTime = new Time('now', 'Asia/Jakarta', 'id_ID');
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            $data = [
                'title' => 'Login',
                'validation' => \Config\Services::validation()
            ];
            return view('login2', $data);
        } else {
            return redirect()->to('/' . session()->get('landing_page'));
        }
    }

    public function signIn()
    {

        $validation = [
            'username' => [
                'rules' => 'required',
                'errors' => [
                    // 'required' => '{field} harus diisi.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    // 'required' => '{field} harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($validation)) {
            return redirect()->to('/login')->withInput()->with('messages', 'Error validation.');
        } else {
            $username = $this->request->getVar('username');
            $password = sha1($this->request->getVar('password'));
            $data = $this->authModel->login($username, $password);
            if ($data) {
                session()->set('isLoggedIn', true);
                session()->set('id_user', $data->id);
                session()->set('username', $data->username);
                session()->set('name', $data->name);
                session()->set('email', $data->email);
                session()->set('image', $data->image);
                session()->set('group_name', $data->group_name);
                session()->set('landing_page', $data->landing_page);
                session()->set('user_permissions', $this->authModel->getUserPermissions($data->id));
                return redirect()->to('/' . $data->landing_page);
            } else {
                return redirect()->to('/login')->with('messages', 'Username or Password is wrong.');
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function redirectForbiddenAccess()
    {
        $data = [
            'title' => 'Forbidden Access',
            'messages' => 'Sorry, you don\'t have permission to access this page, please contact your Administrator'
        ];
        return view('redirect', $data);
    }

    public function redirectPageNotFound()
    {
        $data = [
            'title' => '404 Not Found',
            'messages' => 'Sorry, an error has occured, Requested page not found!'
        ];
        return view('redirect', $data);
    }
}