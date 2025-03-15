
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
        vendors: true,
        themes: [
            {
                mytheme: {
                    "primary": "#fcaa1e",
                    "primary-content": "#160b00",
                    "secondary": "#949494",
                    "secondary-content": "#080808",
                    "accent": "#000000",
                    "accent-content": "#bebebe",
                    "neutral": "#949494",
                    "neutral-content": "#080808",
                    "base-100": "#ffffff",
                    "base-200": "#dedede",
                    "base-300": "#bebebe",
                    "base-content": "#161616",
                    "info": "#00b3ff",
                    "info-content": "#000c16",
                    "success": "#00db0f",
                    "success-content": "#001100",
                    "warning": "#ff0000",
                    "warning-content": "#160000",
                    "error": "#ff0000",
                    "error-content": "#160000"
                }
            }
        ]
    }
};
