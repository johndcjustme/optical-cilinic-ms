<x-layouts.main-content-index>
    
    @include('livewire.pages.includes.title-link-patient')

    @if ($this->currentPage != 'patient_exam')
      @include('livewire.pages.includes.options-patients-index')
      @livewire('pages.page-patient-index-modal')
    @endif

    @if ($this->currentPage == '')
        <x-layouts.main-content-content>
                @include('livewire.pages.page-patient-index-today', [
                    'title'                     => 'Queue',
                    'search_list'               => 'queue_list_search',
                    'queue_list_patients'       => $queue_list, 
                    'action_btn_goto_method'    => 'done', 
                    'action_btn_name'           => 'Done',
                    'action_btn_icon'           => 'bi-check',
                    'action_btn_class'          => 'btn-link'
                ])

                @include('livewire.pages.page-patient-index-today', [
                    'title'                     => 'Done',
                    'search_list'               => 'queue_list_done_search',
                    'queue_list_patients'       => $queue_list_done, 
                    'action_btn_goto_method'    => 'revert', 
                    'action_btn_name'           => 'Revert',
                    'action_btn_icon'           => 'bi-arrow-clockwise',
                    'action_btn_class'          => 'btn-link'
                ])
        </x-layouts.main-content-content>
    @elseif ($this->currentPage == 'patient_list')
        @include('livewire.pages.page-patient-list')
    @elseif ($this->currentPage == 'patient_exam')
        @livewire('pages.page-patient-exam', ['patient_id' => $patient_exam_id])
    @endif

</x-layouts.main-content-index>