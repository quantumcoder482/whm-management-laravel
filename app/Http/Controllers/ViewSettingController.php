<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewSettings;

class ViewSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ViewSettings::all();
        $settings = [];
        $captions = [];


        foreach($data as $d){
            $settings[$d['setting']] = $d['value'];
            switch ($d['setting']) {
                case 'org_name':
                    $captions[$d['setting']] = "View Organization Name";
                    break;
                case 'domain':
                    $captions[$d['setting']] = "View Domain Name";
                    break;
                case 'subdomain':
                    $captions[$d['setting']] = "View SubDomain Name";
                    break;
                case 'super_user':
                    $captions[$d['setting']] = "View SuperUser Name";
                    break;
                case 'super_password':
                    $captions[$d['setting']] = "View SuperUser Password";
                    break;
                case 'admin_user':
                    $captions[$d['setting']] = "View AdminUser Name";
                    break;
                case 'admin_password':
                    $captions[$d['setting']] = "View Admin Password";
                    break;
                case 'db_name':
                    $captions[$d['setting']] = "View Database Name";
                    break;
                case 'db_user':
                    $captions[$d['setting']] = "View Database User Name";
                    break;
                case 'db_password':
                    $captions[$d['setting']] = "View Database Password";
                    break;
                case 'created_by':
                    $captions[$d['setting']] = "View Created by";
                    break;
                case 'owner_name':
                    $captions[$d['setting']] = "View Owner Name";
                    break;
                case 'sale_type':
                    $captions[$d['setting']] = "View Sale Type";
                    break;
                case 'email':
                    $captions[$d['setting']] = "View Email Address";
                    break;
                case 'created_at':
                    $captions[$d['setting']] = "View Created Date";
                    break;

                default:
                    # code...
                    break;
            }
        }


        return view('view_setting', ['data' => $settings, 'captions'=>$captions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {

        $data = $request->all();
        $option = $data['opt'];
        $value = $data['val'];


        $data = ViewSettings::where('setting', $option)->first();
        $data->value = $value;
        $result = $data->save();

        return response()->json(['result' => $result]);
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
}
