<div class="card">
    <div class="card-body pt-3">
        <div class="d-flex justify-content-between align-items-center gap-3">
            <h5 class="card-title">{{ $title }}</h5>
            <div style="max-width:15em;">
                <x-atoms.search w-model="{{ $search_list }}" placeholder="Search by Name"/>
            </div>
        </div>

        @if (count($queue_list_patients) > 0)
            <x-organisms.table-index>
                <x-slot name="thead">
                    <x-organisms.table-th text="#" style="width: 2em;" />
                    <x-organisms.table-th style="width:6em;" />
                    <x-organisms.table-th text="Name" />
                    <x-organisms.table-th text="Purpose"/>
                    @permission('patient-manage')
                        <x-organisms.table-th style="width:20em;" />
                    @endpermission
                    <x-organisms.table-th-action/>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($queue_list_patients as $key => $pt)
                        <tr>
                            <x-organisms.table-td :desc="$key + 1" />
                            <x-organisms.table-td class="text-center">
                                <x-atoms.button w-click="patient_exam({{ $pt->id }})" 
                                    text="Exam" 
                                    icon="bi-pencil" 
                                    class="d-flex gap-1 btn-outline-success btn-sm" />
                            </x-organisms.table-td>
                            <x-organisms.table-th scope="row" :text="$pt->name" :desc="Str::limit($pt->address, 30)" :desc-title="$pt->address" />
                            <x-organisms.table-td :text="$pt->pt_purpose"/>
                            @permission('patient-manage')
                                <x-organisms.table-td class="text-end">
                                    <x-atoms.button w-click="{{$action_btn_goto_method}}({{ $pt->id }})" :icon="$action_btn_icon" class="btn-link btn-sm" :text="$action_btn_name" title="Done" />
                                    <x-atoms.button w-click="hide({{ $pt->id }})"
                                        icon="bi-eye-slash" 
                                        text="Hide"
                                        class="{{ $action_btn_class }} btn-sm" />
                                </x-organisms.table-td>
                            @endpermission

                            <x-organisms.table-td-action edit="$emit('edit', {{ $pt->id }})"/>
                        </tr>
                    @endforeach
                </x-slot>
            </x-organisms.table-index>
        @else
            <x-atoms.alert icon="bi-info-circle" text-body="No data." class="mt-3 alert-primary" />
        @endif
    </div>
</div>