<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use Asantibanez\LivewireCharts\Models\AreaChartModel;

use Illuminate\Support\Str;

use Carbon\Carbon;

use App\Models\Patient;

class PageDashboardChartPatient extends Component
{
	public 
		$year, 
		$years = [], 
		$patient_by_year_total = 0;

	public function mount() 
	{ 
		$this->year = date('Y'); 
	}

	public function render(Patient $patient)
	{
		$areaChartModel = (new AreaChartModel());
		$areaChartModel->setAnimated(true);
		$areaChartModel->setColor('#0d6efd');
		for ($i = 1; $i <= 12; $i++) {
			$areaChartModel->addPoint(
				Str::upper(date('M', mktime(0,0,0,$i,1,$this->year))), 
				$patient->select(['created_at'])
					->whereMonth('created_at', $i)
					->whereYear('created_at', $this->year)
					->count()
			);
		}

		$patient->select(['created_at'])->orderBy('created_at')->chunk(100, function ($patients) {
			foreach ($patients as $pt) {
				$this->years[] = date('Y', strtotime($pt->created_at));
			}
		});

		$this->years = collect($this->years)
			->unique()
			->values()
			->take(5)
			->all();

		return view('livewire.pages.page-dashboard-chart-patient', [
			'areaChartModel' => $areaChartModel,
			'years' => $this->years,
			'patient_total_by_year' => $patient->count()
		]);
	}
}
