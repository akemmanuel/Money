export interface Asset {
  id: string;
  depotId: string;
  name: string;
  description: string;
  balance: number;
  currency: string;
  typeOfCurrency: 'fiats' | 'crypto' | 'stocks' | 'commodities' | 'etfs';
  createdAt: Date;
  updatedAt: Date;
}

export interface Depot {
  id: string;
  name: string;
  description: string;
  userId: string;
  createdAt: Date;
  updatedAt: Date;
}

export interface Transaction {
  id: string;
  accountId: string;
  type: 'buy' | 'sell' | 'deposit' | 'withdrawal' | 'dividend';
  title: string;
  description: string;
  amount: number;
  createdAt: Date;
  updatedAt: Date;
}

export interface Price {
  id: string;
  currency: string;
  type: 'fiats' | 'crypto' | 'stocks' | 'commodities' | 'etfs';
  usd: number;
  createdAt: Date;
  updatedAt: Date;
}