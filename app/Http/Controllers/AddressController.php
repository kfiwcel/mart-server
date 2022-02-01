<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressStoreRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return AddressResource::collection($request->user()->addresses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return AddressResource
     */
    public function store(AddressStoreRequest $request)
    {


        $request->user()->addresses()->update([
            'default'=>false
        ]);
        $address=Address::create([
            'user_id'=>$request->user()->id,
            'location'=>$request->location,
            'default'=>true
        ]);

        return new AddressResource($address);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function select(Request $request)//选择收货地址
    {
        $request->user()->addresses->each(function ($address) use($request){
            if ($address->id==$request->address_id) {
                $address->update([
                    'default'=>true
                ]);

            }else{
                $address->update([
                    'default'=>false
                ]);
            }
        });
    }


}
