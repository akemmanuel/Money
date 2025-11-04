'use client';

import { useState, useEffect } from 'react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { getDepots, getAssets } from '@/lib/storage';
import Link from 'next/link';
import { Depot, Asset } from '@/types';

export default function DepotsPage() {
  const [depots, setDepots] = useState<Depot[]>([]);
  const [assets, setAssets] = useState<Asset[]>([]);

  useEffect(() => {
    const loadData = () => {
      setDepots(getDepots());
      setAssets(getAssets());
    };
    
    loadData();
  }, []);

  const getAssetCountForDepot = (depotId: string) => {
    return assets.filter(asset => asset.depotId === depotId).length;
  };

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="flex justify-between items-center mb-8">
        <div>
          <h1 className="text-3xl font-bold">Depots</h1>
          <p className="text-muted-foreground">Manage your portfolio depots</p>
        </div>
        <Link href="/depots/create">
          <Button>Add Depot</Button>
        </Link>
      </div>

      {depots.length === 0 ? (
        <Card className="text-center py-12">
          <CardContent>
            <h3 className="text-lg font-semibold mb-2">No depots found</h3>
            <p className="text-muted-foreground mb-4">
              Create your first depot to start organizing your assets.
            </p>
            <Link href="/depots/create">
              <Button>Add Depot</Button>
            </Link>
          </CardContent>
        </Card>
      ) : (
        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {depots.map((depot) => (
            <Card key={depot.id} className="hover:shadow-lg transition-all duration-300">
              <CardHeader>
                <div className="flex justify-between items-start">
                  <CardTitle className="text-xl">{depot.name}</CardTitle>
                  <Badge variant="secondary">
                    {getAssetCountForDepot(depot.id)} assets
                  </Badge>
                </div>
              </CardHeader>
              <CardContent>
                <p className="text-muted-foreground mb-4">
                  {depot.description || 'No description provided'}
                </p>
                <div className="text-sm text-muted-foreground">
                  Created: {new Date(depot.createdAt).toLocaleDateString()}
                </div>
              </CardContent>
            </Card>
          ))}
        </div>
      )}
    </div>
  );
}