import { Asset, Depot, Transaction } from '@/types';

const STORAGE_KEYS = {
  ASSETS: 'moneyTrackerAssets',
  DEPOTS: 'moneyTrackerDepots',
  TRANSACTIONS: 'moneyTrackerTransactions',
  USER_SETTINGS: 'moneyTrackerUserSettings',
};

// Generic storage functions
const getFromStorage = <T>(key: string, defaultValue: T): T => {
  if (typeof window === 'undefined') return defaultValue;
  
  try {
    const item = localStorage.getItem(key);
    return item ? JSON.parse(item) : defaultValue;
  } catch (error) {
    console.error(`Error reading from localStorage key "${key}":`, error);
    return defaultValue;
  }
};

const saveToStorage = <T>(key: string, data: T): void => {
  if (typeof window === 'undefined') return;
  
  try {
    localStorage.setItem(key, JSON.stringify(data));
  } catch (error) {
    console.error(`Error saving to localStorage key "${key}":`, error);
  }
};

// Asset operations
export const getAssets = (): Asset[] => {
  return getFromStorage<Asset[]>(STORAGE_KEYS.ASSETS, []);
};

export const saveAssets = (assets: Asset[]): void => {
  saveToStorage(STORAGE_KEYS.ASSETS, assets);
};

export const addAsset = (asset: Omit<Asset, 'id' | 'createdAt' | 'updatedAt'>): Asset => {
  const assets = getAssets();
  const newAsset: Asset = {
    ...asset,
    id: Date.now().toString(),
    createdAt: new Date(),
    updatedAt: new Date(),
  };
  saveAssets([...assets, newAsset]);
  return newAsset;
};

export const updateAsset = (id: string, updates: Partial<Asset>): Asset | null => {
  const assets = getAssets();
  const index = assets.findIndex(asset => asset.id === id);
  
  if (index === -1) return null;
  
  const updatedAsset = {
    ...assets[index],
    ...updates,
    updatedAt: new Date(),
  };
  
  assets[index] = updatedAsset;
  saveAssets(assets);
  return updatedAsset;
};

export const deleteAsset = (id: string): boolean => {
  const assets = getAssets();
  const initialLength = assets.length;
  const filteredAssets = assets.filter(asset => asset.id !== id);
  
  if (filteredAssets.length === initialLength) return false;
  
  saveAssets(filteredAssets);
  return true;
};

// Depot operations
export const getDepots = (): Depot[] => {
  return getFromStorage<Depot[]>(STORAGE_KEYS.DEPOTS, []);
};

export const saveDepots = (depots: Depot[]): void => {
  saveToStorage(STORAGE_KEYS.DEPOTS, depots);
};

export const addDepot = (depot: Omit<Depot, 'id' | 'createdAt' | 'updatedAt' | 'userId'>): Depot => {
  const depots = getDepots();
  const newDepot: Depot = {
    ...depot,
    id: Date.now().toString(),
    userId: 'user1', // In a real app, this would come from auth
    createdAt: new Date(),
    updatedAt: new Date(),
  };
  saveDepots([...depots, newDepot]);
  return newDepot;
};

export const updateDepot = (id: string, updates: Partial<Depot>): Depot | null => {
  const depots = getDepots();
  const index = depots.findIndex(depot => depot.id === id);
  
  if (index === -1) return null;
  
  const updatedDepot = {
    ...depots[index],
    ...updates,
    updatedAt: new Date(),
  };
  
  depots[index] = updatedDepot;
  saveDepots(depots);
  return updatedDepot;
};

export const deleteDepot = (id: string): boolean => {
  const depots = getDepots();
  const initialLength = depots.length;
  const filteredDepots = depots.filter(depot => depot.id !== id);
  
  if (filteredDepots.length === initialLength) return false;
  
  saveDepots(filteredDepots);
  return true;
};

// Transaction operations
export const getTransactions = (): Transaction[] => {
  return getFromStorage<Transaction[]>(STORAGE_KEYS.TRANSACTIONS, []);
};

export const saveTransactions = (transactions: Transaction[]): void => {
  saveToStorage(STORAGE_KEYS.TRANSACTIONS, transactions);
};

export const addTransaction = (transaction: Omit<Transaction, 'id' | 'createdAt' | 'updatedAt'>): Transaction => {
  const transactions = getTransactions();
  const newTransaction: Transaction = {
    ...transaction,
    id: Date.now().toString(),
    createdAt: new Date(),
    updatedAt: new Date(),
  };
  saveTransactions([...transactions, newTransaction]);
  return newTransaction;
};

// User settings
export const getUserSettings = (): { displayCurrency: string } => {
  return getFromStorage<{ displayCurrency: string }>(STORAGE_KEYS.USER_SETTINGS, { displayCurrency: 'USD' });
};

export const saveUserSettings = (settings: { displayCurrency: string }): void => {
  saveToStorage(STORAGE_KEYS.USER_SETTINGS, settings);
};