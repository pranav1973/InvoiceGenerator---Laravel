<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_number', 'invoice_date', 'customer_id', 'tax_percent'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoice_item()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function getTotalAmountAttribute()
    {
        $total_amount = 0;
        foreach ($this->invoice_item as $item) {
            $total_amount += $item->price * $item->quantity;
        }

        return $total_amount;
    }
}
