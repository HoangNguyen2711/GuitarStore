<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Http\Request;

class UserObserver
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\user  $user
     * @return void
     */
    public function created(User $user)
    {
        
        if (!isset($this->request->role_ids)) {
            $user->roles()->attach(9);
        }
    }
}