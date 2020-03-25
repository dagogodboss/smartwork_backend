<?php

namespace App\User\Traits\Functions;


/**
 * Contact Function traits
 */
trait ContactFunction{

    public function add_toContact(Bool $isContact = null, Int $contact):bool{
        return ($isContact) ? $this->contact->create(['contact_id' => $contact]) : false; 
    }
}
