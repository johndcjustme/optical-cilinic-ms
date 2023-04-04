{{-- @props([
    'patient' => []
]) --}}

<div class="mb-4">
    <h2 class="text-primary mb-2">{{ $patient->name ?? '--' }}</h2>
    <div class="d-flex align-items-center gap-2 text-muted">
        <div class="btn-group">
           <a href="#" title="More about {{ $patient->name ?? '--' }}" id="dropdownMenuClickableOutside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><i class="bi bi-info-circle" title="More about {{ $patient->name ?? '--' }}"></i> More</a> 
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableOutside">
                <div class="py-0 px-3 text-sm">
                    <label class="text-muted" style="font-size: 0.8rem;">Occupation:</label><br>
                    <span>{{ $patient->occupation ?? '--' }}</span><br>
 
                    <label class="text-muted" style="font-size: 0.8rem;">Mobile:</label><br>
                    <span>{{ $patient->mobile_1 ?? '--' }}</span><br>

                    <label class="text-muted" style="font-size: 0.8rem;">Email:</label><br>
                    <span>{{ $patient->email ?? '--' }}</span><br>

                    <label class="text-muted" style="font-size: 0.8rem;">Date Added:</label><br>
                    <span>{{ $patient->created_at ?? '--' }}</span>
                </div>
            </ul>
        </div>
        | {{ $patient->age ?? '--' }} | {{ $patient->pt_gender ?? '--' }} 
            @if(!empty($patient->address)) <span title="{{ $patient->address ?? '--' }}">| {{ Str::limit($patient->address ?? '', 30) }}</span> @endif
    </div>
</div>