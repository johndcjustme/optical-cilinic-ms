<div class="card">
    <div class="card-body">
        <h5 class="card-title">Inventory <span>| All Items: {{ $all_items }}</span></h5>
        <div style="height:25rem">
            <livewire:livewire-pie-chart
                key="{{ $pieChartModel->reactiveKey() }}"
                :pie-chart-model="$pieChartModel"
            />
        </div>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <x-organisms.table-index>
            <x-slot name="header">
                <h5 class="card-title">Running out of stocks <span>| {{ $count_running_out_items }} item(s)</span></h5>
            </x-slot>
            <x-slot name="thead"></x-slot>
            <x-slot name="tbody">
                @forelse ($running_out_items as $out)
                    <tr>
                        <x-organisms.table-td text="{{ $out->name }}" desc="{{ $out->description }}"/>
                        <x-organisms.table-td text="{{ $out->quantity }}" class="text-end text-danger" style="width:4em"/>
                        <x-organisms.table-td text="{{ $out->unit == '' || $out->unit == null ? '--' : $out->unit }}" class="text-end"/>
                    </tr>
                @empty
                    <tr>
                        <x-organisms.table-td colspan="3" class="text-center" text="No data."/> 
                    </tr>
                @endforelse
            </x-slot>
        </x-organisms.table-index>
    </div>
</div>
    
