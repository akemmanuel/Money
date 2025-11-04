'use client';

import { useState, useEffect } from 'react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { 
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select';
import { addAsset } from '@/lib/storage';
import { getDepots } from '@/lib/storage';
import { useRouter } from 'next/navigation';
import { Depot } from '@/types';

export default function CreateAsset() {
  const router = useRouter();
  const [depots, setDepots] = useState<Depot[]>([]);
  const [formData, setFormData] = useState({
    depotId: '',
    name: '',
    description: '',
    balance: '',
    currency: 'USD',
    typeOfCurrency: 'fiats',
  });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const loadDepots = () => {
      const loadedDepots = getDepots();
      setDepots(loadedDepots);
      
      // Set default depot if there's only one
      if (loadedDepots.length === 1) {
        setFormData(prev => ({
          ...prev,
          depotId: loadedDepots[0].id
        }));
      }
      
      setLoading(false);
    };
    
    loadDepots();
  }, []);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleSelectChange = (name: string, value: string) => {
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    try {
      addAsset({
        depotId: formData.depotId,
        name: formData.name,
        description: formData.description,
        balance: parseFloat(formData.balance) || 0,
        currency: formData.currency,
        typeOfCurrency: formData.typeOfCurrency as 'fiats' | 'crypto' | 'stocks' | 'commodities' | 'etfs',
      });
      
      router.push('/assets');
    } catch (error) {
      console.error('Error creating asset:', error);
      alert('Failed to create asset. Please try again.');
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
      <div className="max-w-2xl mx-auto">
        <div className="mb-8 text-center">
          <h1 className="text-3xl font-bold">Add New Asset</h1>
          <p className="text-muted-foreground">Add a new financial asset to your portfolio</p>
        </div>

        <Card className="hover:shadow-lg transition-all duration-300">
          <CardHeader className="bg-gradient-to-r from-primary/5 to-secondary/10 text-center">
            <CardTitle>Asset Details</CardTitle>
            <p className="text-sm text-muted-foreground mt-1">
              Fill in the information about your new asset
            </p>
          </CardHeader>
          <CardContent className="pt-6">
            <form onSubmit={handleSubmit} className="space-y-6">
              <div className="space-y-2">
                <Label htmlFor="depotId">Depot</Label>
                <Select 
                  value={formData.depotId} 
                  onValueChange={(value) => handleSelectChange('depotId', value)}
                  required
                >
                  <SelectTrigger className="rounded-lg">
                    <SelectValue placeholder="Select a depot" />
                  </SelectTrigger>
                  <SelectContent>
                    {depots.map((depot) => (
                      <SelectItem key={depot.id} value={depot.id}>
                        {depot.name}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              </div>

              <div className="space-y-2">
                <Label htmlFor="name">Asset Name</Label>
                <Input
                  id="name"
                  name="name"
                  value={formData.name}
                  onChange={handleChange}
                  placeholder="e.g., Bitcoin, Apple Stock, etc."
                  required
                  className="rounded-lg"
                />
              </div>

              <div className="space-y-2">
                <Label htmlFor="description">Description</Label>
                <Textarea
                  id="description"
                  name="description"
                  value={formData.description}
                  onChange={handleChange}
                  placeholder="Optional description of the asset"
                  className="rounded-lg min-h-[100px]"
                />
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div className="space-y-2">
                  <Label htmlFor="balance">Balance/Quantity</Label>
                  <Input
                    id="balance"
                    name="balance"
                    type="number"
                    step="any"
                    value={formData.balance}
                    onChange={handleChange}
                    placeholder="0.00"
                    required
                    className="rounded-lg"
                  />
                </div>

                <div className="space-y-2">
                  <Label htmlFor="currency">Currency</Label>
                  <Input
                    id="currency"
                    name="currency"
                    value={formData.currency}
                    onChange={handleChange}
                    placeholder="e.g., USD, EUR, BTC"
                    required
                    className="rounded-lg"
                  />
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="typeOfCurrency">Asset Type</Label>
                <Select 
                  value={formData.typeOfCurrency} 
                  onValueChange={(value) => handleSelectChange('typeOfCurrency', value)}
                  required
                >
                  <SelectTrigger className="rounded-lg">
                    <SelectValue placeholder="Select asset type" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="fiats">Fiat Currency</SelectItem>
                    <SelectItem value="crypto">Cryptocurrency</SelectItem>
                    <SelectItem value="stocks">Stocks</SelectItem>
                    <SelectItem value="commodities">Commodities</SelectItem>
                    <SelectItem value="etfs">ETFs</SelectItem>
                  </SelectContent>
                </Select>
              </div>

              <div className="flex justify-center gap-4 pt-6">
                <Button
                  type="button"
                  variant="outline"
                  onClick={() => router.back()}
                  className="rounded-full px-6"
                >
                  Cancel
                </Button>
                <Button type="submit" className="rounded-full px-6">
                  Add Asset
                </Button>
              </div>
            </form>
          </CardContent>
        </Card>
      </div>
    </div>
  );
}