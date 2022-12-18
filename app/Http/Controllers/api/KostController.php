<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kost;
use Illuminate\Support\Facades;

class KostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $kosts = Kosts::all();

    return new KostResource(true, 'Data Kost', $kosts);
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
            'alamat' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        else{
            $kosts = Kosts::create([
                'id' => $request->id,
                'username' => $request->username,
                'alamat' => $request->alamat,
            ]);

            return new KostResource(true, 'Data berhasil disimpan!', $kosts);
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
        $kosts = Kosts::find(id);

        if($kosts){
            return new KostResource(true, 'Data Kost ditemukan', $kosts);
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
            'alamat' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        else{
            $kosts = Kosts::find($id);

            if($kosts){
                $kosts->username = $request->username;
                $kosts->alamat = $request->alamat;
                $userApis->save();

                return new KostResource(true, 'Data berhasil diubah!', $kosts);

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
        $kosts = Kosts::find($id);

            if($kosts){
                $kosts->delete();

                return new KostResource(true, 'Data berhasil dihapus!', $kosts);

            }else{
                return response()->json([
                    'message' => 'Data not found'
                ]);
            }
    }
}
