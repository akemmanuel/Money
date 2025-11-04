'use client';

import { useState, useEffect } from 'react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Tabs, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { 
  TrendingUp, 
  TrendingDown, 
  Wallet, 
  Bitcoin, 
  Activity,
  PlusCircle,
  Share2
} from 'lucide-react';
import { getDepots, getAssets } from '@/lib/storage';
import { convertCurrency } from '@/lib/api';
import { getUserSettings } from '@/lib/storage';
import { Asset, Depot } from '@/types';
import Link from 'next/link';

interface AssetWithValues extends Asset {
  convertedValue: number;
  changeValue: number;
  changePercentage: number;
  isPositive: boolean;
}

export default function Dashboard() {
  const [depots, setDepots] = useState<Depot[]>([]);
  const [assets, setAssets] = useState<AssetWithValues[]>([]);
  const [totalValue, setTotalValue] = useState<number>(0);
  const [displayCurrency, setDisplayCurrency] = useState<string>('USD');
  const [timeRange, setTimeRange] = useState<string>('1W');
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
        
        // Generate mock change data
        const changePercentage = (Math.random() - 0.5) * 10; // Random change between -5% and 5%
        const isPositive = changePercentage >= 0;
        const changeValue = convertedValue * (changePercentage / 100);
        
        assetsWithValues.push({
          ...asset,
          convertedValue,
          changeValue,
          changePercentage,
          isPositive
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

  const handleTimeRangeChange = (value: string) => {
    setTimeRange(value);
  };

  const getAssetIcon = (type: string) => {
    switch (type) {
      case 'fiats':
        return <Wallet className="h-5 w-5" />;
      case 'crypto':
        return <Bitcoin className="h-5 w-5" />;
      case 'stocks':
        return <TrendingUp className="h-5 w-5" />;
      case 'commodities':
        return <Activity className="h-5 w-5" />;
      default:
        return <Wallet className="h-5 w-5" />;
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
    <div className="flex flex-col min-h-screen">
      <main className="flex-grow container mx-auto px-4 py-8">
        <div className="flex justify-between items-center mb-8 flex-wrap gap-4">
          <div>
            <h1 className="text-3xl font-bold">Dashboard</h1>
            <p className="text-muted-foreground">Welcome back! Here&apos;s your financial overview.</p>
          </div>
          <div className="flex items-center gap-3 flex-wrap">
            <Button variant="outline" size="lg" className="rounded-full">
              <Share2 className="mr-2 h-4 w-4" />
              Share
            </Button>
            <Button asChild size="lg" className="rounded-full">
              <Link href="/assets/create">
                <PlusCircle className="mr-2 h-4 w-4" />
                Add Asset
              </Link>
            </Button>
          </div>
        </div>

        {/* Summary Cards */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <Card className="hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium">Total Portfolio Value</CardTitle>
              <Wallet className="h-5 w-5 text-muted-foreground" />
            </CardHeader>
            <CardContent>
              <div className="text-2xl font-bold">
                {totalValue.toLocaleString(undefined, {
                  minimumFractionDigits: 2,
                  maximumFractionDigits: 2
                })} {displayCurrency}
              </div>
              <p className="text-xs text-muted-foreground mt-1">
                <span className="text-green-500 font-medium">+12%</span> from last month
              </p>
            </CardContent>
          </Card>

          <Card className="hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium">Cash</CardTitle>
              <Wallet className="h-5 w-5 text-muted-foreground" />
            </CardHeader>
            <CardContent>
              <div className="text-2xl font-bold">0.97 {displayCurrency}</div>
              <p className="text-xs text-muted-foreground mt-1">Available funds</p>
            </CardContent>
          </Card>

          <Card className="hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium">Holdings</CardTitle>
              <TrendingUp className="h-5 w-5 text-muted-foreground" />
            </CardHeader>
            <CardContent>
              <div className="text-2xl font-bold">0.03 {displayCurrency}</div>
              <p className="text-xs text-muted-foreground mt-1">Invested assets</p>
            </CardContent>
          </Card>

          <Card className="hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium">Capital Gain</CardTitle>
              <TrendingDown className="h-5 w-5 text-muted-foreground" />
            </CardHeader>
            <CardContent>
              <div className="text-2xl font-bold">-0.000446 {displayCurrency}</div>
              <p className="text-xs text-muted-foreground mt-1">Unrealized gains/losses</p>
            </CardContent>
          </Card>
        </div>

        {/* Time Range Selector */}
        <div className="flex justify-center mb-8">
          <Tabs value={timeRange} onValueChange={handleTimeRangeChange}>
            <TabsList className="bg-muted rounded-full p-1">
              <TabsTrigger value="1W" className="rounded-full px-4 py-2 text-sm">1W</TabsTrigger>
              <TabsTrigger value="1M" className="rounded-full px-4 py-2 text-sm">1M</TabsTrigger>
              <TabsTrigger value="YTD" className="rounded-full px-4 py-2 text-sm">YTD</TabsTrigger>
              <TabsTrigger value="1Y" className="rounded-full px-4 py-2 text-sm">1Y</TabsTrigger>
              <TabsTrigger value="3Y" className="rounded-full px-4 py-2 text-sm">3Y</TabsTrigger>
              <TabsTrigger value="5Y" className="rounded-full px-4 py-2 text-sm">5Y</TabsTrigger>
              <TabsTrigger value="MAX" className="rounded-full px-4 py-2 text-sm">MAX</TabsTrigger>
            </TabsList>
          </Tabs>
        </div>

        {/* Portfolio Overview */}
        <div className="mb-8">
          <h2 className="text-2xl font-bold mb-4">Portfolio Overview</h2>
          <Card className="overflow-hidden">
            <CardContent className="p-6">
              <div className="h-64 flex items-center justify-center bg-gradient-to-br from-primary/5 to-secondary/10 rounded-lg">
                <div className="text-center">
                  <Activity className="h-12 w-12 text-muted-foreground mx-auto mb-3" />
                  <p className="text-muted-foreground font-medium">Portfolio Performance</p>
                  <p className="text-sm text-muted-foreground mt-1">Visualization coming soon</p>
                </div>
              </div>
            </CardContent>
          </Card>
        </div>

        {/* Assets by Depot */}
        {depots.map((depot) => {
          const depotAssets = assets.filter(asset => asset.depotId === depot.id);
          
          if (depotAssets.length === 0) return null;
          
          // Calculate total value for this depot
          const depotTotalValue = depotAssets.reduce((sum, asset) => sum + asset.convertedValue, 0);
          
          return (
            <div key={depot.id} className="mb-8">
              <div className="flex justify-between items-center mb-4">
                <h2 className="text-2xl font-bold">{depot.name}</h2>
              </div>
              
              <Card>
                <CardContent className="p-0">
                  <div className="overflow-x-auto">
                    <table className="w-full">
                      <thead>
                        <tr className="border-b">
                          <th className="text-left p-4 font-medium text-muted-foreground">Name</th>
                          <th className="text-left p-4 font-medium text-muted-foreground">Quantity</th>
                          <th className="text-left p-4 font-medium text-muted-foreground">Total Value</th>
                          <th className="text-left p-4 font-medium text-muted-foreground">Change</th>
                          <th className="text-left p-4 font-medium text-muted-foreground">Allocation</th>
                        </tr>
                      </thead>
                      <tbody>
                        {depotAssets.map((asset) => {
                          const allocation = depotTotalValue > 0 ? (asset.convertedValue / depotTotalValue) * 100 : 0;
                          
                          return (
                            <tr key={asset.id} className="border-b last:border-b-0 hover:bg-muted/50 transition-colors">
                              <td className="p-4">
                                <div className="flex items-center gap-3">
                                  <div className="p-2 bg-primary/10 rounded-lg">
                                    {getAssetIcon(asset.typeOfCurrency)}
                                  </div>
                                  <span className="font-medium">{asset.name}</span>
                                </div>
                              </td>
                              <td className="p-4">{asset.balance.toLocaleString()}</td>
                              <td className="p-4 font-medium">
                                {asset.convertedValue.toLocaleString(undefined, {
                                  minimumFractionDigits: 2,
                                  maximumFractionDigits: 2
                                })} {displayCurrency}
                              </td>
                              <td className="p-4">
                                <Badge 
                                  variant={asset.isPositive ? "default" : "destructive"}
                                  className="gap-1 rounded-full"
                                >
                                  {asset.isPositive ? (
                                    <TrendingUp className="h-3 w-3" />
                                  ) : (
                                    <TrendingDown className="h-3 w-3" />
                                  )}
                                  {asset.changePercentage.toFixed(2)}%
                                </Badge>
                              </td>
                              <td className="p-4">
                                <div className="flex items-center gap-2">
                                  <div className="w-16 bg-muted rounded-full h-2">
                                    <div 
                                      className="bg-primary h-2 rounded-full" 
                                      style={{ width: `${Math.min(allocation, 100)}%` }}
                                    ></div>
                                  </div>
                                  <span>{allocation.toFixed(1)}%</span>
                                </div>
                              </td>
                            </tr>
                          );
                        })}
                      </tbody>
                    </table>
                  </div>
                </CardContent>
              </Card>
            </div>
          );
        })}
      </main>
    </div>
  );
}