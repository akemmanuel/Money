'use client';

import { useState } from 'react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { addDepot } from '@/lib/storage';
import { useRouter } from 'next/navigation';

export default function CreateDepot() {
  const router = useRouter();
  const [formData, setFormData] = useState({
    name: '',
    description: '',
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    try {
      addDepot({
        name: formData.name,
        description: formData.description,
      });
      
      router.push('/assets');
    } catch (error) {
      console.error('Error creating depot:', error);
      alert('Failed to create depot. Please try again.');
    }
  };

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="max-w-2xl mx-auto">
        <div className="mb-8 text-center">
          <h1 className="text-3xl font-bold">Add New Depot</h1>
          <p className="text-muted-foreground">Create a new depot to organize your assets</p>
        </div>

        <Card className="hover:shadow-lg transition-all duration-300">
          <CardHeader className="bg-gradient-to-r from-primary/5 to-secondary/10 text-center">
            <CardTitle>Depot Details</CardTitle>
            <p className="text-sm text-muted-foreground mt-1">
              Fill in the information about your new depot
            </p>
          </CardHeader>
          <CardContent className="pt-6">
            <form onSubmit={handleSubmit} className="space-y-6">
              <div className="space-y-2">
                <Label htmlFor="name">Depot Name</Label>
                <Input
                  id="name"
                  name="name"
                  value={formData.name}
                  onChange={handleChange}
                  placeholder="e.g., Main Portfolio, Retirement Account, etc."
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
                  placeholder="Optional description of the depot"
                  className="rounded-lg min-h-[100px]"
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
                  Add Depot
                </Button>
              </div>
            </form>
          </CardContent>
        </Card>
      </div>
    </div>
  );
}