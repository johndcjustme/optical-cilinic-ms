<div class="card">
	<div class="card-body pt-4">
		<div class="d-flex align-items-center justify-content-between">
			<h5 class="card-title pt-2">Patients <span>| This Year: {{ $patient_total_by_year }}</span></h5>
			<div>
				<div class="dropdown">
					<button class="btn btn-outline-primary" href="#" data-bs-toggle="dropdown" aria-expanded="false">{{ $year }} <i class="bi bi-caret-down-fill"></i></button>
					<ul class="dropdown-menu dropdown-menu-end" style="">
						<li class="dropdown-header text-start">
						<h6 class="text-muted">FILTER</h6>
						</li>
						@foreach ($years as $year)
							<li><a wire:click.prevent="$set('year', {{ $year }})" class="dropdown-item" href="#">{{ $year }}</a></li>
						@endforeach
					</ul>	
					</div>
			</div>
		</div>
		<div style="height: 25rem">
			<livewire:livewire-area-chart
				key="{{ $areaChartModel->reactiveKey() }}"
				:area-chart-model="$areaChartModel"
			/>
		</div>
	</div>
</div>