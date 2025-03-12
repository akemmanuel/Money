import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts',  'resources/images/crypto.svg', 'resources/images/bank.svg', 'resources/images/invest.svg', 'resources/images/stocks.svg', 'resources/images/bonds.svg', 'resources/images/real-estate.svg', 'resources/images/mutual-funds.svg', 'resources/images/etfs.svg', 'resources/images/crypto2.svg', 'resources/images/commodities.svg', 'resources/images/games.webp'],
            refresh: true,
        }),
    ],

});
