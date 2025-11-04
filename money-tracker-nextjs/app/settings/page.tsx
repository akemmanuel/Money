'use client';

import { useState, useEffect } from 'react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Badge } from '@/components/ui/badge';
import { 
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select';
import { getUserSettings, saveUserSettings, getDepots, addDepot, getAssets } from '@/lib/storage';
import { Depot } from '@/types';

export default function Settings() {
  const [displayCurrency, setDisplayCurrency] = useState('USD');
  const [depots, setDepots] = useState<Depot[]>([]);
  const [newDepotName, setNewDepotName] = useState('');
  const [newDepotDescription, setNewDepotDescription] = useState('');

  useEffect(() => {
    const loadSettings = () => {
      const settings = getUserSettings();
      setDisplayCurrency(settings.displayCurrency);
      
      const loadedDepots = getDepots();
      setDepots(loadedDepots);
    };
    
    loadSettings();
  }, []);

  // Helper function to count assets in a depot
  const getDepotAssetCount = (depotId: string) => {
    const assets = getAssets();
    return assets.filter(asset => asset.depotId === depotId).length;
  };

  const handleCurrencyChange = (value: string) => {
    setDisplayCurrency(value);
    saveUserSettings({ displayCurrency: value });
  };

  const handleAddDepot = () => {
    if (!newDepotName.trim()) return;
    
    try {
      const newDepot = addDepot({
        name: newDepotName,
        description: newDepotDescription,
      });
      
      setDepots(prev => [...prev, newDepot]);
      setNewDepotName('');
      setNewDepotDescription('');
    } catch (error) {
      console.error('Error adding depot:', error);
      alert('Failed to add depot. Please try again.');
    }
  };

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="mb-8">
        <h1 className="text-3xl font-bold">Settings</h1>
        <p className="text-muted-foreground">Manage your preferences and account settings</p>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {/* Display Settings */}
        <Card className="hover:shadow-lg transition-all duration-300">
          <CardHeader className="bg-gradient-to-r from-primary/5 to-secondary/10">
            <CardTitle>Display Settings</CardTitle>
          </CardHeader>
          <CardContent className="space-y-6 pt-6">
            <div className="space-y-2">
              <Label htmlFor="displayCurrency">Display Currency</Label>
              <Select value={displayCurrency} onValueChange={handleCurrencyChange}>
                <SelectTrigger className="rounded-lg">
                  <SelectValue placeholder="Select currency" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="USD">US Dollar (USD)</SelectItem>
                  <SelectItem value="EUR">Euro (EUR)</SelectItem>
                  <SelectItem value="GBP">British Pound (GBP)</SelectItem>
                  <SelectItem value="JPY">Japanese Yen (JPY)</SelectItem>
                  <SelectItem value="CAD">Canadian Dollar (CAD)</SelectItem>
                  <SelectItem value="AUD">Australian Dollar (AUD)</SelectItem>
                  <SelectItem value="CHF">Swiss Franc (CHF)</SelectItem>
                  <SelectItem value="CNY">Chinese Yuan (CNY)</SelectItem>
                  <SelectItem value="PYG">Paraguayan Guarani (PYG)</SelectItem>
                </SelectContent>
              </Select>
              <p className="text-sm text-muted-foreground">
                Choose the currency for displaying values throughout the application.
              </p>
            </div>
          </CardContent>
        </Card>

        {/* Depot Management */}
        <Card className="hover:shadow-lg transition-all duration-300">
          <CardHeader className="bg-gradient-to-r from-primary/5 to-secondary/10">
            <CardTitle>Depot Management</CardTitle>
          </CardHeader>
          <CardContent className="space-y-6 pt-6">
            <div>
              <h3 className="text-lg font-medium mb-4">Your Depots</h3>
              {depots.length === 0 ? (
                <div className="text-center py-6 rounded-lg border border-dashed">
                  <p className="text-muted-foreground">You haven&apos;t created any depots yet.</p>
                  <Button variant="outline" size="sm" className="mt-3 rounded-full">
                    Create Your First Depot
                  </Button>
                </div>
              ) : (
                <div className="space-y-3">
                  {depots.map((depot) => (
                    <div 
                      key={depot.id} 
                      className="flex items-center justify-between p-4 bg-muted rounded-lg hover:bg-muted/80 transition-colors"
                    >
                      <div>
                        <div className="font-medium">{depot.name}</div>
                        {depot.description && (
                          <div className="text-sm text-muted-foreground mt-1">{depot.description}</div>
                        )}
                      </div>
                      <div className="flex items-center gap-2">
                        <Badge variant="secondary" className="rounded-full">
                          {getDepotAssetCount(depot.id)} assets
                        </Badge>
                      </div>
                    </div>
                  ))}
                </div>
              )}
            </div>

            <div className="pt-6 border-t">
              <h3 className="text-lg font-medium mb-4">Create New Depot</h3>
              <div className="space-y-4">
                <div className="space-y-2">
                  <Label htmlFor="depotName">Depot Name</Label>
                  <Input
                    id="depotName"
                    value={newDepotName}
                    onChange={(e) => setNewDepotName(e.target.value)}
                    placeholder="e.g., Personal, Retirement, etc."
                    className="rounded-lg"
                  />
                </div>
                
                <div className="space-y-2">
                  <Label htmlFor="depotDescription">Description</Label>
                  <Input
                    id="depotDescription"
                    value={newDepotDescription}
                    onChange={(e) => setNewDepotDescription(e.target.value)}
                    placeholder="Optional description"
                    className="rounded-lg"
                  />
                </div>
                
                <Button 
                  onClick={handleAddDepot}
                  disabled={!newDepotName.trim()}
                  className="rounded-full"
                >
                  Add Depot
                </Button>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  );
}