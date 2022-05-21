<?php
namespace App\Admin\Controller;
use Leaf\Http\Session;

use App\Model\Admin;
use App\Model\AdminRole;

class Admins {

    public function list() {
        $page = (isset($this->request->page) && is_numeric($this->request->page))? $this->request->page:1;
        $admins = Admin::orderBy('id', 'desc')->paginate(PER_PAGE, ['*'], '', $page);
        $this->response->setData($admins);
    }

    public function add() {
        $roles = AdminRole::all();
        // set the "roles" as key that will be used in the view. $this->data['roles']
        $this->response->setData($roles,'roles');
        if($this->request->method == 'POST' && !empty($this->request->payload)) {
            if($this->request->has('email') && filter_var($this->request->get('email'), FILTER_VALIDATE_EMAIL)) {
                $found = Admin::where('email',$this->request->get('email'))->first();
                if(isset($this->request->payload['password']) && !empty($this->request->payload['password']) && empty($found)) {
                    $this->request->payload['password'] = password_hash($this->request->payload['password'], PASSWORD_BCRYPT);
                    $obj = Admin::create($this->request->payload);
                }
                if(isset($obj->id)) {
                    $alert = ['type'  => 'success',
                              'title' => 'Success!',
                              'text'  => 'Admin account created!'
                    ];
                    Session::set('alert', $alert);
                    $this->request::redirect(SITE_URL.'/'.$this->request->module.'/'.$this->request->controller.'/list');
                }
            }
            $alert = ['type'  => 'danger',
                      'title' => 'Error!',
                      'text'  => 'Account already exists or it cannot be created!'
            ];
            Session::set('alert', $alert);
            $this->response->setData($this->request->payload,'form');
        }
    }

    public function edit() {
        $roles = AdminRole::all();
        $this->response->setData($roles,'roles');
        $admin = Admin::find($this->request->uuid);
        if(empty($admin)) {
            $alert = ['type'  => 'warning',
                      'title' => 'Warning!',
                      'text'  => 'This admin account does not exist!'
            ];
            Session::set('alert', $alert);
            $this->request::redirect(SITE_URL.'/'.$this->request->module.'/'.$this->request->controller.'/list');
        }
        $this->response->setData($admin,'admin');
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
            Admin::find($this->request->uuid)->update($data);
            $alert = ['type'  => 'success',
                      'title' => 'Success!',
                      'text'  => 'Admin account updated!'
            ];
            Session::set('alert', $alert);
        }
        $this->request::redirect(SITE_URL.'/'.$this->request->module.'/'.$this->request->controller.'/edit/'.$this->request->uuid);
    }

    public function delete() {
        $admin = Admin::find($this->request->uuid);
        if($this->request->method == 'POST' && isset($this->request->uuid) && !empty($admin)) {
            if(isset($this->request->payload['delete'])) {
                if($admin->delete()) {
                    $alert = ['type'  => 'success',
                              'title' => 'Success!',
                              'text'  => 'Account deleted!'
                    ];
                    Session::set('alert', $alert);
                    $this->request::redirect(SITE_URL.'/'.$this->request->module.'/'.$this->request->controller.'/list/');
                }
            }
            $alert = ['type'  => 'warning',
                      'title' => 'Warning!',
                      'text'  => 'Please use the checkbox to confirm the deletion!'
            ];
            Session::set('alert', $alert);
            $this->request::redirect(SITE_URL.'/'.$this->request->module.'/'.$this->request->controller.'/delete/'.$this->request->uuid);
        }
        $this->response->setData($admin);
    }

}