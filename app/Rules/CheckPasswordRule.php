<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;
class CheckPasswordRule implements Rule
{
    private $user;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        die($this->user->password . ":" . bcrypt($value));
        return strcmp(bcrypt($value), $this->user->password)===0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The password is incorrect.';
    }
}
