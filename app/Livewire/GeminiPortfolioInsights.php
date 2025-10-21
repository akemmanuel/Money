<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gemini\Laravel\Facades\Gemini;
use Carbon\Carbon;
use App\Models\PortfolioHistory;
use App\Models\Depot;

class GeminiPortfolioInsights extends Component
{
    public $summary = '';
    public $isLoading = true;

    public function mount()
    {
        $this->generateSummary();
    }

    public function generateSummary()
    {
        $this->isLoading = true;
        $user = Auth::user();

        if (!$user) {
            $this->summary = 'Please log in to see your portfolio insights.';
            $this->isLoading = false;
            return;
        }

        // Fetch portfolio data for the last 7 days
        $sevenDaysAgo = Carbon::now()->subDays(7);
        $portfolioHistory = PortfolioHistory::where('user_id', $user->id)
            ->where('date', '>=', $sevenDaysAgo)
            ->orderBy('date', 'asc')
            ->get();

        $depots = Depot::where('user_id', $user->id)->get();

        $portfolioData = [
            'current_value' => $portfolioHistory->last()->value ?? 0,
            'seven_day_history' => $portfolioHistory->map(function ($item) {
                return ['date' => $item->date->format('Y-m-d'), 'value' => $item->value];
            })->toArray(),
            'depots' => $depots->map(function ($depot) {
                return [
                    'name' => $depot->name,
                    'type' => $depot->type,
                    'value' => $depot->value,
                ];
            })->toArray(),
        ];

        $prompt = "Analyze the following portfolio data and provide a concise daily/weekly performance summary. Highlight significant changes, top performers (if discernible from depot values), and any notable trends. Keep it under 100 words.

Portfolio Data: " . json_encode($portfolioData);

        $diversificationPrompt = "Based on the following depot data, provide generic suggestions for improving portfolio diversification (e.g., \"Consider adding assets in [sector/currency type] to further diversify.\"). Keep it under 50 words.

Depot Data: " . json_encode($depots->toArray());

        try {
            $summaryResult = Gemini::generativeModel(model: 'gemini-1.5-flash')
                ->generateContent($prompt);

            $diversificationResult = Gemini::generativeModel(model: 'gemini-1.5-flash')
                ->generateContent($diversificationPrompt);

            $this->summary = $summaryResult->text() . "\n\nDiversification Suggestion: " . $diversificationResult->text();
        } catch (\Exception $e) {
            $this->summary = 'Could not generate insights at this time. Error: ' . $e->getMessage();
        } finally {
            $this->isLoading = false;
        }
    }

    public function render()
    {
        return view('livewire.gemini-portfolio-insights');
    }
}
