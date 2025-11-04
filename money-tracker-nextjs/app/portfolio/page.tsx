'use client';

import { useState, useEffect } from 'react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { 
  Wallet, 
  Bitcoin, 
  TrendingUp, 
  Droplets,
  PlusCircle
} from 'lucide-react';
import { getDepots, getAssets } from '@/lib/storage';
import { convertCurrency } from '@/lib/api';
import { getUserSettings } from '@/lib/storage';
import { Asset, Depot } from '@/types';
import Link from 'next/link';

interface AssetWithValues extends Asset {
  convertedValue: number;
}

export default function Portfolio() {
  const [depots, setDepots] = useState<Depot[]>([]);
  const [assets, setAssets] = useState<AssetWithValues[]>([]);
  const [totalValue, setTotalValue] = useState<number>(0);
  const [displayCurrency, setDisplayCurrency] = useState<string>('USD');
  const [loading, setLoading] = useState<boolean>(true);

  const loadData = async () => {
    try {
      // Load data from localStorage
      const loadedDepots = getDepots();
      const loadedAssets = getAssets();
      const userSettings = getUserSettings();
      
      setDepots(loadedDepots);
      setDisplayCurrency(userSettings.displayCurrency);
      
      // Calculate converted values for assets
      const assetsWithValues: AssetWithValues[] = [];
      let total = 0;
      
      for (const asset of loadedAssets) {
        const convertedValue = await convertCurrency(
          asset.balance, 
          asset.currency, 
          asset.typeOfCurrency, 
          userSettings.displayCurrency
        );
        
        assetsWithValues.push({
          ...asset,
          convertedValue
        });
        
        total += convertedValue;
      }
      
      setAssets(assetsWithValues);
      setTotalValue(total);
      setLoading(false);
    } catch (error) {
      console.error('Error loading data:', error);
      setLoading(false);
    }
  };

  useEffect(() => {
    let isMounted = true;
    
    const initialize = async () => {
      if (isMounted) {
        await loadData();
      }
    };
    
    initialize();
    
    return () => {
      isMounted = false;
    };
  }, []);

  const getAssetIcon = (type: string) => {
    switch (type) {
      case 'fiats':
        return <Wallet className="h-6 w-6" />;
      case 'crypto':
        return <Bitcoin className="h-6 w-6" />;
      case 'stocks':
        return <TrendingUp className="h-6 w-6" />;
      case 'commodities':
        return <Droplets className="h-6 w-6" />;
      default:
        return <Wallet className="h-6 w-6" />;
    }
  };

  const getAssetIconBg = (type: string) => {
    switch (type) {
      case 'fiats':
        return 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300';
      case 'crypto':
        return 'bg-orange-100 text-orange-600 dark:bg-orange-900 dark:text-orange-300';
      case 'stocks':
        return 'bg-green-100 text-green-600 dark:bg-green-900 dark:text-green-300';
      case 'commodities':
        return 'bg-purple-100 text-purple-600 dark:bg-purple-900 dark:text-purple-300';
      default:
        return 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300';
    }
  };

  if (loading) {
    return (
      <div className="flex items-center justify-center min-h-screen">
        <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-primary"></div>
      </div>
    );
  }

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="flex justify-between items-center mb-8 flex-wrap gap-4">
        <div>
          <h1 className="text-3xl font-bold">Portfolio</h1>
          <p className="text-muted-foreground">Manage your assets and investments</p>
        </div>
        <Button asChild size="lg" className="rounded-full">
          <Link href="/assets/create">
            <PlusCircle className="mr-2 h-4 w-4" />
            Add Asset
          </Link>
        </Button>
      </div>

      {depots.length === 0 ? (
        <div className="text-center py-12">
          <div className="mx-auto h-24 w-24 rounded-full bg-gradient-to-br from-primary/10 to-secondary/20 flex items-center justify-center mb-6">
            <Wallet className="h-12 w-12 text-primary" />
          </div>
          <h3 className="text-xl font-semibold mb-2">Your portfolio is empty</h3>
          <p className="text-muted-foreground mb-6 max-w-md mx-auto">
            Add your first asset and start building your portfolio.
          </p>
          <Button asChild className="rounded-full">
            <Link href="/assets/create">Add Asset</Link>
          </Button>
        </div>
      ) : (
        <>
          {/* Total Portfolio Value */}
          <div className="text-center mb-12">
            <h2 className="text-2xl font-semibold mb-2">Total Portfolio Value</h2>
            <div className="text-4xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
              {totalValue.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
              })} {displayCurrency}
            </div>
          </div>

          {/* Depot Cards */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {depots.map((depot) => {
              const depotAssets = assets.filter(asset => asset.depotId === depot.id);
              const depotTotalValue = depotAssets.reduce((sum, asset) => sum + asset.convertedValue, 0);
              
              return (
                <Card key={depot.id} className="hover:shadow-lg transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                  <CardHeader className="bg-gradient-to-r from-primary/5 to-secondary/10">
                    <CardTitle className="flex justify-between items-center">
                      <span className="truncate font-bold text-lg">{depot.name}</span>
                    </CardTitle>
                    <div className="text-2xl font-bold text-primary">
                      {depotTotalValue.toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                      })} {displayCurrency}
                    </div>
                  </CardHeader>
                  <CardContent className="pt-4">
                    {depotAssets.length === 0 ? (
                      <div className="text-center py-6">
                        <p className="text-muted-foreground text-sm">
                          This depot has no assets yet.
                        </p>
                        <Button variant="outline" size="sm" asChild className="mt-3 rounded-full">
                          <Link href="/assets/create">Add Asset</Link>
                        </Button>
                      </div>
                    ) : (
                      <div className="space-y-4">
                        {depotAssets.map((asset) => (
                          <div 
                            key={asset.id} 
                            className="flex items-center justify-between p-3 rounded-lg hover:bg-muted transition-colors cursor-pointer group"
                          >
                            <div className="flex items-center gap-3">
                              <div className={`p-2 rounded-lg ${getAssetIconBg(asset.typeOfCurrency)}`}>
                                {getAssetIcon(asset.typeOfCurrency)}
                              </div>
                              <div>
                                <div className="font-medium group-hover:text-primary transition-colors">{asset.name}</div>
                                <div className="text-sm text-muted-foreground">
                                  {asset.balance.toLocaleString()} {asset.currency}
                                </div>
                              </div>
                            </div>
                            <div className="font-semibold text-right">
                              <div>
                                {asset.convertedValue.toLocaleString(undefined, {
                                  minimumFractionDigits: 2,
                                  maximumFractionDigits: 2
                                })} {displayCurrency}
                              </div>
                              <div className="text-xs text-muted-foreground">
                                {((asset.convertedValue / depotTotalValue) * 100).toFixed(1)}%
                              </div>
                            </div>
                          </div>
                        ))}
                      </div>
                    )}
                  </CardContent>
                </Card>
              );
            })}
          </div>
        </>
      )}
    </div>
  );
}