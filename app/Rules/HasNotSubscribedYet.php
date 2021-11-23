<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class HasNotSubscribedYet implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(public int $id)
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
        return DB::table('subscriptions')
            ->where('website_id', $this->id)
            ->where('user_id', $value)
            ->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'User is already subscribed to this website.';
    }
}
