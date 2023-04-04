@extends('components.organisms.modal-index')

@section('content')
    @if ($this->modal)
        <x-organisms.modal-content w-submit="create_or_update" :modal-title="empty($this->pt['id']) ? 'Add' : 'Edit'">
            <h1>hey</h1>
        </x-organisms.modal-content>
    @endif
@endsection

