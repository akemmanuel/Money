'use client';

import { useState, useEffect } from 'react';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
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
  Share2,
  History
} from 'lucide-react';
import { getDepots, getAssets, getTransactions } from '@/lib/storage';
import { convertCurrency } from '@/lib/api';
import { getUserSettings } from '@/lib/storage';
import { Asset, Depot, Transaction } from '@/types';
import Link from 'next/link';

// Chart components
import { Area, AreaChart, CartesianGrid, XAxis } from 'recharts';
import {
  type ChartConfig,
  ChartContainer,
  ChartTooltip,
  ChartTooltipContent,
} from '@/components/ui/chart';

interface AssetWithValues extends Asset {
  convertedValue: number;
  changeValue: number;
  changePercentage: number;
  isPositive: boolean;
}

const chartConfig = {
  value: {
    label: "Portfolio Value",
    color: "var(--chart-1)",
  },
} satisfies ChartConfig;

export default function Dashboard() {
  const [depots, setDepots] = useState<Depot[]>([]);
  const [assets, setAssets] = useState<AssetWithValues[]>([]);
  const [transactions, setTransactions] = useState<Transaction[]>([]);
  const [totalValue, setTotalValue] = useState<number>(0);
  const [displayCurrency, setDisplayCurrency] = useState<string>('USD');
  const [timeRange, setTimeRange] = useState<string>('1W');
  const [historicalData, setHistoricalData] = useState<{ date: string; value: number }[]>([]);
  const [loading, setLoading] = useState<boolean>(true);

  const loadData = async () => {
    try {
      // Load data from localStorage
      const loadedDepots = getDepots();
      const loadedAssets = getAssets();
      const loadedTransactions = getTransactions();
      const userSettings = getUserSettings();
      
      setDepots(loadedDepots);
      setTransactions(loadedTransactions);
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
        const randomValue = Math.random();
        const changePercentage = (randomValue - 0.5) * 10; // Random change between -5% and 5%
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
      
      // Generate historical data
      const history = generateHistoricalData(total, timeRange);
      setHistoricalData(history);
      
      setLoading(false);
    } catch (error) {
      console.error('Error loading data:', error);
      setLoading(false);
    }
  };

  const generateHistoricalData = (currentValue: number, range: string): { date: string; value: number }[] => {
    const data = [];
    let days = 7; // Default to 1 week
    
    switch (range) {
      case '1W':
        days = 7;
        break;
      case '1M':
        days = 30;
        break;
      case 'YTD':
        const startOfYear = new Date(new Date().getFullYear(), 0, 1);
        days = Math.ceil((new Date().getTime() - startOfYear.getTime()) / (1000 * 60 * 60 * 24));
        break;
      case '1Y':
        days = 365;
        break;
      case '3Y':
        days = 365 * 3;
        break;
      case '5Y':
        days = 365 * 5;
        break;
      case 'MAX':
        days = 365 * 5; // Max 5 years for demo
        break;
    }
    
    // Generate mock historical data with some randomness
    let value = currentValue;
    for (let i = days; i >= 0; i--) {
      const date = new Date();
      date.setDate(date.getDate() - i);
      
      // Add some random fluctuation (-2% to +2%)
      const fluctuation = (Math.random() - 0.5) * 0.04;
      value = value * (1 + fluctuation);
      
      // Ensure value doesn't go too negative
      value = Math.max(value, currentValue * 0.5);
      
      data.push({
        date: date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' }),
        value: parseFloat(value.toFixed(2))
      });
    }
    
    return data;
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
  }, [loadData]);

  useEffect(() => {
    const history = generateHistoricalData(totalValue, timeRange);
    setHistoricalData(history);
  }, [timeRange, totalValue]);

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
              <Link href="/transactions/create">
                <History className="mr-2 h-4 w-4" />
                Add Transaction
              </Link>
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
          <Card>
            <CardHeader>
              <CardTitle>Portfolio Overview</CardTitle>
              <CardDescription>
                Showing portfolio value over time
              </CardDescription>
            </CardHeader>
            <CardContent>
              <ChartContainer config={chartConfig} className="h-[300px] w-full">
                <AreaChart
                  accessibilityLayer
                  data={historicalData}
                  margin={{
                    left: 12,
                    right: 12,
                  }}
                >
                  <CartesianGrid vertical={false} />
                  <XAxis
                    dataKey="date"
                    tickLine={false}
                    axisLine={false}
                    tickMargin={8}
                    tickFormatter={(value) => value.slice(0, 3)}
                  />
                  <ChartTooltip
                    cursor={false}
                    content={<ChartTooltipContent indicator="line" />}
                  />
                  <Area
                    dataKey="value"
                    type="natural"
                    fill="var(--color-value)"
                    fillOpacity={0.4}
                    stroke="var(--color-value)"
                  />
                </AreaChart>
              </ChartContainer>
            </CardContent>
            <CardFooter>
              <div className="flex w-full items-start gap-2 text-sm">
                <div className="grid gap-2">
                  <div className="flex items-center gap-2 leading-none font-medium">
                    Portfolio value trend <TrendingUp className="h-4 w-4" />
                  </div>
                  <div className="text-muted-foreground flex items-center gap-2 leading-none">
                    Historical data
                  </div>
                </div>
              </div>
            </CardFooter>
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
        
        {/* Transaction History */}
          <div className="mb-8">
            <div className="flex justify-between items-center mb-4">
              <h2 className="text-2xl font-bold">Recent Transactions</h2>
              <Button asChild variant="outline" size="sm">
                <Link href="/transactions/create">
                  <PlusCircle className="mr-2 h-4 w-4" />
                  Add Transaction
                </Link>
              </Button>
            </div>
            
            {transactions.length === 0 ? (
              <Card className="p-8 text-center">
                <History className="h-12 w-12 text-muted-foreground mx-auto mb-4" />
                <h3 className="text-lg font-medium mb-2">No transactions yet</h3>
                <p className="text-muted-foreground mb-4">Record your first transaction to get started</p>
                <Button asChild>
                  <Link href="/transactions/create">Add Transaction</Link>
                </Button>
              </Card>
            ) : (
              <Card>
                <CardContent className="p-0">
                  <div className="overflow-x-auto">
                    <table className="w-full">
                      <thead>
                        <tr className="border-b">
                          <th className="text-left p-4 font-medium text-muted-foreground">Date</th>
                          <th className="text-left p-4 font-medium text-muted-foreground">Description</th>
                          <th className="text-left p-4 font-medium text-muted-foreground">Type</th>
                          <th className="text-right p-4 font-medium text-muted-foreground">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        {[...transactions]
                          .sort((a, b) => new Date(b.createdAt).getTime() - new Date(a.createdAt).getTime())
                          .slice(0, 5)
                          .map((transaction) => {
                            // Find the associated asset
                            const asset = assets.find(a => a.id === transaction.accountId);
                            
                            return (
                              <tr key={transaction.id} className="border-b last:border-b-0 hover:bg-muted/50 transition-colors">
                                <td className="p-4">
                                  {new Date(transaction.createdAt).toLocaleDateString()}
                                </td>
                                <td className="p-4">
                                  <div className="font-medium">{transaction.title}</div>
                                  {asset && (
                                    <div className="text-sm text-muted-foreground">{asset.name}</div>
                                  )}
                                  {transaction.description && (
                                    <div className="text-sm text-muted-foreground mt-1">{transaction.description}</div>
                                  )}
                                </td>
                                <td className="p-4">
                                  <Badge variant={
                                    transaction.type === 'buy' || transaction.type === 'deposit' || transaction.type === 'dividend' 
                                      ? 'default' 
                                      : 'destructive'
                                  }>
                                    {transaction.type.charAt(0).toUpperCase() + transaction.type.slice(1)}
                                  </Badge>
                                </td>
                                <td className="p-4 text-right font-medium">
                                  {transaction.amount > 0 ? '+' : ''}{transaction.amount.toLocaleString()} {asset?.currency || ''}
                                </td>
                              </tr>
                            );
                          })}
                      </tbody>
                    </table>
                  </div>
                </CardContent>
              </Card>
            )}
          </div>
      </main>
    </div>
  );
}