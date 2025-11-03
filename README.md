# 💰 Money - Personal Finance Management System

A modern, feature-rich personal finance management application built with Laravel and Livewire. Track your assets, investments, crypto, and bank accounts all in one place.

![Laravel](https://img.shields.io/badge/Laravel-11.x-red)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue)
![Livewire](https://img.shields.io/badge/Livewire-3.x-green)
![License](https://img.shields.io/badge/License-MIT-yellow)

## ✨ Features

### 🏦 **Account Management**
- Multiple bank account support
- Asset tracking (stocks, bonds, ETFs, mutual funds)
- Cryptocurrency portfolio management
- Real-time price tracking

### 📊 **Analytics & Dashboard**
- Interactive charts and graphs powered by Larapex Charts
- Portfolio performance tracking
- Historical data analysis
- Asset allocation visualization

### 🔐 **Security & Authentication**
- User authentication with Laravel Fortify
- Social login integration (Socialstream)
- Two-factor authentication support
- API token management

### 🎯 **Smart Features**
- AI-powered insights using Google Gemini
- Bitcoin sentiment analysis
- Automated portfolio tracking
- Price alerts and notifications

## 🚀 Quick Start

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- SQLite (default) or MySQL/PostgreSQL

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/money.git
   cd money
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure your environment variables** (see [Configuration](#configuration) below)

5. **Database setup**
   ```bash
   # For SQLite (default)
   touch database/database.sqlite
   
   # Then run migrations
   php artisan migrate
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` in your browser.

## ⚙️ Configuration

### Required Environment Variables

Create a `.env` file from `.env.example` and configure the following:

#### **Application Settings**
```env
APP_NAME="Money"
APP_ENV=local
APP_KEY=base64:your_generated_key_here
APP_DEBUG=true
APP_URL=http://localhost:8000
```

#### **Database Configuration**
```env
# SQLite (default)
DB_CONNECTION=sqlite
# DB_DATABASE=database/database.sqlite

# Or use MySQL/PostgreSQL
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=money
# DB_USERNAME=your_username
# DB_PASSWORD=your_password
```

#### **API Keys (Optional but Recommended)**
```env
# Alpha Vantage for real-time stock prices
ALPHA_VANTAGE_API_KEY=your_alpha_vantage_key

# Google Gemini for AI-powered insights
GEMINI_API_KEY=your_gemini_api_key
```

#### **Mail Configuration (for notifications)**
```env
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Getting API Keys

1. **Alpha Vantage**: Get your free API key at [https://www.alphavantage.co/support/#api-key](https://www.alphavantage.co/support/#api-key)
2. **Google Gemini**: Get your API key at [https://aistudio.google.com/app/apikey](https://aistudio.google.com/app/apikey)

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/     # HTTP controllers
│   ├── Livewire/            # Livewire components
│   ├── Models/              # Eloquent models
│   └── Actions/             # Application actions
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/                 # Application routes
└── config/                 # Configuration files
```

## 🛠️ Development

### Available Commands

```bash
# Start development server with all services
composer run dev

# Run tests
php artisan test

# Code formatting
./vendor/bin/pint

# Database migrations
php artisan migrate

# Clear caches
php artisan optimize:clear
```

### Frontend Development

The application uses Vite for asset compilation:

```bash
# Development
npm run dev

# Production build
npm run build
```

## 🧪 Testing

Run the test suite:

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage
```

## 📦 Deployment

### Production Setup

1. **Environment Configuration**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   ```

2. **Optimize Application**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan optimize
   ```

3. **Set Up Queue Worker**
   ```bash
   php artisan queue:work --daemon
   ```

### Security Considerations

- Ensure `APP_DEBUG=false` in production
- Use HTTPS in production
- Keep your API keys secure
- Regularly update dependencies
- Set up proper file permissions

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- [Laravel](https://laravel.com/) - The PHP Framework for Web Artisans
- [Livewire](https://livewire.laravel.com/) - A full-stack framework for Laravel
- [Larapex Charts](https://github.com/arielmejiadev/larapex-charts) - Chart library for Laravel
- [Google Gemini](https://ai.google.dev/) - AI-powered insights
- [Alpha Vantage](https://www.alphavantage.co/) - Financial market data

## 📞 Support

If you encounter any issues or have questions, please:

1. Check the [Issues](https://github.com/yourusername/money/issues) page
2. Create a new issue with detailed information
3. Join our community discussions

---

**Made with ❤️ for personal finance management**