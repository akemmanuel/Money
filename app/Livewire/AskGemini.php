<?php

namespace App\Livewire;

use Livewire\Component;

class AskGemini extends Component
{
    public $question;
    public $answer;

    protected $rules = [
        'question' => 'required|string|min:5',
    ];

    public function submitQuestion()
    {
        $this->validate();

        // In a real application, you would call the Google Gemini API here.
        // For this example, we'll simulate a response.
        // The actual integration with a real API would involve HTTP requests
        // to the Gemini API endpoint with proper authentication and request formatting.
        // Since direct external API calls are not part of the current toolset for direct execution,
        // we'll simulate the response based on the question.

        // For demonstration, let's use a placeholder response.
        // In a real scenario, you'd use a library like GuzzleHttp to make the API call.
        // Example: $response = Http::post('https://generativelanguage.googleapis.com/...', [...]);
        // $this->answer = $response->json()['candidates'][0]['content']['parts'][0]['text'];

        // Simulating a response based on the question
        if (stripos($this->question, 'stock split') !== false) {
            $this->answer = 'A stock split is when a company increases the number of its shares outstanding by issuing more shares to current shareholders. For example, in a 2-for-1 stock split, each shareholder receives an additional share for every share they own, and the price per share is halved.';
        } elseif (stripos($this->question, 'market summary') !== false) {
            $this->answer = 'The market is currently experiencing moderate volatility, with technology stocks showing resilience while energy sectors are reacting to global supply changes. Investors are closely watching inflation data and central bank announcements.';
        } else {
            $this->answer = 'I am Gemini, a large language model. I can provide concise answers to your finance-related questions. Please ask me something specific!';
        }
    }

    public function render()
    {
        return view('livewire.ask-gemini');
    }
}
