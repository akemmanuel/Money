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
import { addTransaction, getAssets } from '@/lib/storage';
import { useRouter } from 'next/navigation';
import { Asset } from '@/types';

export default function CreateTransaction() {
  const router = useRouter();
  const [assets, setAssets] = useState<Asset[]>([]);
  const [formData, setFormData] = useState({
    accountId: '',
    type: 'buy',
    title: '',
    description: '',
    amount: '',
  });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const loadAssets = () => {
      const loadedAssets = getAssets();
      setAssets(loadedAssets);
      
      // Set default asset if there's only one
      if (loadedAssets.length === 1) {
        setFormData(prev => ({
          ...prev,
          accountId: loadedAssets[0].id
        }));
      }
      
      setLoading(false);
    };
    
    loadAssets();
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
      addTransaction({
        accountId: formData.accountId,
        type: formData.type as 'buy' | 'sell' | 'deposit' | 'withdrawal' | 'dividend',
        title: formData.title,
        description: formData.description,
        amount: parseFloat(formData.amount) || 0,
      });
      
      router.push('/');
    } catch (error) {
      console.error('Error creating transaction:', error);
      alert('Failed to create transaction. Please try again.');
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
          <h1 className="text-3xl font-bold">Add New Transaction</h1>
          <p className="text-muted-foreground">Record a new financial transaction</p>
        </div>

        <Card className="hover:shadow-lg transition-all duration-300">
          <CardHeader className="bg-gradient-to-r from-primary/5 to-secondary/10 text-center">
            <CardTitle>Transaction Details</CardTitle>
            <p className="text-sm text-muted-foreground mt-1">
              Fill in the information about your transaction
            </p>
          </CardHeader>
          <CardContent className="pt-6">
            <form onSubmit={handleSubmit} className="space-y-6">
              <div className="space-y-2">
                <Label htmlFor="accountId">Asset</Label>
                <Select 
                  value={formData.accountId} 
                  onValueChange={(value) => handleSelectChange('accountId', value)}
                  required
                >
                  <SelectTrigger className="rounded-lg">
                    <SelectValue placeholder="Select an asset" />
                  </SelectTrigger>
                  <SelectContent>
                    {assets.map((asset) => (
                      <SelectItem key={asset.id} value={asset.id}>
                        {asset.name} ({asset.currency})
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              </div>

              <div className="space-y-2">
                <Label htmlFor="type">Transaction Type</Label>
                <Select 
                  value={formData.type} 
                  onValueChange={(value) => handleSelectChange('type', value)}
                  required
                >
                  <SelectTrigger className="rounded-lg">
                    <SelectValue placeholder="Select transaction type" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="buy">Buy</SelectItem>
                    <SelectItem value="sell">Sell</SelectItem>
                    <SelectItem value="deposit">Deposit</SelectItem>
                    <SelectItem value="withdrawal">Withdrawal</SelectItem>
                    <SelectItem value="dividend">Dividend</SelectItem>
                  </SelectContent>
                </Select>
              </div>

              <div className="space-y-2">
                <Label htmlFor="title">Title</Label>
                <Input
                  id="title"
                  name="title"
                  value={formData.title}
                  onChange={handleChange}
                  placeholder="e.g., Bitcoin purchase, Salary deposit, etc."
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
                  placeholder="Optional description of the transaction"
                  className="rounded-lg min-h-[100px]"
                />
              </div>

              <div className="space-y-2">
                <Label htmlFor="amount">Amount</Label>
                <Input
                  id="amount"
                  name="amount"
                  type="number"
                  step="any"
                  value={formData.amount}
                  onChange={handleChange}
                  placeholder="0.00"
                  required
                  className="rounded-lg"
                />
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
                  Add Transaction
                </Button>
              </div>
            </form>
          </CardContent>
        </Card>
      </div>
    </div>
  );
}