<div class="col-md-6 col-sm-12">
		{{-- <div class="card">
			<div class="card-body py-2">
				<div class="d-flex flex-wrap justify-content-between align-items-center">
					<h5 class="card-title fw-bold mb-0">Refraction</h5>
					<div class="d-flex justify-content-end gap-3">

						@if (($this->all_refractions > 1) || $view_refractions)
							<x-atoms.button 
								w-click="view_all_refractions" 
								class="btn-outline-success"
								icon="{{ $view_refractions ? 'bi-arrow-left' : 'bi-eye' }}"
								text="{{ $view_refractions ? 'Go back to latest ' : 'View All (' . $all_refractions .')' }}"/>
						@endif

						<button {!! $this->creating_refraction() !!} class="btn btn-success">Create New</button>
						
					</div>
				</div>
			</div>
		</div> --}}
		
		@if ($view_refractions && (count($refractions) > 1))
			@include('livewire.pages.page-patient-exam-refraction-all')
		@else
			@include('livewire.pages.page-patient-exam-refraction-latest')
		@endif

		{{-- <x-organisms.confirm-dialog/> --}}

</div>