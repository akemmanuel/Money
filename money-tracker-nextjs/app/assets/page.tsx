'use client';

import { useState, useEffect } from 'react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { 
  Wallet, 
  Bitcoin, 
  TrendingUp, 
  Droplets,
  PlusCircle,
  Edit,
  Trash2
} from 'lucide-react';
import { getAssets, getDepots, deleteAsset } from '@/lib/storage';
import { convertCurrency } from '@/lib/api';
import { getUserSettings } from '@/lib/storage';
import { Asset } from '@/types';
import Link from 'next/link';

interface AssetWithValues extends Asset {
  convertedValue: number;
  depotName: string;
}

export default function Assets() {
  const [assets, setAssets] = useState<AssetWithValues[]>([]);
  const [displayCurrency, setDisplayCurrency] = useState<string>('USD');
  const [loading, setLoading] = useState<boolean>(true);

  const loadData = async () => {
    try {
      // Load data from localStorage
      const loadedAssets = getAssets();
      const loadedDepots = getDepots();
      const userSettings = getUserSettings();
      
      setDisplayCurrency(userSettings.displayCurrency);
      
      // Create depot lookup
      const depotMap: Record<string, string> = {};
      loadedDepots.forEach(depot => {
        depotMap[depot.id] = depot.name;
      });
      
      // Calculate converted values for assets
      const assetsWithValues: AssetWithValues[] = [];
      
      for (const asset of loadedAssets) {
        const convertedValue = await convertCurrency(
          asset.balance, 
          asset.currency, 
          asset.typeOfCurrency, 
          userSettings.displayCurrency
        );
        
        assetsWithValues.push({
          ...asset,
          convertedValue,
          depotName: depotMap[asset.depotId] || 'Unknown Depot'
        });
      }
      
      setAssets(assetsWithValues);
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

  const handleDelete = (id: string) => {
    if (confirm('Are you sure you want to delete this asset?')) {
      deleteAsset(id);
      loadData(); // Reload data after deletion
    }
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
        return <Droplets className="h-5 w-5" />;
      default:
        return <Wallet className="h-5 w-5" />;
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
          <h1 className="text-3xl font-bold">Assets</h1>
          <p className="text-muted-foreground">Manage your financial assets</p>
        </div>
        <Button asChild size="lg" className="rounded-full">
          <Link href="/assets/create">
            <PlusCircle className="mr-2 h-4 w-4" />
            Add Asset
          </Link>
        </Button>
      </div>

      {assets.length === 0 ? (
        <div className="text-center py-12">
          <div className="mx-auto h-24 w-24 rounded-full bg-gradient-to-br from-primary/10 to-secondary/20 flex items-center justify-center mb-6">
            <Wallet className="h-12 w-12 text-primary" />
          </div>
          <h3 className="text-xl font-semibold mb-2">No assets found</h3>
          <p className="text-muted-foreground mb-6 max-w-md mx-auto">
            Add your first asset to start tracking your finances.
          </p>
          <Button asChild className="rounded-full">
            <Link href="/assets/create">Add Asset</Link>
          </Button>
        </div>
      ) : (
        <Card className="overflow-hidden">
          <CardHeader className="bg-gradient-to-r from-primary/5 to-secondary/10">
            <CardTitle>All Assets</CardTitle>
          </CardHeader>
          <CardContent className="p-0">
            <div className="overflow-x-auto">
              <table className="w-full">
                <thead>
                  <tr className="border-b">
                    <th className="text-left p-4 font-medium text-muted-foreground">Name</th>
                    <th className="text-left p-4 font-medium text-muted-foreground">Depot</th>
                    <th className="text-left p-4 font-medium text-muted-foreground">Type</th>
                    <th className="text-left p-4 font-medium text-muted-foreground">Balance</th>
                    <th className="text-left p-4 font-medium text-muted-foreground">Value</th>
                    <th className="text-right p-4 font-medium text-muted-foreground">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  {assets.map((asset) => (
                    <tr key={asset.id} className="border-b last:border-b-0 hover:bg-muted/50 transition-colors">
                      <td className="p-4">
                        <div className="flex items-center gap-3">
                          <div className={`p-2 rounded-lg ${getAssetIconBg(asset.typeOfCurrency)}`}>
                            {getAssetIcon(asset.typeOfCurrency)}
                          </div>
                          <span className="font-medium">{asset.name}</span>
                        </div>
                      </td>
                      <td className="p-4">{asset.depotName}</td>
                      <td className="p-4 capitalize">{asset.typeOfCurrency}</td>
                      <td className="p-4">{asset.balance.toLocaleString()} {asset.currency}</td>
                      <td className="p-4 font-medium">
                        {asset.convertedValue.toLocaleString(undefined, {
                          minimumFractionDigits: 2,
                          maximumFractionDigits: 2
                        })} {displayCurrency}
                      </td>
                      <td className="p-4 text-right">
                        <div className="flex justify-end gap-2">
                          <Button variant="outline" size="sm" asChild className="rounded-full">
                            <Link href={`/assets/edit/${asset.id}`}>
                              <Edit className="h-4 w-4" />
                            </Link>
                          </Button>
                          <Button 
                            variant="outline" 
                            size="sm" 
                            onClick={() => handleDelete(asset.id)}
                            className="rounded-full"
                          >
                            <Trash2 className="h-4 w-4" />
                          </Button>
                        </div>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </CardContent>
        </Card>
      )}
    </div>
  );
}