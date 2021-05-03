<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Current user who make this commande
     */

    public function user() {
        return $this->belongsTo("App\User");
    }
}
