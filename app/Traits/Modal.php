<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;


trait Modal {

    public $modal = false;

    public function modal($action) {
        if ($action == 'show') {
            $this->modal = true;
            $this->dispatchBrowserEvent('modal-show');
        } else {
            $this->modal = false;
            $this->dispatchBrowserEvent('modal-hide');
        }
    }
    
    public function confirmation($action, $title = null, $body = null, $id = 'x-confirm') {
        $action == 'show'
            ? $this->dispatchBrowserEvent('confirm-show', ['title' => $title, 'body' => $body, 'id' => $id])
            : $this->dispatchBrowserEvent('confirm-close');
    }

    public function confirmationShow($title= null, $body = null, $id = 'x-confirm')
    {
        $this->dispatchBrowserEvent('confirm-show', [
            'title' => $title, 
            'body' => $body, 
            'id' => $id
        ]);
    }

    public function confirmationClose()
    {
        $this->dispatchBrowserEvent('confirm-close');
    }




    public function toast($type, $body) {
        $this->dispatchBrowserEvent('toast', [
            'body' => $body,
            'type' => $type
        ]);
    }
    public function toastError($body = 'An error has occured. Please try again.') {
        $this->toast('error', $body);
    }
    public function toastWarning($body = 'An error has occured. Please try again.') {
        $this->toast('warning', $body);
    }




    public function hasPermission($permission) {
        if (!Auth::user()->hasPermission($permission)) {
            $this->toast('warning', 'Sorry, You do not have permission to perform such action.');
            return true;
        }
    }

    private function confirmDialog($method_to_emit, $message, $param = null) 
    {
        return "onclick=\"if(confirm('{$message}')) Livewire.emit('{$method_to_emit}', '{$param}') \"";
    }
    
}