<?php
use Illuminate\Support\Facades\DB;
use App\Helper\Request\CurlRequest;
use App\User;
use App\User\Site\AccountType;
use App\User\SmartWallet;

if (! function_exists('getPasswordGrantId')) {
    /**
     * Get the password for the password grant.
     *
     * @param  mixed  $value
     * @return bool
     */
    function getPasswordGrantId()
    {
        return DB::table('oauth_clients')
        ->where('password_client', 1)
        ->latest()->first();
    }
}

if (! function_exists('curl')) {
    /**
     * Make Curl Request.
     *
     * @param  null
     * @return object
     */
    function curl()
    {
        return new CurlRequest();
    }
}

function site_url(){
    return (env('APP_ENV') !== 'local') ? env('APP_URL') : env('APP_DEV_URL');
} 

if(! function_exists('generateSmartWallet')){
    /**
     * Return A unqiue Wallet for the registered user
     * @param object $user
     * @return  object 
     */
    function generateSmartWallet($user){
        return SmartWallet::createWallet($user);
    }
}
/**
 * Generate 10 Characters, 7 Random Number and 
 * 2 Fixed Integer to be use as Bank Account Number 
 * @return integer
 */
function generateRandomNumber(){
    return isValidAccountNumber('06'.rand(00000000, 99999999));
}

/** Validate the Account Number 
 * @return integer a Valid account Number 
*/
function isValidAccountNumber($value){
    if(strlen($value) !== 10 || SmartWallet::wallet_exists($value) !== null){
        return generateRandomNumber();
    }
    return $value;
}

/** 
 * Create a Unique Signature for the User using his Name
 * @param object @user
 * @return string a hash $short
*/
function signature($user){
    $short = substr(hash('sha256', (encrypt($user->name))), 12);
    return str_limit($short, 24 , '');
}

if(! function_exists('jsonResponse')){
    /**
     * Return a Json response 
     *
     * @param  array $body
     * @param int $code
     * @return object
    */
    function jsonResponse($body=[], $code=200 ){
        return response()->json($body,$code);
    }
}

if(! function_exists('SavingId')){
    /**
     * Generate A random Hash
     * Return a String response 
     * 
     * @param string $type
     * @return object
    */
    function SavingId($type){
        return uniqid((string)$type);
    }
}

if(! function_exists('getAccountType')){
    function getAccountType($attribute){
        return AccountType::getAccountType($attribute);
    }
}

if(! function_exists('getBonus')){
    function getBonus($attribute){
       return AccountType::getBonus($attribute);
    }
}

if (! function_exists('getEmailProperty')) {
    /** 
     * Returns an object of the Email Property 
     * Base on the type
     * @param string $type
     * @param integer $amount
     * @return object
     */
    function getEmailProperty($type, $amount = null){
        return (object) [
            'amount' => $amount,
            'subject' => config('email.'.$type.'.subject'),
            'message' => config('email.'.$type.'.message'),
        ];
    }
}

    
if (! function_exists('message')) {
    /**
     * Helper to grab the application messages.
     *
     * @return mixed
     */
    function message($value)
    {
        return config('messages.'.$value);
    }
}

if(! function_exists('user')){
    /**
     * User function go get the logged in user through the 
     * request object of by an email or given parameter
    */
    function user($email=null, $id=null, $username=null){
        if(!($email && $id && $username) && request()->user()){
            return request()->user();
        }
        if($email && User::where('email', $email)->first() !== null){
            return User::where('email', $email)->first();
        }
        
        if($id && User::where('id', $id)->first() !== null){
            return User::where('id', $id)->first();
        }
        
        if($username && User::where('username', $username)->first() !== null){
            return User::where('username', $username)->first();
        }
    }
}

if(! function_exists('validateWithdrawal')){
    function validateWithdrawal(object $request){
        $account_type = AccountType::getAccountType($request->account_type);
        return user()->validateWithdrawal($request->amount, $account_type);
    }
}

if(!function_exists('validateAmount')){
    /**
     * Check if the requested amount is available for 
     * the user to withdraw from said table
     * @param Int $amount to be validated
     * @param String $table to be checked
     * @return Boolean true|false
    */
    function validateAmount($amount, $table, $field){
        $c_b = DB::table("{$table}")->where('user_id', user()->id)->get()->sum("{$field}"); 
        if($amount <= $c_b){
            return true;
        }
        return false;
    }

}

if (! function_exists('invalidRequest')) {
    /**
     * Returns Error message with the given message 
     * the user to withdraw from said table
     * @param String $message to be returned
     * @return Object Illuminate\Response
    */
    function invalidRequest($message)
    {
        return jsonResponse([
            'message' => $message
        ]);
    }
}

if(! function_exists('generateTransferId')){
    /**
     * This generate A unique Id base on the time unix 
     * @return String uniqid()
    */
    function generateTransferId():string{
        return uniqid(true);
    }
}

if(!function_exists('getUserById')){
    /**
     * This get a user by Id 
     * @param Int $uuid 
     * @return Object \App\User
    */
    function getUserById(Int $uuid):object{
        return User::findOrFail($uuid);
    }
}