import { Price } from '@/types';

// Cache for price data to avoid repeated API calls
const priceCache = new Map<string, { price: Price; timestamp: number }>();
const CACHE_DURATION = 60 * 60 * 1000; // 60 minutes - longer cache for stability

// Helper function to clean currency codes
const cleanCurrencyCode = (currency: string): string => {
  return currency.replace(/[^a-zA-Z]/g, '').toLowerCase();
};

// Get price from cache if still valid
const getCachedPrice = (currency: string, type: string): Price | null => {
  const key = `${currency}-${type}`;
  const cached = priceCache.get(key);
  
  if (cached && Date.now() - cached.timestamp < CACHE_DURATION) {
    return cached.price;
  }
  
  return null;
};

// Save price to cache
const cachePrice = (currency: string, type: string, price: Price): void => {
  const key = `${currency}-${type}`;
  priceCache.set(key, { price, timestamp: Date.now() });
};

// Fetch fiat prices from currency API
export const getFiatPrice = async (currency: string): Promise<number | null> => {
  try {
    const cachedPrice = getCachedPrice(currency, 'fiats');
    if (cachedPrice) {
      return cachedPrice.usd;
    }

    const response = await fetch(`https://latest.currency-api.pages.dev/v1/currencies/${cleanCurrencyCode(currency)}.json`);
    const data = await response.json();
    
    if (data && data[cleanCurrencyCode(currency)] && data[cleanCurrencyCode(currency)].usd) {
      const usdPrice = data[cleanCurrencyCode(currency)].usd;
      const price: Price = {
        id: Date.now().toString(),
        currency,
        type: 'fiats',
        usd: usdPrice,
        createdAt: new Date(),
        updatedAt: new Date(),
      };
      
      cachePrice(currency, 'fiats', price);
      return usdPrice;
    }
    
    return null;
  } catch (error) {
    console.error(`Error fetching fiat price for ${currency}:`, error);
    return null;
  }
};

// Fetch crypto prices from CryptoCompare
export const getCryptoPrice = async (currency: string): Promise<number | null> => {
  try {
    const cachedPrice = getCachedPrice(currency, 'crypto');
    if (cachedPrice) {
      return cachedPrice.usd;
    }

    const response = await fetch(`https://min-api.cryptocompare.com/data/price?fsym=${currency}&tsyms=USD`);
    const data = await response.json();
    
    if (data && data.USD) {
      const usdPrice = data.USD;
      const price: Price = {
        id: Date.now().toString(),
        currency,
        type: 'crypto',
        usd: usdPrice,
        createdAt: new Date(),
        updatedAt: new Date(),
      };
      
      cachePrice(currency, 'crypto', price);
      return usdPrice;
    }
    
    return null;
  } catch (error) {
    console.error(`Error fetching crypto price for ${currency}:`, error);
    return null;
  }
};

// Fetch stock prices (simplified implementation)
export const getStockPrice = async (symbol: string): Promise<number | null> => {
  // In a real implementation, you would use a stock API like Alpha Vantage
  // For now, we'll return a mock value or null
  console.warn(`Stock price fetching not implemented for ${symbol}. Using mock value.`);
  return null;
};

// Fetch commodity prices (simplified implementation)
export const getCommodityPrice = async (symbol: string): Promise<number | null> => {
  // In a real implementation, you would use a commodity API
  // For now, we'll return a mock value or null
  console.warn(`Commodity price fetching not implemented for ${symbol}. Using mock value.`);
  return null;
};

// Generic price fetching function
export const getPriceUsd = async (currency: string, type: string): Promise<number | null> => {
  switch (type) {
    case 'fiats':
      return getFiatPrice(currency);
    case 'crypto':
      return getCryptoPrice(currency);
    case 'stocks':
      return getStockPrice(currency);
    case 'commodities':
      return getCommodityPrice(currency);
    case 'etfs':
      // ETFs could be treated similar to stocks
      return getStockPrice(currency);
    default:
      console.warn(`Unknown currency type: ${type}`);
      return null;
  }
};

// Convert between currencies
export const convertCurrency = async (amount: number, fromCurrency: string, fromType: string, toCurrency: string): Promise<number> => {
  // If currencies are the same, no conversion needed
  if (fromCurrency === toCurrency) {
    return amount;
  }

  // Get price of fromCurrency in USD
  const fromPriceUsd = await getPriceUsd(fromCurrency, fromType);
  if (fromPriceUsd === null) {
    console.error(`Could not get price for ${fromCurrency}`);
    return 0;
  }

  // If target currency is USD, we're done
  if (toCurrency === 'USD') {
    return amount * fromPriceUsd;
  }

  // Get price of toCurrency in USD
  // For simplicity, we'll assume all target currencies are fiats
  const toPriceUsd = await getFiatPrice(toCurrency);
  if (toPriceUsd === null) {
    console.error(`Could not get price for ${toCurrency}`);
    return 0;
  }

  // Convert: (amount * fromPriceUsd) / toPriceUsd
  return (amount * fromPriceUsd) / toPriceUsd;
};

// USD to target currency conversion
export const usdToCurrency = async (usdAmount: number, targetCurrency: string): Promise<number> => {
  if (targetCurrency === 'USD') {
    return usdAmount;
  }

  const targetPriceUsd = await getFiatPrice(targetCurrency);
  if (targetPriceUsd === null) {
    console.error(`Could not get price for ${targetCurrency}`);
    return 0;
  }

  return usdAmount / targetPriceUsd;
};