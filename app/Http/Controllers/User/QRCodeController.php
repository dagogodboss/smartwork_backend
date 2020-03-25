<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QRCodeController extends Controller
{
    public function generateId(Request $request){
        $this->validate($request, [
            'amount' => 'required|numeric|min:1000',
            'img_link' => 'active_url',
            'product_name' => 'required|alpha',
            'description' => 'required|size:240'
        ]);
        // generateQrCode($request)
    }
}
