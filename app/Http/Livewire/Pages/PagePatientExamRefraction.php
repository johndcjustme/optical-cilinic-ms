<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use Illuminate\Support\Str;

use App\Models\Refraction;
use App\Models\Order_item;
use App\Models\Tint;

use App\Traits\Modal;

class PagePatientExamRefraction extends Component
{
    use Modal;

    // allocate "should_render", try also by assigning id to confirm dialog


    public 
        $patient_id = '',
        // $should_render = true,

        $all_refractions = 0,
        $view_refractions = false,

        $delete_refraction_id,

        $rf = [
            'patient_id',
            'refraction_id' => '',
            'OD_SPH'        => '',
            'OD_CYL'        => '',
            'OD_AXIS'       => '',
            'OD_NVA'        => '',
            'OD_PH'         => '',
            'OD_CVA'        => '',
            'OS_SPH'        => '',
            'OS_CYL'        => '',
            'OS_AXIS'       => '',
            'OS_NVA'        => '',
            'OS_PH'         => '',
            'OS_CVA'        => '',
            'ADD'           => '',
            'PD'            => '',
            'remarks'       => '',
            'frame'         => '',
            'lense'         => '',
            'tint'          => '',
            'particulars'   => '',
            'created_at'    => ''
        ];

        // $lens = [
        //     'type' => '',
        //     'quantity' => ''
        // ];

        // $confirm = [
        //     'create_refraction' => false,
        //     'update_refraction' => false,
        //     'delete_refraction' => false,
        // ];

    protected $listeners = [
        'create_refraction',
        // 'create_lense_order',
        'update_refraction',
        'delete_refraction',
        'refraction_id'
    ];

    public function mount()
    {
        $this->all_refractions = Refraction::select('id')->where('patient_id', $this->patient_id)->count();
        $this->all_refractions < 1
            ? $this->all_refractions = '(0)'
            : $this->all_refractions = $this->all_refractions;

        $this->display_latest_exam();
    }

    public function refraction_id()
    {
        return $this->rf['refraction_id'];
    }

    public function render()
    {
        return view('livewire.pages.page-patient-exam-refraction', ['tints' => Tint::all()]);
    }

    public function creating_refraction()
    {
        return $this->confirmDialog('create_refraction', 'Are you sure you want to create new refraction?');
    }

    
    public function create_refraction()
    {
        if ($this->hasPermission('patient-exam-manage'))
            return;

        try {
            Refraction::create([
                'id' => $this->generate_custom_refraction_id(),
                'patient_id' => $this->patient_id,
            ]);
            $this->toast('success', 'Refraction has been created.');       
        } catch (\Exception $wtf) {
            $this->toastError();
        }
        $this->display_latest_exam();
        $this->mount();            
        $this->emit('mount', $this->rf['refraction_id']);
    }

    public function updating_refraction()
    {
        return "onclick=\"return confirm('Are you sure you want to save changes?')\"";
    }

    public function update_refraction()
    {
        if ($this->hasPermission('patient-exam-manage'))
            return;

        try {      
            Refraction::findOrFail($this->rf['refraction_id'])->update([
                'OD_SPH'      => $this->rf['OD_SPH'],
                'OD_CYL'      => $this->rf['OD_CYL'],
                'OD_AXIS'     => $this->rf['OD_AXIS'],
                'OD_NVA'      => $this->rf['OD_NVA'],
                'OD_PH'       => $this->rf['OD_PH'],
                'OD_CVA'      => $this->rf['OD_CVA'],
                'OS_SPH'      => $this->rf['OS_SPH'],
                'OS_CYL'      => $this->rf['OS_CYL'],
                'OS_AXIS'     => $this->rf['OS_AXIS'],
                'OS_NVA'      => $this->rf['OS_NVA'],
                'OS_PH'       => $this->rf['OS_PH'],
                'OS_CVA'      => $this->rf['OS_CVA'],
                'ADD'         => $this->rf['ADD'],
                'PD'          => $this->rf['PD'],
                'frame'       => $this->rf['frame'],
                'lense'       => $this->rf['lense'],
                'tint'        => $this->rf['tint'],
                'remarks'     => $this->rf['remarks'],
                'created_at'  => $this->rf['created_at'],
            ]);
            $this->toast('success', 'Refraction has been saved.');   
        } catch (\Exception $wtf) { $this->toastError(); }
    }

