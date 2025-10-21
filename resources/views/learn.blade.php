<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Learn') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Welcome to the Learn Section!</h3>
                <p class="mb-6">Here you can find basic information about finance and investing to help you on your journey.</p>

                <div class="mb-8">
                    <h4 class="text-xl font-semibold mb-3">Financial Definitions</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li>
                            <strong>Stock:</strong> A type of security that signifies ownership in a corporation and represents a claim on part of the corporation's assets and earnings.
                        </li>
                        <li>
                            <strong>Bond:</strong> A fixed income instrument that represents a loan made by an investor to a borrower (typically corporate or governmental).
                        </li>
                        <li>
                            <strong>Mutual Fund:</strong> A type of financial vehicle that collects money from multiple investors to invest in securities like stocks, bonds, money market instruments, and other assets.
                        </li>
                        <li>
                            <strong>ETF (Exchange-Traded Fund):</strong> A type of investment fund and exchange-traded product, i.e., they trade on stock exchanges like common stock.
                        </li>
                        <li>
                            <strong>Diversification:</strong> A strategy that mixes a wide variety of investments within a portfolio. The rationale behind this technique is to minimize the risk of any single security or asset class.
                        </li>
                    </ul>
                </div>

                <div class="mb-8">
                    <h4 class="text-xl font-semibold mb-3">Simple Investment Tips</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li>
                            <strong>Start Early:</strong> The power of compounding means that the sooner you start investing, the more time your money has to grow.
                        </li>
                        <li>
                            <strong>Invest Regularly:</strong> Consistent contributions, even small ones, can add up significantly over time.
                        </li>
                        <li>
                            <strong>Diversify Your Portfolio:</strong> Don't put all your eggs in one basket. Spread your investments across different asset classes and industries.
                        </li>
                        <li>
                            <strong>Understand Your Risk Tolerance:</strong> Know how much risk you're comfortable taking before investing.
                        </li>
                        <li>
                            <strong>Keep Learning:</strong> The financial world is always evolving. Stay informed and continuously educate yourself.
                        </li>
                    </ul>
                </div>

                <div class="text-center mt-8">
                    <p class="text-gray-600">For more in-depth learning, consider exploring reputable financial education platforms and resources.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>