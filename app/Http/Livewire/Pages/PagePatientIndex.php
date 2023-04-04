<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use App\Models\Patient;
use App\Models\Appointment;
use App\Http\Livewire\Interfaces\IPatient;

use App\Traits\WithSorting;
use App\Traits\SharedVariables;
use App\Traits\Modal;
use App\Traits\WithFilter;
use App\Traits\UserActivities;
use App\Traits\Categories;

use Livewire\WithPagination;


class PagePatientIndex extends Component
{
    use WithSorting;
    use SharedVariables;
    use Modal;
    use WithPagination;
    use WithFilter;
    use UserActivities;
    use Categories;

    // add sorting, 
    //     today, 
    //     yesterday, 
    //     this week, 
    //     last week, 
    //     this, month, 
    //     last month, 
    //     this year, 
    //     last year,

    public 
        $patient_exam_id,
        $filter_pt,
        $queue_list_search = '',
        $queue_list_done_search = '',
        //remove later
        // $ready_for_exam_search = '',
        // $ready_for_payment_search = '',
        //end remove later
        $is_add_to_appointment = false,
        $is_add_to_today = false,

        $pt = ['id'   => ''];

        // $delete = [
        //     'subject' => false,
        //     'patient' => false,
        //     'patients' => false,
        // ];
        
    protected
        $listeners = ['refreshPatientIndex' => '$refresh', 'deleted_multiple'],
        $queryString = ['patient_exam_id' => ['except' => '']];


    public function mount()
    {
        $this->orderBy = 'name';

        // if currentPage 'today' is empty redirect to 'patient_list' 
        Patient::where('queue', [1,2])->count() <= 0 && $this->currentPage != 'patient_exam'
            ? $this->currentPage = 'patient_list'
            : null;

        // available filters: today, yesterday, this_week, last_week, this_month, last_month, this_year, last_year.
        $this->setDefaultFilter('this_year');
    }
    
    public function render()
    {
        $data = [];
        if ($this->currentPage == 'patient_list') {
            $patients = Patient::with(['appointment' => function ($query) { $query->select('patient_id'); }])
                        ->where('name', 'like', "%$this->search%");

            if (empty($this->search)) 
                $this->withFilter($patients);
            
            $data += [ 
                'patients' => $patients->orderBy($this->orderBy, $this->sortDirection)->simplePaginate($this->paginate),
                'count_patients' => $this->count_patients()
            ];

        } else {
            $data += [
                // 'ready_for_exam' => $this->ready_for_exam_patients(),
                // 'ready_for_payment' => $this->ready_for_payment_patients(), 
                'queue_list' => $this->queue_list(),
                'queue_list_done' => $this->queue_list_done()
            ];
        }

        return view('livewire.pages.page-patient-index', $data);
    }

    public function count_patients()
    {
        $patients = Patient::select('id');
        $count_filtered_patient = $this->withFilter($patients) ?? [];
        
        if ($count_filtered_patient) 
            return $count_filtered_patient->count(); 
        
        return;
    }

    public function updatedSearch()
    {
        !empty($this->search) && $this->currentPage == ''
            ? $this->currentPage = 'patient_list'
            : null;
    }
    
    private function queue_list() {
        return $this->queue_list_patients(null, $this->queue_list_search);
    }

    private function queue_list_done() {
        return $this->queue_list_patients(1, $this->queue_list_done_search);
    }

    private function queue_list_patients($queue_status, $with_search)
    {
        return Patient::select(['id', 'name', 'address', 'purpose', 'queue_status', 'date_queue'])
            ->where('name', 'like', "%$with_search%")
            ->where('date_queue','!=',null)
            ->where('queue_status', $queue_status)
            ->orderBy('date_queue')
            ->get();
    }

    // private function ready_for_exam_patients() { return $this->payment_and_exam_patients(1, $this->ready_for_exam_search); }

    // private function ready_for_payment_patients() { return $this->payment_and_exam_patients(2, $this->ready_for_payment_search); }

