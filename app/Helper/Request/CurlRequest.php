<?php

namespace App\Helper\Request;

use Ixudra\Curl\Facades\Curl;

class CurlRequest{

	public function get($link, $header=null, $type=null){
		$response = Curl::to($link)
		->withHeaders([$header])
		->withContentType($type)
        ->get();
        return $response;
	}

	public function getWithData($link, $value = array(), $header=null, $type=null){
		$response = Curl::to($link)
        ->withData($value)
		->withHeaders([$header])
		->withContentType($type)
        ->get();
        return $response;
	}

	public function postWithData($link, $value = array(), $header=null, $type=null){
		$response = Curl::to($link)
        ->withData($value)
		->withHeaders([$header])
		->withContentType($type)
        ->post();
        return $response;
	}

	public function postJsonData($link, $value= array(), $header=null, $type=null){
		$response = Curl::to($link)
		->withData($value)
		->asJson()
		->withHeaders([$header])
		->withContentType($type)
		->post();
		return $response;
	}

	public function getasJson($link, $header=null, $type=null){
		$response = Curl::to($link)
        ->asJson()
		->withHeaders([$header])
		->withContentType($type)
        ->get();
        return $response;
	}

	public function getJsonData($link, $value  = array(), $header=null, $type=null){
		$response = Curl::to($link)
		->withData($value)
		->asJson()
		->withHeaders([$header])
		->withContentType($type)
		->get();
		return $response;
	}
}