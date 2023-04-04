{{-- Because she competes with no one, no one can compete with her. --}}
<x-layouts.main-content-index>

    <x-layouts.main-content-nav page-title="Users"/>

    @include('livewire.pages.includes.options-users-index')

    <x-layouts.main-content-content>
        <x-organisms.table-index with-card>
            <x-slot name="thead">
                <x-organisms.table-th text="#" style="width: 2em;"/>
                <x-organisms.table-th text="Name"/>
                <x-organisms.table-th text="Email"/>
                <x-organisms.table-th text="Mobile"/>
                <x-organisms.table-th text="Facebook"/>
                <x-organisms.table-th text="Role"/>
                <x-organisms.table-th text="Date Added"/>
                <x-organisms.table-th/>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($users as $user)
                    <tr>
                        <x-organisms.table-td :desc="$i++"/>
                        <x-organisms.table-th :text="$user->name"/>
                        <x-organisms.table-td :text="$user->email"/>
                        <x-organisms.table-td :text="$user->mobile ?? '--'"/>
                        <x-organisms.table-td>
                            <a href="{{ $user->facebook }}" target="_blank" class="text-truncate" style="width: 5em">
                                {{ Str::limit($user->facebook, 30) }}
                            </a>
                        </x-organisms.table-td>
                        <x-organisms.table-th>
                            @foreach ($user->roles as $role)
                                {{ $role->name }}
                            @endforeach
                        </x-organisms.table-th>
                        <x-organisms.table-td :text="$user->created_at"/>
                        <x-organisms.table-td class="text-end">
                            @if (Auth::user()->hasRole('staff') && Auth::user()->id == $user->id)
                                <a href="home?page=profile&user_id={{ $user->id }}">View</a>                                
                            @elseif(Auth::user()->hasRole('admin'))
                                <a href="home?page=profile&user_id={{ $user->id }}">View</a>                                
                            @endif

                            @role('super-admin')
                                <a class="ms-2" href="home?page=profile&user_id={{ $user->id }}">Delete</a>
                            @endrole
                        </x-organisms.table-td>
                    </tr>
                @endforeach
            </x-slot>
        </x-organisms.table-index>
    </x-layouts.main-content-content>
</x-layouts.main-content-index>



