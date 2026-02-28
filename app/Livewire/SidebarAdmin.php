<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Livewire\Component;

class SidebarAdmin extends Component
{
    public $collapsed = false;
    public $unreadMessagesCount = 0;
    public $activeMenu = 'dashboard';

    protected $listeners = ['refreshUnreadCount' => 'refreshUnreadCount'];

    public function mount()
    {
        // Get sidebar state from session
        $this->collapsed = session('sidebar_collapsed', false);
        $this->refreshUnreadCount();
        
        // Set active menu based on current route
        $this->setActiveMenu();
    }

    public function refreshUnreadCount()
    {
        $this->unreadMessagesCount = ContactMessage::where('is_read', false)
            ->where('is_spam', false)
            ->count();
    }

    private function setActiveMenu()
    {
        $route = request()->route()->getName();
        
        if (str_contains($route, 'admin.skills')) {
            $this->activeMenu = 'skills';
        } elseif (str_contains($route, 'admin.projects')) {
            $this->activeMenu = 'projects';
        } elseif (str_contains($route, 'admin.contact')) {
            $this->activeMenu = 'messages';
        } elseif ($route === 'admin.home') {
            $this->activeMenu = 'dashboard';
        }
    }

    public function toggleSidebar()
    {
        $this->collapsed = !$this->collapsed;
        session(['sidebar_collapsed' => $this->collapsed]);
        
        // Dispatch event for other components
        $this->dispatch('sidebarToggled', $this->collapsed);
    }

    public function render()
    {
        return view('livewire.sidebar-admin');
    }
}
