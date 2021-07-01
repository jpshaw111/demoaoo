<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function curl_handler($page, $start) {
        $url            = 'https://www.balldontlie.io/api/v1/players?per_page='.$page.'&page='.$start;
        $headers = array(
            "Accept: application/json",
         );
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST  , 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER , 1);
        return $ch;
    }
    public function userDashboard(Request $request) {
        $page = $request->input('per_page');
        $start = $request->input('page');
        if(empty($page)) {
            $page= 5;
            $start=0;
        } else {
            
        }
        $ch = $this->curl_handler($page, $start);
        $result = curl_exec($ch);
        $data = array();
        $http_status = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr( $result, 0, $http_status );
        $body = substr( $result, $http_status);
        if ($result === false) {
            $success = false;
            $error = 'Curl error: '.curl_error($ch);
        } else {
           
            $response_array = json_decode($body, true);
            $data = $response_array;
        }

        
       return view('dashoard', ['data' => $data]);
    }

    public function curlFilter() {
        $url            = 'https://www.balldontlie.io/api/v1/players?search=Jordan';
       
       
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        $headers = array(
            "Accept: application/json",
         );
         curl_setopt($ch, CURLINFO_HEADER_OUT, true);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST  , 'GET');
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
         curl_setopt($ch, CURLOPT_HEADER , 0);
         return $ch;
    }

    public function getUserFilter() {
        $ch = $this->curlFilter();
        //execute post
        $result = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($result === false) {
            $success = false;
            $error = 'Curl error: '.curl_error($ch);
        } else {
            $response_array = json_decode($result, true);
            $data = $response_array;
        }

        return view('dashoard', ['data' => $data]);
    }
}
