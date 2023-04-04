<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use Illuminate\Support\Str;

use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;

use App\Models\Patient;

class PageDashboardIndex extends Component
{
    public function render()
    {
        return view('livewire.pages.page-dashboard-index');
    }

    public function modal_show()
    {
        $this->dispatchBrowserEvent('modal-show');
    }
}
