use App\Livewire\Portfolio;
use App\Models\CryptoPrices;
use App\Models\Fiat;
use App\Models\PortfolioHistory;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Traits\CalculatesPortfolioValue;

class Portfolio extends Component
{
    use CalculatesPortfolioValue;

    public $depots = [];
    public $totalValue;
    public $previousDayValue;
    public $dailyChange;
    public $dailyPercentageChange;
    public $weeklyChange;
    public $weeklyPercentageChange;
    public $monthlyChange;
    public $monthlyPercentageChange;
    public $portfolioChart;
    public $selectedRange = '30days'; // Default to 30 days
    public $startDate;
    public $endDate;
    public $editingDepotId = null;
    public $editedDepotName = '';

    public function mount()
    {
        $user = Auth::user();
        $this->depots = $user->depots ?? collect();
        $this->totalValue = $this->getTotalValue($user);

        // Calculate daily change
        $yesterday = Carbon::yesterday();
        $previousDayPortfolio = PortfolioHistory::where('user_id', $user->id)
            ->whereDate('date', $yesterday)
            ->first();

        $this->previousDayValue = $previousDayPortfolio ? $previousDayPortfolio->value : 0;
        $this->dailyChange = $this->totalValue - $this->previousDayValue;
        $this->dailyPercentageChange = $this->previousDayValue != 0 ? ($this->dailyChange / $this->previousDayValue) * 100 : 0;

        // Calculate weekly change
        $sevenDaysAgo = Carbon::today()->subDays(7);
        $sevenDaysAgoPortfolio = PortfolioHistory::where('user_id', $user->id)
            ->whereDate('date', $sevenDaysAgo)
            ->first();
        $sevenDaysAgoValue = $sevenDaysAgoPortfolio ? $sevenDaysAgoPortfolio->value : 0;
        $this->weeklyChange = $this->totalValue - $sevenDaysAgoValue;
        $this->weeklyPercentageChange = $sevenDaysAgoValue != 0 ? ($this->weeklyChange / $sevenDaysAgoValue) * 100 : 0;

        // Calculate monthly change
        $thirtyDaysAgo = Carbon::today()->subDays(30);
        $thirtyDaysAgoPortfolio = PortfolioHistory::where('user_id', $user->id)
            ->whereDate('date', $thirtyDaysAgo)
            ->first();
        $thirtyDaysAgoValue = $thirtyDaysAgoPortfolio ? $thirtyDaysAgoPortfolio->value : 0;
        $this->monthlyChange = $this->totalValue - $thirtyDaysAgoValue;
        $this->monthlyPercentageChange = $thirtyDaysAgoValue != 0 ? ($this->monthlyChange / $thirtyDaysAgoValue) * 100 : 0;

        $this->startDate = Carbon::now()->subDays(30)->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');

        $this->portfolioChart = $this->generatePortfolioChart();
    }

    public function editDepot($depotId, $depotName)
    {
        $this->editingDepotId = $depotId;
        $this->editedDepotName = $depotName;
    }

    public function saveDepotName($depotId)
    {
        $this->validate(['editedDepotName' => 'required|string|max:100']);

        $depot = Auth::user()->depots()->find($depotId);
        if ($depot) {
            $depot->update(['name' => $this->editedDepotName]);
            session()->flash('message', 'Depot name updated successfully.');
        }

        $this->editingDepotId = null;
        $this->editedDepotName = '';
    }

    public function cancelEdit()
    {
        $this->editingDepotId = null;
        $this->editedDepotName = '';
    }

    public function updatedSelectedRange($value)
    {
        $this->selectedRange = $value;
        $this->startDate = null;
        $this->endDate = null;
        $this->portfolioChart = $this->generatePortfolioChart();
    }

    public function updatedStartDate($value)
    {
        $this->selectedRange = 'custom';
        $this->portfolioChart = $this->generatePortfolioChart();
    }

    public function updatedEndDate($value)
    {
        $this->selectedRange = 'custom';
        $this->portfolioChart = $this->generatePortfolioChart();
    }

    public function render()
    {
        $depots = auth()->user()->depots;

        return view('livewire.portfolio');
    }

    private function generatePortfolioChart()
    {
        $user = Auth::user();
        $historyQuery = PortfolioHistory::where('user_id', $user->id);

        if ($this->selectedRange === 'custom' && $this->startDate && $this->endDate) {
            $historyQuery->whereBetween('date', [$this->startDate, $this->endDate]);
        } else {
            switch ($this->selectedRange) {
                case '7days':
                    $historyQuery->where('date', '>=', Carbon::now()->subDays(7));
                    break;
                case '30days':
                    $historyQuery->where('date', '>=', Carbon::now()->subDays(30));
                    break;
                case '3months':
                    $historyQuery->where('date', '>=', Carbon::now()->subMonths(3));
                    break;
                case '1year':
                    $historyQuery->where('date', '>=', Carbon::now()->subYear());
                    break;
                case 'all':
                default:
                    // No date filter needed for 'all'
                    break;
            }
        }

        $history = $historyQuery->orderBy('date', 'asc')->get();

        $dates = $history->map(fn($item) => $item->date->format('Y-m-d'))->toArray();
        $values = $history->map(fn($item) => $item->value)->toArray();

        return (new LarapexChart())->lineChart()
            ->setTitle('Portfolio Value Over Time')
            ->setSubtitle('Historical performance')
            ->setColors(['#008FFB', '#ff6384'])
            ->setHeight(300)
            ->setXAxis($dates)
            ->setDataset([[
                'name' => 'Value',
                'data' => $values
            ]]);
    }

    public function placeholder(array $params = [])
    {
        return view('placeholder.skeleton', $params);

    }
}