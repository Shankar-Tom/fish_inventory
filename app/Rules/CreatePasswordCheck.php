<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CreatePasswordCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public  $allowed;
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
    
        $this->allowed=['!','@','#','$','%','&','*'];
        foreach($this->allowed as $allowe)
        {
            if(strpos($value, $allowe)){
              return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Password must contain any of these (! ,@ ,# ,$ ,% ,& ,*) special character ";
    }
}
