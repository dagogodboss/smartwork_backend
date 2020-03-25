<?php
use GuzzleHttp\Client;
use App\User\Transactions\Savings;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/random', function (){
    for ($i=0; $i < 10; $i++) { 
        $short = substr(hash('sha256', (encrypt('$user->name'))), 12);
        dump([ 
            'Case Name' =>  $short,
   
            'Signature ' => str_limit($short, 24 , '')
        ]);  
    }
    
});

Route::get('/test', 'User\DashboardController@user');
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::post('/make-deposit', 'SavingsController@store');
// Route::get('/reason',function(){
//     $saving = new Savings();
//     return $saving->savingReasons();
// });
// Route::get('/login', function(){
//     return view('welcome');
// });
// Route::get('/dashboard', function(){
//     return view('welcome');
// });
// Route::get('/verification', function(){
//     return view('welcome');
// });
Route::get('/link/{uid}', function($uid){
    $user = \Auth::loginUsingId($uid);
    return $user->transfer_history();
    $zoe = [['name'=>'HorseWell', 'age' => 32, 'class' => 'Primary 1 A'], ['name'=>'HorseWell', 'age' => 32, 'class' => 'Primary 1 A']];
    $z = [];
    foreach ($zoe as  $value) {
        // var_dump($value);
        array_push($z, ['Age' => $value['age'], 'Class' => $value['class'],  'Name'=> $value['name']]);
        # code...
    }
    return ($z);
});

// return $user->withdraw((object)['savings_id' => null, 'initial_balance'=> 2000, 'current_balance' => 1500, 'amount' => 500, 'type' => 'general' ]);
// // ->checkAmount($user);
// echo "Dagogo";
// 
// $fields = [
    //     '%account%' => $user->smart_wallet->account_number,
    //     '%amount%' => 2000,
    //     '%balance%' => 3000,
    // ];
    // echo str_replace_array(['%account%, %amount%, %balance%'], $fields, config('email.transfer.message'));
    // foreach($fields as $field  => $value){
    //     dump(str_replace($field, $value, config('email.transfer.message')));
    //     // break 1;
    // }; 
    // die();
    // $data  = (object)[
    //    'greetings' => str_replace("%name%", $user->name, config('email.transfer.greeting')),
    //    'message' => $message,
    // ];
    // dump($data);