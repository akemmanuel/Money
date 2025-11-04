'use client';

import React, { useRef, useEffect } from 'react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

interface ChartProps {
  data: { date: string; value: number }[];
  title?: string;
  height?: number;
}

export function Chart({ data, title, height = 200 }: ChartProps) {
  const canvasRef = useRef<HTMLCanvasElement>(null);

  useEffect(() => {
    const canvas = canvasRef.current;
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    // Clear canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Set dimensions
    const width = canvas.width;
    const height = canvas.height;
    const padding = 20;

    // Find min and max values for scaling
    const values = data.map(d => d.value);
    const minValue = Math.min(...values);
    const maxValue = Math.max(...values);
    const valueRange = maxValue - minValue || 1; // Prevent division by zero

    // Draw chart background
    ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
    ctx.fillRect(0, 0, width, height);

    // Draw grid lines
    ctx.strokeStyle = 'rgba(0, 0, 0, 0.1)';
    ctx.lineWidth = 1;
    
    // Horizontal grid lines
    for (let i = 0; i <= 5; i++) {
      const y = padding + (i * (height - 2 * padding) / 5);
      ctx.beginPath();
      ctx.moveTo(padding, y);
      ctx.lineTo(width - padding, y);
      ctx.stroke();
    }

    // Vertical grid lines
    const numVerticalLines = Math.min(data.length, 6);
    for (let i = 0; i < numVerticalLines; i++) {
      const x = padding + (i * (width - 2 * padding) / (numVerticalLines - 1));
      ctx.beginPath();
      ctx.moveTo(x, padding);
      ctx.lineTo(x, height - padding);
      ctx.stroke();
    }

    // Draw chart line
    if (data.length > 0) {
      ctx.beginPath();
      ctx.strokeStyle = '#3b82f6'; // Blue color
      ctx.lineWidth = 2;
      
      data.forEach((point, index) => {
        const x = padding + (index * (width - 2 * padding) / (data.length - 1));
        const y = height - padding - ((point.value - minValue) / valueRange) * (height - 2 * padding);
        
        if (index === 0) {
          ctx.moveTo(x, y);
        } else {
          ctx.lineTo(x, y);
        }
      });
      
      ctx.stroke();
      
      // Draw data points
      ctx.fillStyle = '#3b82f6';
      data.forEach((point, index) => {
        const x = padding + (index * (width - 2 * padding) / (data.length - 1));
        const y = height - padding - ((point.value - minValue) / valueRange) * (height - 2 * padding);
        
        ctx.beginPath();
        ctx.arc(x, y, 4, 0, Math.PI * 2);
        ctx.fill();
      });
    }

    // Draw labels
    ctx.fillStyle = 'rgba(0, 0, 0, 0.7)';
    ctx.font = '10px sans-serif';
    ctx.textAlign = 'center';
    
    // Y-axis labels
    for (let i = 0; i <= 5; i++) {
      const value = minValue + (valueRange * (5 - i) / 5);
      const y = padding + (i * (height - 2 * padding) / 5);
      ctx.fillText(value.toFixed(2), 10, y + 3);
    }
    
    // X-axis labels
    const numLabels = Math.min(data.length, 6);
    for (let i = 0; i < numLabels; i++) {
      const index = Math.floor(i * (data.length - 1) / (numLabels - 1));
      const point = data[index];
      const x = padding + (i * (width - 2 * padding) / (numLabels - 1));
      ctx.fillText(point.date, x, height - 5);
    }
  }, [data]);

  return (
    <Card className="w-full">
      {title && (
        <CardHeader>
          <CardTitle>{title}</CardTitle>
        </CardHeader>
      )}
      <CardContent>
        <canvas 
          ref={canvasRef} 
          width={400} 
          height={height}
          className="w-full"
        />
      </CardContent>
    </Card>
  );
}