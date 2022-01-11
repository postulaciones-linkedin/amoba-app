<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlans extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'currency_id',
        'renewal_price',
        'requires_invoice',
        'status',
        'created',
        'financiation',
        'language',
        'nif',
        'business_name',
        'pending_payment',
        'credits_return',
        'company_id',
        'cancel_employee',
        'force_renovation',
        'date_canceled',
        'amount_confirm_canceled',
        'credit_confirm_canceled',
        'cost_center_id',
        'status_financiation'
    ];
}
