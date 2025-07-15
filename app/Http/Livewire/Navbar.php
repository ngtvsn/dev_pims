<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public $unreadNotificationsCount;
    public $unreadNotifications;

    protected $listeners = ['notificationRead' => 'mount', 'postCreated' => 'mount', 'commentAdded' => 'mount'];

    public function mount()
    {
        if (Auth::check()) {
            $this->unreadNotificationsCount = Notification::where('user_id', Auth::id())
                ->whereNull('read_at')
                ->count();

            $this->unreadNotifications = Notification::where('user_id', Auth::id())
                ->whereNull('read_at')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $this->unreadNotificationsCount = 0;
            $this->unreadNotifications = collect();
        }
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification && $notification->user_id == Auth::id()) {
            $notification->update(['read_at' => now()]);
            $this->emit('notificationRead');
            return redirect()->to(route('home', ['post' => $notification->data['post_id']]));
        }
    }

    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
        $this->emit('notificationRead');
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
