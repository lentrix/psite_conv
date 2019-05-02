<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class VoteCountRule implements Rule
{
    private $limit;
    private $count;
    private $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->limit = \App\Election::getActive()->max_votes;
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

        $this->count = count($value);

        if($this->count>$this->limit) {
            $this->message = "Your votes ($this->count) exceeded the limit of ($this->limit).";
            return false;
        }else {
            return true;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
