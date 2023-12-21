<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOnline extends Model
{
    use HasFactory;
    public $timestamps =false;

    protected $fillable = [
        'Amount',
        'BankCode',
        'BankTranNo',
        'CardType',
        'OrderInfo',
        'PayDate',
        'ResponseCode',
        'TmnCode',
        'TransactionNo',
        'TransactionStatus',
        'TxnRef',
        'SecureHash',
    ];
protected $primaryKey = 'id';
 protected $table = 'payment_online';
}
