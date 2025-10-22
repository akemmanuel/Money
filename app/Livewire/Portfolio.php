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
    public $totalValue = 0;
    public $previousDayValue;
    public $dailyChange = 0;
    public $dailyPercentageChange = 0;
    public $weeklyChange = 0;
    public $weeklyPercentageChange = 0;
    public $monthlyChange = 0;
    public $monthlyPercentageChange = 0;
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
        $this->totalValue = $this->calculateTotalValue();
        $this->dailyChange = $this->calculateDailyChange();
        $this->dailyPercentageChange = $this->calculateDailyPercentageChange();
        $this->weeklyChange = $this->calculateWeeklyChange();
        $this->weeklyPercentageChange = $this->calculateWeeklyPercentageChange();
        $this->monthlyChange = $this->calculateMonthlyChange();
        $this->monthlyPercentageChange = $this->calculateMonthlyPercentageChange();
    }

    public function render()
    {
        $depots = auth()->user()->depots;

        return view('livewire.portfolio', [
            'depots' => $depots,
            'totalValue' => $this->totalValue,
            'dailyChange' => $this->dailyChange,
            'dailyPercentageChange' => $this->dailyPercentageChange,
            'weeklyChange' => $this->weeklyChange,
            'weeklyPercentageChange' => $this->weeklyPercentageChange,
        ]);
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