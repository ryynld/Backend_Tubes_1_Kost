<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UserAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userApis = UserApis::all();

        return new UserApiResource(true, 'Data User', $userApis);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|unique',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'tglLahir' => 'required',
            'telepon' => 'required|numeric',
            'alamat' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        else{
            $userApis = UserApis::create([
                'id' => $request->id,
                'username' => $request->username,
                'password' => $request->password,
                'email' => $request->email,
                'tglLahir' => $request->tglLahir,
                'alamat' => $request->alamat,
            ]);

            return new UserApiResource(true, 'Data berhasil disimpan!', $userApis);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userApis = UserApis::find(id);

        if($userApis){
            return new UserApiResource(true, 'Data User ditemukan', $userApis);
        }
        else{
            return response()->json([
                'message' => 'Data not found!'
            ],422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'tglLahir' => 'required',
            'telepon' => 'required|numeric',
            'alamat' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        else{
            $userApis = UserApis::find($id);

            if($userApis){
                $userApis->username = $request->username;
                $userApis->password = $request->password;
                $userApis->email = $request->email;
                $userApis->tglLahir = $request->tglLahir;
                $userApis->alamat = $request->alamat;
                $userApis->save();

                return new UserApiResource(true, 'Data berhasil diubah!', $userApis);

            }else{
                return response()->json([
                    'message' => 'Data not found'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userApis = UserApis::find($id);

            if($userApis){
                $userApis->delete();

                return new UserApiResource(true, 'Data berhasil dihapus!', $userApis);

            }else{
                return response()->json([
                    'message' => 'Data not found'
                ]);
            }
    }
}
