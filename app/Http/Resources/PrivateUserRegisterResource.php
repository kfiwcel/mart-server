<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;

class PrivateUserRegisterResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $response = Http::asForm()->post('http://www.mart-server.test/oauth/token', [
            'grant_type' => 'password',
            'client_id' => '2',
            'client_secret' => 'mMXO5JQJVPBJ21DsUKKejMVQiMXVF1IZhzsg7dsr',
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ]);
        //$token=json_decode((string) $response->getBody(),true);


        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'created_at'=>$this->created_at,
            $response->json()
        ];
    }
}
