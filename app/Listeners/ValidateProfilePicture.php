<?php

namespace App\Listeners;

class ValidateProfilePicture
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        dd($event->user);
        if (filled($event->user) && $event->user->profile_picture_url == null) {
            $event->user->update([
                'profile_picture_url' => 'https://avatar.vercel.sh/'.$event->user->email,
            ]);
        }
    }
}
