# Money Tracker Next.js Application

A modern financial tracking application built with Next.js, TypeScript, and shadcn/ui components.

## Features

- Dashboard with portfolio overview
- Asset management (create, read, update, delete)
- Portfolio visualization by depot
- Multi-currency support with automatic conversion
- Local storage for data persistence
- Responsive design for all device sizes

## Tech Stack

- **Framework**: Next.js 14 (App Router)
- **Language**: TypeScript
- **Styling**: Tailwind CSS
- **UI Components**: shadcn/ui
- **Icons**: Lucide React
- **State Management**: React Hooks + LocalStorage
- **Data Persistence**: Browser LocalStorage

## Project Structure

```
app/
  ├── assets/          # Asset management pages
  ├── portfolio/       # Portfolio overview
  ├── settings/        # User settings
  └── page.tsx         # Dashboard
components/
  └── layout.tsx       # Main layout with navigation
lib/
  ├── api.ts           # Price fetching utilities
  ├── storage.ts       # LocalStorage operations
  └── utils.ts         # Utility functions
types/
  └── index.ts         # TypeScript interfaces
```

## Data Models

- **Asset**: Financial assets like stocks, crypto, fiat currencies
- **Depot**: Containers for organizing assets (similar to portfolios)
- **Transaction**: Historical transactions for assets
- **Price**: Currency conversion rates

## Getting Started

First, run the development server:

```bash
npm run dev
# or
yarn dev
# or
pnpm dev
# or
bun dev
```

Open [http://localhost:3000](http://localhost:3000) with your browser to see the result.

You can start editing the page by modifying `app/page.tsx`. The page auto-updates as you edit the file.

This project uses [`next/font`](https://nextjs.org/docs/app/building-your-application/optimizing/fonts) to automatically optimize and load [Inter](https://fonts.google.com/specimen/Inter), a default font family.

## Key Functionality

### Asset Tracking
- Track various asset types: fiat currencies, cryptocurrencies, stocks, commodities, ETFs
- Automatic price fetching and currency conversion
- Real-time portfolio value calculation

### Depot Management
- Organize assets into depots (e.g., Personal, Retirement, Savings)
- View asset allocation within each depot

### Multi-Currency Support
- Set display currency in settings
- Automatic conversion between currencies
- Support for major world currencies

## API Integration

The application integrates with several financial APIs:
- Currency conversion: latest.currency-api.pages.dev
- Cryptocurrency prices: min-api.cryptocompare.com
- Stock prices: Alpha Vantage (implementation stubbed)
- Commodities: Gold-API (implementation stubbed)

## Local Storage Schema

All data is persisted in the browser's LocalStorage:
- `moneyTrackerAssets`: Array of asset objects
- `moneyTrackerDepots`: Array of depot objects
- `moneyTrackerTransactions`: Array of transaction objects
- `moneyTrackerUserSettings`: User preferences

## Development

### Linting
```bash
npm run lint
```

### Type Checking
```bash
npm run type-check
```

## Learn More

To learn more about Next.js, take a look at the following resources:

- [Next.js Documentation](https://nextjs.org/docs) - learn about Next.js features and API.
- [Learn Next.js](https://nextjs.org/learn) - an interactive Next.js tutorial.

## Deploy on Vercel

The easiest way to deploy your Next.js app is to use the [Vercel Platform](https://vercel.com/new?utm_medium=default-template&filter=next.js&utm_source=create-next-app&utm_campaign=create-next-app-readme) from the creators of Next.js.

Check out our [Next.js deployment documentation](https://nextjs.org/docs/app/building-your-application/deploying) for more details.