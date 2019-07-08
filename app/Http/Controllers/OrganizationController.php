<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Organizations;

class OrganizationController extends Controller
{
    public function request_curl($query)
    {
        $user = "root";
        $subuser = env("SUB_USER", "infomatic");
        $token = env("TOKEN", "FMZOX62DMP09TUU6HQBLH6ENODJTMK87");
        $curl = curl_init();
        $header[0] = "Authorization: whm $user:$token";
        $cpanel_url = env('CPANEL_URL', '192.232.229.113:2087');
        $query = "https://" . $cpanel_url . "/json-api/cpanel?cpanel_jsonapi_user=$subuser&cpanel_jsonapi_apiversion=2&" . $query;
        curl_setopt_array($curl, [
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_URL => $query
        ]);
        $result = curl_exec($curl);
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_status != 200) {
            return false;    //$http_status;
        } else {
            return $result;
        }
        curl_close($curl);
    }

    public function add(Request $request)
    {
        $data = $request->all();
        $domain = $data['domain'];
        $orgName = $data['orgName'];
        $subDomain = $data['subDomain'];

        $root_domain_option = trim($domain) == trim($subDomain) ? 1:0;

        $query = "cpanel_jsonapi_module=MysqlFE&cpanel_jsonapi_func=listdbs";
        $result = json_decode($this->request_curl($query));

        if(!$result){
            return response()->json(['error' => 'Some Error to access server']);
        }

        $fullDbName = $result->cpanelresult->data[0]->db;
        $prefix = explode("_", $fullDbName)[0];
        $s_name = preg_replace('/\s+/', '_', $orgName);
        if (!$result) {
            $dbName = $_name;
            // $dbUser = $data['dbUser'];
        } else {
            $dbName = $prefix . '_' . $s_name;
            // $dbUser = $prefix . '_' . $data['dbUser'];
        }
        
        // $dbPassword = $data['dbPassword'];
        $dbUser = env("DEFAULT_DB_USERNAME", "infomati_schools");
        $dbPassword = env("DEFAULT_DB_PASSWORD","schools123!@#");
        $subuser = env("SUB_USER", "infomats1");

        if($root_domain_option){

            $duplicate = Organizations::where('subdomain', $subDomain)->count();
            if ($duplicate) {
                return response()->json(['error' => 'Root Domain exist, please write down another name']);
            } else {
                $source_file = $_SERVER['DOCUMENT_ROOT'] . "/uploads/app.zip";
                $new_directory = '/home/public_html';

                $query = "cpanel_jsonapi_module=Fileman&cpanel_jsonapi_func=fileop&op=extract&sourcefiles=$source_file&destfiles=$new_directory&doubledecode=1&metadata=zip";
                $result = $this->request_curl($query);

                if (!$result) {
                    return response()->json(['error' => 'Something happened while creating the new Organization.']);
                } else {
                    $query = "cpanel_jsonapi_module=MysqlFE&cpanel_jsonapi_func=createdb&db=$dbName";
                    $result = $this->request_curl($query);
                    if (!$result) {
                        return response()->json(['error' => 'Something happend while creating database of the ' . $orgName]);
                    } else {
                        $query = "cpanel_jsonapi_module=MysqlFE&cpanel_jsonapi_func=setdbuserprivileges&db=$dbName&dbuser=$dbUser&privileges=ALL PRIVILEGES";
                        $result = $this->request_curl($query);
                        if (!$result) {
                            return response()->json(['error' => 'Something happend while assigning privileges to user of database']);
                        } else {
                            $info = Organizations::create([
                                'org_name' => $orgName,
                                'domain' => $domain,
                                'subdomain' => $domain,
                                'super_user' => $data['superAdminUsername'],
                                'super_password' => $data['superAdminPassword'],
                                'admin_user' => $data['adminUsername'],
                                'admin_password' => $data['adminPassword'],
                                'db_name' => $dbName,
                                'db_user' => $dbUser,
                                'db_password' => $dbPassword,
                                'created_by' => $data['created_by'],
                                'owner_name' => $data['owner_name'],
                                'sale_type' => $data['sale_type'],
                                'email' => $data['email']
                            ]);
                            return response()->json(['success' => $orgName . ' is created successfuly.']);
                        }
                    }
                }
            }

        }else {

            $duplicate = Organizations::where('subdomain', $subDomain)->count();
            if ($duplicate) {
                return response()->json(['error' => 'Sub domain is duplicated, please write down another name']);
            } else {
                // First create subdomain
                $query = "cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_func=addsubdomain&domain=$subDomain&rootdomain=$domain&dir=%2F$s_name&disallowdot=1";
                $result = $this->request_curl($query);
                if (!$result) {
                    return response()->json(['error' => 'Something happend while creating the subdomain.']);
                } else {
                    // Second move source package and extract zip into subdomain
                    $source_file = $_SERVER['DOCUMENT_ROOT'] . "/uploads/app.zip";
                    $new_directory = '/home/'.$subuser .'/'. $s_name;
                    $query = "cpanel_jsonapi_module=Fileman&cpanel_jsonapi_func=fileop&op=extract&sourcefiles=$source_file&destfiles=$new_directory&doubledecode=1&metadata=zip";
                    $result = $this->request_curl($query);
                    if (!$result) {
                        return response()->json(['error' => 'Something happened while creating the new Organization.']);
                    } else {
                        $query = "cpanel_jsonapi_module=MysqlFE&cpanel_jsonapi_func=createdb&db=$dbName";
                        $result = $this->request_curl($query);
                        if (!$result) {
                            return response()->json(['error' => 'Something happend while creating database of the ' . $orgName]);
                        } else {
                            $query = "cpanel_jsonapi_module=MysqlFE&cpanel_jsonapi_func=setdbuserprivileges&db=$dbName&dbuser=$dbUser&privileges=ALL PRIVILEGES";
                            $result = $this->request_curl($query);
                            if (!$result) {
                                return response()->json(['error' => 'Something happend while assigning privileges to user of database']);
                            } else {
                                $info = Organizations::create([
                                    'org_name' => $orgName,
                                    'domain' => $domain,
                                    'subdomain' => $subDomain . '.' . $domain,
                                    'super_user' => $data['superAdminUsername'],
                                    'super_password' => $data['superAdminPassword'],
                                    'admin_user' => $data['adminUsername'],
                                    'admin_password' => $data['adminPassword'],
                                    'db_name' => $dbName,
                                    'db_user' => $dbUser,
                                    'db_password' => $dbPassword,
                                    'created_by' => $data['created_by'],
                                    'owner_name' => $data['owner_name'],
                                    'sale_type' => $data['sale_type'],
                                    'email' => $data['email']
                                ]);
                                return response()->json(['success' => $orgName . ' is created successfuly.']);
                            }
                            // }
                        }
                    }
                }
            }   
        }

        
        
        
    }

    public function delete(Request $request)
    {
        $subdomain = $request->input('subdomain');
        $List = Organizations::where('subdomain', '=', $subdomain)->get()[0];

        $root_domain_option = $List->domain == $List->sub_domain?1:0;
        $result = true;

        $dbName = $List->db_name;   
        $orgName = $List->org_name;

        $subuser = env('SUB_USER', 'infomats1');

        if(!$root_domain_option){
            $query = "cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_func=delsubdomain&domain=$subdomain";
            $result = $this->request_curl($query);
        }
     
        if (!$result) {
            return response()->json(['error' => 'Something happend error while delete subdomain']);
        } else {
            $query = "cpanel_jsonapi_module=MysqlFE&cpanel_jsonapi_func=deletedb&db=$dbName";
            $result = $this->request_curl($query);
            if (!$result) {
                return response()->json(['error' => 'Something happend error while delete database']);
            } else {
                $domain = $List->domain;
                $directory = str_replace('.' . $domain, '', $subdomain);
                $sourcedirectory = '/home/'.$subuser.'/'. $directory;

                $query = "cpanel_jsonapi_module=Fileman&cpanel_jsonapi_func=fileop&op=unlink&sourcefiles=$sourcedirectory&doubledecode=1";
                $result = $this->request_curl($query);
                if (!$result) {
                    return response()->json(['error' => 'Something happend error while delete directory']);
                } else {
                    $result = Organizations::where('subdomain', '=', $subdomain)->delete();
                    if (!$result) {
                        return response()->json(['error' => 'Something happend error while delete table record']);
                    } else {
                        return response()->json(['success' => $orgName . ' is delete successfully.']);
                    }
                }
            }
        }
    }


    public function new()
    {
        if( Auth::user()->role < 2){
            return redirect()->route('home');
        }
        return view('new_organization');
    }

    public function suspend(Request $request)
    {
        $subdomain = $request->input('subdomain');
        $status = $request->input('status');

        $org = Organizations::where('subdomain', $subdomain)->get()[0];
        $subuser = env("SUB_USER", "infomats1");
        $root_domain = $org->domain;
        $directory = str_replace('.' . $root_domain, '', $subdomain);
        
        $redirect_dir = '/home/' . $subuser . '/suspended';
        $orign_dir = '/home/'.$subuser.'/'.$directory;


        if($status == '1'){
            $query = "cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_func=changedocroot&subdomain=$subdomain&rootdomain=$root_domain&dir=$orign_dir";
        }else{
            $query = "cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_func=changedocroot&subdomain=$subdomain&rootdomain=$root_domain&dir=$redirect_dir";
        }

        $result = $this->request_curl($query);

        if ($result) {
            $result = Organizations::where('subdomain', $subdomain)->update(['status' => $status]);
            if (!$result) {
                return response()->json(['error' => 'Something happend error while change status']);
            } else {
                return response()->json(['success' => 'Status changed successfully.']);
            }   
        } else {
            return response()->json(['error' => 'Somethin happend error while change status']);
        }

    }


}
