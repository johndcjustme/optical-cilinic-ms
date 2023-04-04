<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use App\Models\User_activity;

class PageDashboardUserActivity extends Component
{
    public function render()
    {
        return view('livewire.pages.page-dashboard-user-activity', [
            'user_activities' => User_activity::with('user')->whereDate('created_at', today())
                ->latest()
                ->limit(10)
                ->get()
        ]);
    }
}
