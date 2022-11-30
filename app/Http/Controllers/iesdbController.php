<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Http\Request;
use App\Models\User;

class iesdbController extends Controller
{
    public function iespush()
    {
        ini_set('display_errors', 1);
        $collect =  User::select('fullname', 'email' ,'location','country','assigned_gardener')
            ->where('is_customer', '=', 1)
            ->get()
            ->toArray();
        //echo "<pre>";
        //print_r($collect);
        //echo "</pre>";//die;

        if ($collect != null) {
            $country = 'NIGERIA';
            $premium = 5000;

                $engcap = $collect[0]['email'];
            }


            $data = array(

                "genClientCode" => "Y",
                "clientcode" => "",
                "isCooperate" => "N",
                "lname" => $collect[0]['fullname'],
                "address1" => $collect[0]['fullname'],
                "address2" => $collect[0]['fullname'],
                "country" => $country,
                "email" => $collect[0]['fullname'],
                "lphome" => $collect[0]['fullname'],
                "gsm" => $collect[0]['fullname'],
                "dob" => $collect[0]['fullname'],
                "gsmcb_agency" => $collect[0]['fullname'],
                "risktype" => "022-01",
                "startDate" => $collect[0]['fullname'],
                "endDate" => $collect[0]['fullname'],
                "insureval" => $premium,
                "desiredprem" => $premium,
                "branch" => "0525",
                "tcomm" => '0',
                "trnnet" => $collect[0]['fullname'],
                "tgross" => $collect[0]['fullname'],
                "covtype" =>$collect[0]['fullname'],
                "itemid" => $collect[0]['fullname'],
                "chasisnumb" => $collect[0]['fullname'],
                "itemdesc" => $collect[0]['fullname'],
                "vehtype" => $collect[0]['fullname'],
                "entdate" => $collect[0]['fullname'],
                "yearofmake" => $collect[0]['fullname'],
                "enginenumb" => $collect[0]['fullname'],
                "seats" => "0",
                "covtype" => "C",
                "vmodel" => $collect[0]['fullname'],
            );


           // $request = json_encode($data);
           // print_r($data);
            //print_r($request);
            $curl = curl_init();


            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://ies.royalexchangeplc.com/demo_general/api_ies/ies_connect.php?process=Processopenledapi&process_code=911',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer 39109f7df56e1Royal9e685066bb852',
                    'Cookie: PHPSESSID=78l565nbl126cde0m7185b4rc0'
                ),
            ));

            $response = curl_exec($curl);
        }
    }
