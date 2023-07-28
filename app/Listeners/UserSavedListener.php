<?php

namespace App\Listeners;

use App\Events\UserSavedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Detail;
use App\Models\User;

class UserSavedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSavedEvent $event): void
    {
        $user = $event->user;

        $this->saveDetail('Full name', $user->fullname, $user->id);
        $this->saveDetail('Middle Initial', $user->inital, $user->id);
        $this->saveDetail('Avatar', $user->photo, $user->id);
        $this->saveDetail('Gender', $user->gender, $user->id);
    }

    /**
     * Create a user detail.
     * TODO: Refactor to repository so that it can be reused if details get saved another way
     *
     * @param string $key
     * @param string $value
     * @param string $userId user the detail belongs to
     */
    private function saveDetail($key, $value, $userId)
    {
        Detail::create([
            'key' => $key,
            'value' => $value,
            'type' => 'bio',
            'user_id' => $userId,
        ]);
    }
}
