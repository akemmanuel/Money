
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flyonui/dist/js/*.js',
        './node_modules/apexcharts/**/*.js', // Include all relevant JS files from ApexCharts
        './node_modules/flyonui/dist/js/helper-apexcharts.js', // Include helper JS file with tooltip functions and initialization code
    ],
    plugins: [
        require('flyonui'), 
        require('flyonui/plugin')
    ],
    flyonui: {
        vendors: true // Enable vendor-specific CSS generation
      }
};
