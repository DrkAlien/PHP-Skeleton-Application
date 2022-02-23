<?php
namespace App\Admin\Controller;

use App\Model\User;
use App\Model\UserPlan;

class Users {

    public function list() {
        $page = (isset($this->request->page) && is_numeric($this->request->page))? $this->request->page:1;
        $users = User::orderBy('id', 'desc')->paginate(PER_PAGE, ['*'], '', $page);
        $this->response->setData($users);
    }

    public function add() {
        $plans = UserPlan::all();
        // set the "roles" as key that will be used in the view. $this->data['roles']
        $this->response->setData($plans,'plans');
        if($this->request->method == 'POST' && !empty($this->request->payload)) {
            if(isset($this->request->payload['email']) && filter_var($this->request->payload['email'], FILTER_VALIDATE_EMAIL)) {
                $found = User::where('email',$this->request->payload['email'])->first();
                if(isset($this->request->payload['password']) && !empty($this->request->payload['password']) && empty($found)) {
                    $this->request->payload['password'] = password_hash($this->request->payload['password'], PASSWORD_BCRYPT);
                    $obj = User::create($this->request->payload);
                }
                if(isset($obj->id)) {
                    $alert = ['type'  => 'success',
                            'title' => 'Success!',
                            'text'  => 'User account created!'
                    ];
                    $this->request->session->set('alert', $alert);
                    $this->request::redirect(SITE_URL.'/'.$this->request->module.'/'.$this->request->controller.'/list');
                }
            }
            $alert = ['type'  => 'danger',
                    'title' => 'Error!',
                    'text'  => 'Account already exists or it cannot be created!'
            ];
            $this->request->session->set('alert', $alert);
            $this->response->setData($this->request->payload,'form');
        }
    }

    public function edit() {
        $plans = UserPlan::all();
        $this->response->setData($plans,'plans');
        $user = User::find($this->request->uuid);
        if(empty($user)) {
            $alert = ['type'  => 'warning',
                    'title' => 'Warning!',
                    'text'  => 'This user account does not exist!'
            ];
            $this->request->session->set('alert', $alert);
            $this->request::redirect(SITE_URL.'/'.$this->request->module.'/'.$this->request->controller.'/list');
        }
        $this->response->setData($user,'user');
    }

    public function update() {
        if($this->request->method == 'POST' && isset($this->request->uuid)) {
            $data = $this->request->payload;
            $data['active'] = (isset($this->request->payload['active']))? '1':'0';
            if(!empty($data['password'])) {
                    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            } else {
                    unset($data['password']);
            }
            User::find($this->request->uuid)->update($data);
            $alert = ['type'  => 'success',
                    'title' => 'Success!',
                    'text'  => 'User account updated!'
            ];
            $this->request->session->set('alert', $alert);
        }
        $this->request::redirect(SITE_URL.'/'.$this->request->module.'/'.$this->request->controller.'/edit/'.$this->request->uuid);
    }

    public function delete() {
        $user = User::find($this->request->uuid);
        if($this->request->method == 'POST' && isset($this->request->uuid) && !empty($user)) {
            if(isset($this->request->payload['delete'])) {
                if($user->delete()) {
                    $alert = ['type'  => 'success',
                            'title' => 'Success!',
                            'text'  => 'Account deleted!'
                    ];
                    $this->request->session->set('alert', $alert);
                    $this->request::redirect(SITE_URL.'/'.$this->request->module.'/'.$this->request->controller.'/list/');
                }
            }
            $alert = ['type'  => 'warning',
                    'title' => 'Warning!',
                    'text'  => 'Please use the checkbox to confirm the deletion!'
            ];
            $this->request->session->set('alert', $alert);
            $this->request::redirect(SITE_URL.'/'.$this->request->module.'/'.$this->request->controller.'/delete/'.$this->request->uuid);
        }
        $this->response->setData($user);
    }

}