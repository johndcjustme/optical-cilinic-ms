<div class="card">
    <div class="card-body">
        <h5 class="card-title">Recent Activity <span>| Today</span></h5>
        <div class="activity">
            @forelse ($user_activities as $activity)
                <div class="activity-item d-flex">
                    {{-- <small class="activite-label">{{ $activity->created_at->diffForHumans() }}</small> --}}
                    {{-- <i class="bi bi-circle-fill activity-badge text-secondary align-self-start"></i> --}}
                    <div class="activity-conten pb-2">
                        <small class="text-muted" style="font-size: 0.7rem;"><i class="bi bi-circle-fill text-secondary mr-2"></i> {{ $activity->created_at->diffForHumans() }} | {{ $activity->user->email }}</small>
                        <br>
                        <small>
                            {!! $activity->description !!}
                        </small>
                    </div>
                </div>             
            @empty
                <div class="py-3 text-center text-muted">No activity today.</div>
            @endforelse
        </div>
    </div>
</div>
    
