<?php
namespace App\Frontend\Controller;

use App\Frontend\Model\User;

class Home {

    public function view() {
        $data = ['request' => $this->request,
                 'links' => ''
        ];
        unset($data['request']->session);
        $this->response->setData($data);
    }

    public function documentation() {
        
    }

    public function page_not_found() {

    }

}