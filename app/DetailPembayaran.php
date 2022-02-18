<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPembayaran extends Model
{
    protected $table = "tbl_detail_pembayaran";
    
    public $incrementing = false;
}
