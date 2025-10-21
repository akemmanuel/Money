## Features & Improvements (Implementable in one day)

### Portfolio Management & Display
*   **Daily Portfolio Snapshot Automation:** Implement a scheduled task that runs once a day (e.g., at midnight) to record the user's current total portfolio value into the `portfolio_histories` table. This is crucial for enabling historical performance tracking and resolving the current bug related to missing `portfolio_histories` data. NOTE: Ai fixed
*   **Portfolio Chart Time Range Selector:** Add a simple dropdown or buttons to the portfolio page allowing users to select different time ranges for the portfolio value chart (e.g., 7 days, 30 days, 3 months, 1 year, All Time). This will improve the usability and insights derived from the chart. NOTE: Ai fixed
*   **Currency Conversion Rate Caching:** For the `convert` function, cache the `usdTo` conversion rate for the user's `display_currency` for a short period (e.g., 5-10 minutes). This will reduce redundant external API calls or database lookups when rendering multiple assets in the same display currency on a single page, improving page load times. NOTE: Ai fixed
*   **Basic Asset Categories for Bonds/Real Estate/Mutual Funds:** For the existing `/bonds`, `/real-estate`, and `/mutual-funds` routes, add a simple form to manually input the value of such assets. This allows users to include more diverse investments in their total portfolio calculation without complex integration. NOTE: Ai fixed

### User Experience & Information
*   **Google Gemini for Quick Financial Definitions/News:** Integrate a basic input field on the dashboard or a dedicated "Ask Gemini" page. Users can type in a finance-related term (e.g., "What is a stock split?") or ask for a quick market summary, and Gemini can provide a concise answer. NOTE: Ai fixed
*   **Simple "Learn" Content Placeholders:** Populate the `/learn` page with basic static content, such as definitions of common financial terms, simple investment tips, or links to external educational resources. This adds immediate value for new users. NOTE: Ai fixed

### System & Performance
*   **Optimized Portfolio History Query:** Implement a basic limit on the number of records fetched for the initial portfolio chart display (e.g., the last 30 days by default). This can be paired with the "Portfolio Chart Time Range Selector" feature for more specific queries. NOTE: Ai fixed

## Bugs

### `SQLSTATE[HY000]: General error: 1 no such table: portfolio_histories`
*   **Description:** The application is attempting to query the `portfolio_histories` table, but the database reports that this table does not exist. This directly impacts the calculation of daily, weekly, and monthly portfolio changes, and the generation of the portfolio chart.
*   **Location:** This error occurs in `app/Livewire/Portfolio.php` at line 40 (and subsequent lines where `PortfolioHistory` is accessed).
*   **Likely Cause:**
    1.  The migration `2025_05_28_create_portfolio_histories_table.php` has not been run or completed successfully.
    2.  The `database.sqlite` file being used by the application is not the one expected, or it has been recreated/cleared without running migrations.
*   **Proposed Solution:**
    1.  **Run Migrations:** Execute `php artisan migrate` in the project's root directory to ensure all pending database migrations are applied, specifically the one that creates the `portfolio_histories` table.
    2.  **Verify Database Connection:** Double-check the `DB_CONNECTION` and `DB_DATABASE` settings in the `.env` file to confirm that the application is connecting to the correct SQLite database file. NOTE: Ai fixed