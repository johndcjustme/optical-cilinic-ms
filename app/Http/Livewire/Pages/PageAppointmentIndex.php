<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Appointment;

use App\Traits\WithSorting;
use App\Traits\SharedVariables;
use App\Traits\Modal;
use App\Traits\Categories;


class PageAppointmentIndex extends Component
{
    use WithSorting;
    use SharedVariables;
    use Modal;
    use WithPagination;
    use Categories;

    public $patients = [];

    protected $listeners = [
        'deleted_appts','update_status'
    ];

    public function render()
    {
        $data = [
            'appointments' => Appointment::with(['patient'])->orderBy('status')->simplePaginate()
        ];

        return view('livewire.pages.page-appointment-index', $data);
    }

    public function confirm_update_status($status_value)
    {
        return "onclick=\"if (confirm('Update Appointment Status?')) Livewire.emit('update_status', '{$status_value}');\"";
    }

    public function update_status($status_value)
    {
        if ($this->hasPermission('patient-appointment-manage'))
            return;

        try {
            foreach ($this->selected_items as $selected) 
                Appointment::where('id', $selected)->update(['status' => $status_value]);
            
            $this->toast('success', 'Appointment status has been updated successfully.');
            $this->selected_items = [];
        } catch (\Exception $wtf) { dd($wtf); $this->toastError(); }
    }

    public function deleting_appts()
    {
        return $this->confirmDialog('deleted_appts', 'Are you sure you want to delete selected appointment(s)?');
    }

    public function deleted_appts()
    {
        if ($this->hasPermission('patient-appointment-manage'))
            return;
        try {
            Appointment::destroy($this->selected_items);
            $this->toast('success', 'Selected appointments has been deleted successfully.');
        } catch(\Exception $wtf) { $this->toastError(); }
    }
}
