<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\User;

class PageDashboardGeneral extends Component
{
    public $general = [];


    public function mount(Patient $pts, Appointment $appts, User $users)
    {
        $pts_all = $pts->select('id')->count();
        $pts_span = $this->span_value($pts->select('created_at')->whereDate('created_at', today())->count()) . $this->span_title('new today');

        $appts_all = $appts->select('id')->count();
        $appts_span = $this->span_value($appts->select('date')->whereDate('date', today())->count()) . $this->span_title('appt(s) today');

        $users_all = $users->select('id')->count();

        $this->general = [
            [
                'title' => 'All Patients',
                'icon'  => 'bi bi-people',
                'value' => $pts_all,
                'span'  => $pts_span
            ], [
                'title' => 'All Appointments',
                'icon'  => 'bi bi-calendar-check',
                'value' => $appts_all,
                'span'  => $appts_span
            ], [
                'title' => 'All Users',
                'icon'  => 'bi bi-person',
                'value' => $users_all,
                'span'  => ''
            ]
        ];
    }

    public function span_value($value) {
        return "<span class=\"text-success small pt-1 fw-bold\">{$value}</span>";     
    }

    public function span_title($title){
        return "<span class=\"text-truncate text-muted small pt-2 ps-1\">{$title}</span>";
    }

    public function render()
    {
        return view('livewire.pages.page-dashboard-general');
    }


}
