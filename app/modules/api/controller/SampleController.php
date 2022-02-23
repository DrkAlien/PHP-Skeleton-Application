<?php
namespace App\Api\Controller;

class Sample {

    public function method_missing() {
        $response = ['success' => false,
                     'message' => 'Method not available',
                     'data'    => []
        ];
        // we don't need to set the response type since it is set in the config file, as json
        # $this->response->setType('json');
        $this->response->setCode(405); // method not allowed
        $this->response->setData($response);
    }

    public function get_sample() {
        $response = ['success' => true,
                     'message' => '',
                     'data'    => ['count' => 132,
                                   'percentage' => '+6.8%'
                     ]
        ];
        $this->response->setData($response);
    }


}