    public function deleting_refraction($rf_id)
    {
        return "onclick=\"if (confirm('Are your sure you want to delete this refraction?')) Livewire.emit('delete_refraction','{$rf_id}');\"";
    }

    public function delete_refraction($rf_id)
    {   
        if ($this->hasPermission('patient-exam-manage'))
            return;

        try {
            $rf = Refraction::destroy($rf_id);
            $this->toast('success', 'Refraction has been successfully deleted.');            
        } catch (\Exception $wtf) { $this->toastError(); }

        $this->mount();
        $this->emit('mount', $this->rf['refraction_id']);
    }

    private function display_latest_exam($exam_id = null)
    {
        $rf = Refraction::where('patient_id', $this->patient_id)->latest()->first();
        if ($rf) {
            $this->rf['refraction_id']  = $rf->id;
            $this->rf['OD_SPH']         = $rf->OD_SPH;
            $this->rf['OD_CYL']         = $rf->OD_CYL;
            $this->rf['OD_AXIS']        = $rf->OD_AXIS;
            $this->rf['OD_NVA']         = $rf->OD_NVA;
            $this->rf['OD_PH']          = $rf->OD_PH;
            $this->rf['OD_CVA']         = $rf->OD_CVA;
            $this->rf['OS_SPH']         = $rf->OS_SPH;
            $this->rf['OS_CYL']         = $rf->OS_CYL;
            $this->rf['OS_AXIS']        = $rf->OS_AXIS;
            $this->rf['OS_NVA']         = $rf->OS_NVA;
            $this->rf['OS_PH']          = $rf->OS_PH;
            $this->rf['OS_CVA']         = $rf->OS_CVA;
            $this->rf['ADD']            = $rf->ADD;
            $this->rf['PD']             = $rf->PD;
            $this->rf['frame']          = $rf->frame;
            $this->rf['lense']          = $rf->lense;
            $this->rf['tint']           = $rf->tint;
            $this->rf['remarks']        = $rf->remarks;
            $this->rf['created_at']     = $rf->created_at;

            // if (!is_null($rf->order)) {
            //     $this->lens['type'] = $rf->order->name;
            //     $this->lens['quantity'] = $rf->order->quantity;
            // }
        } else { $this->rf['refraction_id'] = ''; }
    }


    
    public function detalist($input_list, $from_value, $to_value, $step_value) {
        $datalist = "<datalist id=\"{$input_list}\">";

        for ($i=$from_value; $i < $to_value; $i+=$step_value) 
            $datalist .= "<option value=\"+{$i}\">"; 

        for ($i=$from_value; $i < $to_value; $i+=$step_value) 
            $datalist .= "<option value=\"-{$i}\">"; 

        return $datalist .= "</datalist>";
    }


    public function creating_purchase($refraction_id)
    {
        return "onclick=\"if (confirm('Create purchase with exam reference ID \'{$refraction_id}\'. Continue?')) return Livewire.emit('create_purchase','{$refraction_id}');\"";
    }

    // public function creating_lens_order() 
    // {
    //     return "onclick=\"return confirm('Save Lens Order?')\"";
    // }

    // public function create_lens_order($refraction_id)
    // {
    //     $this->validate([
    //         'lens.type' => 'required',
    //         'lens.quantity' => 'required|min:1'
    //     ]);

    //     $lens_category_id = 1;

    //     try {
    //         Order_item::updateOrCreate([
    //             'patient_id' => $this->patient_id,
    //             'refraction_id' => $refraction_id,
    //             'category_id' => $lens_category_id,
    //         ], [
    //             'name' => $this->lens['type'],
    //             'quantity' => $this->lens['quantity'],
    //         ]);

    //         $this->reset(['lens']);
    //         $this->mount();
    //         $this->toast('success', 'Order has been successfully Saved.');
    //     } catch (\Exception $wtf) { $this->toastError(); }
    // }

    // public function has_order_quantity()
    // {
    //     $quantity = $this->lens['quantity'];

    //     if (empty($quantity))
    //         return;

    //     return '- ' . $quantity;
    // }

    private function generate_custom_refraction_id() 
    {
        return Str::replace('-', '', Str::replace(' ', '', Str::replace(':', '', now())));
    }

}