    // private function payment_and_exam_patients($queue_num, $with_search)
    // {
    //     return Patient::select(['id', 'name', 'address', 'purpose', 'occupation', 'queue_status', 'queue', 'date_queue'])
    //         ->where('name', 'like', "%$with_search%")
    //         ->where('queue', $queue_num)
    //         ->orderBy('date_queue')
    //         ->get();
    // }



    // public function delete($id = null, $subject = null)
    // {
    //     if (is_null($id)) {
    //         $this->delete['patients'] = true;
    //         $this->confirmation('show', 'Delete Patient', 'Are you sure you want to delete selected patients?');
    //     } else {
    //         $this->pt['id'] = $id;
    //         $this->delete['patient'] = true;
    //         $this->delete['subject'] = $subject;
    //         $this->confirmation('show', 'Delete Patient', 'Are you sure you want to delete "' . $subject . '"?');
    //     }
    // }

    // private function deleted() 
    // {
    //     try {
    //         $patient = Patient::destroy($this->pt['id']);
    //         $this->confirmation('close');
    //         $this->toast('success', '"' . $this->delete['subject'] . '" has been successfully deleted.');
    //         $this->reset(['pt', 'delete']);
    //     } catch (\Exception $wtf) { $this->toastError(); }
    // }

    public function deleting_patients()
    {
        return $this->confirmDialog('deleted_multiple', 'Are you sure you want to delete selected patient(s)?');
    }

    public function deleted_multiple() 
    {
        if ($this->hasPermission('patient-delete')) 
            return;

        try {
            Patient::destroy($this->selected_items);

            $this->trait_user_activity_patient_delete();
            
            $this->confirmation('close');
            $this->toast('success', 'Selected patients has been deleted successfully.');
            $this->reset(['pt', 'selected_items']);
            $this->resetPage();
        } catch(\Exception $wtf) { $this->toastError(); }
    }

    // public function confirm()
    // {
    //     ! $this->delete['patient'] 
    //         ?: $this->deleted();
    //     ! $this->delete['patients']
    //         ?: $this->deleted_multiple();
    // }

    public function reset_filter()
    {
        $this->reset(['filter']);
    }

    // public function ready_for_payment($patient_id) 
    // {
    //     try {
    //         Patient::select(['id','queue','date_queue'])->findOrFail($patient_id)
    //             ->update(['queue' => 2, 'date_queue' => now()]);    
    //     } catch (\Exception $wtf) { $this->toastError(); }
    // }

    // public function ready_for_exam($patient_id) 
    // {
    //     try {
    //         Patient::select(['id','queue','date_queue'])->findOrFail($patient_id)
    //             ->update(['queue' => 1, 'date_queue' => now()]);    
    //     } catch (\Exception $wtf) { $this->toastError(); }
    // }

    public function done($patient_id)
    {
        try {
            Patient::select(['id','queue_status'])->findOrFail($patient_id)
                ->update(['queue_status' => 1]);
        } catch (\Exception $wtf) { $this->toastError(); }
    }

    public function revert($patient_id) 
    {
        try {
            Patient::select(['id','queue_status'])->findOrFail($patient_id)
                ->update(['queue_status' => null]);
        } catch (\Exception $wtf) { $this->toastError(); }
    }

    public function hide($patient_id) 
    {
        try {
            Patient::select(['id','queue_status','date_queue'])->findOrFail($patient_id)
                ->update(['queue_status' => null, 'date_queue' => null]);
        } catch (\Exception $wtf) { $this->toastError(); }
    }

    // public function add_to_queue_list($patient_id) 
    // {
    //     try {
    //         Patient::select(['id','date_queue'])->findOrFail($patient_id)
    //             ->update(['date_queue' => null]);
    //     } catch (\Exception $wtf) { $this->toastError(); }
    // }

    public function patient_exam($patient_id)
    {
        $this->patient_exam_id = $patient_id;
        $this->currentPage = 'patient_exam';
    }

    // public function purpose($purpose_value) 
    // {
    //     foreach ($this->from_trait_pt_purpose as $purpose) {
    //         if ($purpose['value'] === $purpose_value)
    //             return $purpose['purpose'];
    //     }
    //     return;
    // }
}




