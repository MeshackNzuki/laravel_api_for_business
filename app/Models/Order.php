<?php

namespace App\Models;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
      
        protected $fillable=['client_id','order_number','pages','quantity','type_of_work','status','total_amount','deadline','academic_level','payment_method','status','payment_status','type_of_work','coupon','created_at'];
   
        public function client(): BelongsTo
        {
            return $this->belongsTo(Client::class,'client_id','id');
        }

}
