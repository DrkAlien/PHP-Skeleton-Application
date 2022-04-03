<?php
namespace App\Admin\Controller;

use App\Model\User;
use App\Model\Admin;

class Home {

    public function login() {

        if($this->session->exist('admin')) {
            $this->request::redirect(SITE_URL.'/'.$this->request->module.'/dashboard');
        }

        if($this->request->method == 'POST' && isset($this->request->payload['email']) && isset($this->request->payload['password'])) {
            // validate email & password
            $email = filter_var($this->request->payload['email'], FILTER_SANITIZE_EMAIL);
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $admin = Admin::where('email',$email)->first();
            }
            if(isset($admin->password) && password_verify($this->request->payload['password'], $admin->password)) {
                $adminSession = new \stdClass();
                $adminSession->id = $admin->id;
                $adminSession->first_name = $admin->first_name;
                $adminSession->last_name = $admin->last_name;
                $adminSession->role = $admin->role;

                $this->session->set('admin',$adminSession);
                $this->request::redirect(SITE_URL.'/'.$this->request->module.'/dashboard');
            } else {
                // set some errors and redirect
                $alert = ['type' => 'danger',
                          'title' => 'Error!',
                          'text'  => 'Invalid credentials!'
                ];
                $this->session->set('alert', $alert);
                $this->request::redirect(SITE_URL.'/'.$this->request->module.'/login');
            }
        }
    }

    public function logout() {
        $this->session->del('admin');
        $alert = ['type' => 'success',
                  'title' => 'Success!',
                  'text'  => 'You have successfully been logged out!'
        ];
        $this->session->set('alert', $alert);
        $this->request::redirect(SITE_URL.'/'.$this->request->module.'/login');
    }

    public function dashboard() {
        $count = [];
        $count['admins']         = Admin::all()->count();
        $count['adminsActive']   = Admin::where('active','1')->count();
        $count['users']          = User::all()->count();
        $count['usersActive']    = User::where('active','1')->count();
        $this->response->setData($count);
    }

    public function get_users_count() {
        $count['users']        = User::all()->count();
        $count['usersActive']  = User::where('active','1')->count();
        $response = ['success' => true,
                     'message' => '',
                     'data'    => $count
        ];
        $this->response->setType('json');
        $this->response->setData($response);
    }

    public function get_html() {
        $data = ['nr' => 132,
                 'percentage' => '+6.8%'
        ];
        $this->response->setView(APPLICATION_PATH.'/app/modules/admin/view/'.$this->request->controller.'/gethtml.php');
        $this->response->setData($data);
    }

}