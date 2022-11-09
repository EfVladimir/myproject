<?php

namespace App\Http\Helpers;

use Carbon\Carbon;

class JWT
{
    protected $payload;//user info
    protected $signature;//secret
    protected $header;  //alg

    /**
     * @param \stdClass $payload
     */
    public function setPayload($id): void
    {
        $this->payload = new \stdClass();
        $this->payload->user_id = $id;
        $this->payload->ex = Carbon::now()->addMinute(30);
    }
    function __construct($id){
        $this->header = "H256";
        $this->setPayload($id);
        $this->signature = env('JWT_SECRET');

    }

    public static function Generate(){
        $jwt = base64_encode($this->header).'.'.base64_encode($this->payload).'.'.base64_encode($this->signature);
        return $jwt;
        //todo
    }
}
