<div class="col-md-6 col-sm-12">

    @if ($this->view_purchases)
      @include('livewire.pages.page-patient-exam-purchase-all')
    @else   
      @include('livewire.pages.page-patient-exam-purchase-latest')     
    @endif

    {{-- <x-organisms.confirm-dialog :id="$id_confirm_purchase"/> --}}
</div>

