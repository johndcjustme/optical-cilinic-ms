<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

use App\Traits\Modal;
use App\Traits\Categories;
use App\Traits\UserActivities;

class PagePatientIndexModal extends Component
{
    use Modal;
    use Categories;
    use UserActivities;

    // make appointment available to reset
    // override modal_show method

    public $name;

    public $pt = [
            'id'   => '',
            'name' => '',
            'age'  => '',
            'gender',
            'is_member' => false,
            'address',
            'occupation',
            'mobile_1',
            'mobile_2',
            'email',
            'purpose',
            'status',
            'queue' => 0,
            'date_queue',
            'appointment_date' => '',
            'created_at'
        ];

    protected $listeners = ['modal_show', 'edit'];

    public function render()
    {
        return view('livewire.pages.page-patient-index-modal');
    }


    public function modal_show()
    {
        $this->reset(['pt']);
        $this->resetValidation();
        $this->pt['created_at'] = date("Y-m-d");
        $this->modal('show');
    }


    public function edit($id)
    {
        try {
            if ($id != null) {
                $patient = Patient::findOrFail($id);
                $this->pt['id']         = $id;
                $this->pt['name']       = $patient->name;
                $this->pt['age']        = $patient->age;
                $this->pt['gender']     = $patient->gender;
                $this->pt['address']    = $patient->address;
                $this->pt['occupation'] = $patient->occupation;
                $this->pt['mobile_1']   = $patient->mobile_1;
                $this->pt['mobile_2']   = $patient->mobile_2;
                $this->pt['email']      = $patient->email;
                $this->pt['purpose']    = $patient->purpose;
                $this->pt['status']     = $patient->status;
                $this->pt['queue']      = $patient->queue;
                $this->pt['is_member']      = $patient->is_member;
                $this->pt['appointment_date'] = $patient->appointment->date ?? null;
                $this->pt['created_at'] = \Carbon\Carbon::parse($patient->created_at)->format("Y-m-d");

                $this->resetValidation();
                $this->modal('show');
            }
        } catch(\Exception $wtf) { $this->toastError(); }
    }


    public function create_or_update()
    {
        if ($this->hasPermission('patient-manage')) 
            return;
        
        $this->validate_first();
        empty($this->pt['id'])
            ? $this->create()
            : $this->update();
    }

    private function validate_first()
    {
        $this->validate([
            'pt.name' => 'required|min:2|max:150',
            'pt.age' => 'required',
            'pt.gender' => 'required',
            'pt.email' => 'nullable|email',
            // 'pt.appointment_date' => 'nullable|date|after_or_equal:' . date('Y-m-d')
            'pt.appointment_date' => 'nullable|date'
        ], [
            'pt.name.required' => 'Required field',
            'pt.name.min' => 'At least 2 chars',
            'pt.name.max' => 'Maximum of 150 chars',

            'pt.age.required' => 'Required field',
            'pt.age.numeric' => 'Must be a number',

            'pt.gender.required' => 'Required field',

            'pt.email.email' => 'Must be a valid email',

            'pt.appointment_date.date' => 'Invalid date',
            'pt.appointment_date.after_or_equal' => 'Invalid date'
        ]);
    }

    private function setPatient()
    {
        return [
            'id'            => $this->pt['id'],
            'name'          => $this->pt['name'],
            'age'           => $this->pt['age'],
            'gender'        => $this->pt['gender'] ?? null,
            'address'       => $this->pt['address'] ?? null,
            'occupation'    => $this->pt['occupation'] ?? null,
            'mobile_1'      => $this->pt['mobile_1'] ?? null,
            'mobile_2'      => $this->pt['mobile_2'] ?? null,
            'email'         => $this->pt['email'] ?? null,
            'status'        => $this->pt['status'] ?? null,
            'purpose'       => $this->pt['purpose'] ?? null,
            'queue'         => $this->pt['queue'],
            'date_queue'    => now() ?? null,
            'is_member'     => $this->pt['is_member'],
            'created_at'    => $this->pt['created_at'] ?? now(),
        ];
    }

    private function create()
    {
        try {           
            $patient = Patient::create($this->setPatient());

            $this->trait_user_activity_patient_create();

            $this->create_appointment($patient->id, $this->pt['appointment_date']);
            $this->modal('close');
            $this->resetValidation();
            $this->reset(['pt']);
            $this->toast('success', 'Patient has been added successfully.');
        } catch(\Exception $wtf) { $this->toastError(); }
    }

    private function update()
    {
        try {
            Patient::findOrFail($this->pt['id'])->update($this->setPatient());

            $this->trait_user_activity_patient_update();

            $this->create_appointment($this->pt['id'], $this->pt['appointment_date']);
            $this->modal('close');
            $this->reset(['pt']);
            $this->resetValidation();
            $this->emit('refreshPatientIndex');
            $this->toast('success', 'Patient has been updated successfully.');
        } catch(\Exception $wtf) { $this->toastError(); }
    }

    private function create_appointment($patient_id, $appointment_date)
    {
        if ($this->hasPermission('patient-appointment-manage'))
            return;

        try {
            // if (!empty($appointment_date) && ($appointment_date > date('Y-m-d', strtotime('-1 days')))) {
            if (!empty($appointment_date)) {
                $appointment = Appointment::updateOrCreate([
                        'patient_id' => $patient_id,
                        'status' => 1,
                    ], [
                        'patient_id' => $patient_id,
                        'date' => $appointment_date,
                        'status' => 1,
                    ]);

                $this->trait_user_activity_patient_appointment_create();
                
            } else { $this->toastError(); }
        } catch(\Exception $wtf) { $this->toastError(); }
    }
}
