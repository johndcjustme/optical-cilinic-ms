<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Payment;
use App\Models\Patient;
use App\Models\Purchase;
use App\Http\Pages\PagePaymentIndex;

use App\Traits\SharedVariables;
use App\Traits\WithFilter;
use App\Traits\WithSorting;



class PagePaymentList extends Component
{
    use SharedVariables;
    use WithPagination;
    use WithFilter;
    use WithSorting;
    // only display Patients that has payment

    public $detail_id, $with_balance = true;

    protected $queryString = [
        'detail_id' => ['except' => '']
    ];

    public function mount()
    {
        $this->orderBy = 'name';
        $this->setDefaultFilter('this_year');
    }

    public function render()
    {
        $purchases = Purchase::select(['id','deposit','patient_id','created_at']);

        $this->withFilter($purchases);

        return view('livewire.pages.page-payment-list', [
            'purchases' => $purchases->orderByDesc('created_at')->simplePaginate($this->paginate),
            'filter_count_purchases' => $purchases->count()
        ]);
    }
}
