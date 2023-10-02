<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function show()
    {
        $notifications = Notification::paginate(10);

        return view('notifications.show', [
            'notifications' => $notifications
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->notification == null) {
            $notification = new Notification([
                'title' => $user->name . " želi da postane profesor.",
                'type' => 'request',
            ]);

            // Associate the notification with the logged-in user
            $user->notification()->save($notification);

            return redirect('/')->with('message', 'Zahtev je poslat.');
        }

        return redirect('/')->with('message', 'Već imate postojeći zahtev.');
    }

    public function destroy(Notification $notification)
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Unauthorized action');
        }

        $notification->delete();
        return redirect('/')->with('message', 'Zahtev odbijen.');
    }

    public function accept(Notification $notification){
        $user = User::find($notification->user_id);

        if (!$user) {
            abort(404, 'User not found');
        }
    
        $user->update(['role' => 'teacher']);
    
        $notification->delete();
    
        return redirect('/notifications/manage')->with('message', 'Korisniku je odobren zahtev.');
    }
}
