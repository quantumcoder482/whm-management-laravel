<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organizations;
use App\ViewSettings;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class OrganizationListController extends Controller
{
    public function index(Request $request)
    {
        $show = ViewSettings::all();
        $column = array();
        foreach($show as $key=>$value){
            $column[$value['setting']] = $value['value'];
        }
        
        $data = Organizations::all();
        return view('organization_list', ['Organizations' => $data, 'Column' => $column]);
    }

   
    public function get_site_info(Request $request)
    {
        $subdomain = $request->input('subdomain');
        $result = Organizations::where('subdomain', $subdomain)->first();
        return response()->json(['result' => $result]);
    }
}
