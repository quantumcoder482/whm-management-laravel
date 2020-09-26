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
        $list_data = [];
        foreach($data as $d){
            if($d->sale_type == 'demo' && $this->dateDifferenceNow($d->created_at) <= 10){
                array_push($list_data, $d);
            }elseif($d->sale_type == 'monthly' && $this->dateDifferenceNow($d->created_at) <= 30){
                array_push($list_data, $d);
            }elseif($d->sale_type != 'demo' && $d->sale_type != 'monthly'){
                array_push($list_data, $d);
            }
        }

        return view('organization_list', ['Organizations' => $list_data, 'Column' => $column]);
    }

    public function expired()
    {
        $data = Organizations::all();
        $list_data = [];
        $expired_date_list = [];
        foreach ($data as $d) {
            if ($d->sale_type == 'demo' && $this->dateDifferenceNow($d->created_at) > 10) {
                array_push($list_data, $d);
                $date = new \DateTime($d->created_at);
                $date->add(new \DateInterval('P10D'));
                $expired_date_list[$d->id] = $date->format('Y-m-d');
            } elseif ($d->sale_type == 'monthly' && $this->dateDifferenceNow($d->created_at) > 30) {
                array_push($list_data, $d);
                $date = new \DateTime($d->created_at);
                $date->add(new \DateInterval('P30D'));
                $expired_date_list[$d->id] = $date->format('Y-m-d');
            }
        }

        return view('expired_list', ['Organizations' => $list_data, 'expired_dates' => $expired_date_list]);
    }

    public function get_site_info(Request $request)
    {
        $subdomain = $request->input('subdomain');
        $result = Organizations::where('subdomain', $subdomain)->first();
        return response()->json(['result' => $result]);
    }

    public function dateDifferenceNow($date)
    {
        $datetime1 = date_create(date('Y-m-d H:i:s'));
        $datetime2 = date_create($date);

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format('%a');
    }

}
