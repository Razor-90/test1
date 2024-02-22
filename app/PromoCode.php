<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;

class PromoCode extends Model
{
    //
    protected $fillable = ['code','promo_code_selection_date','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function create($code, $selectionDate = null)
    {
        return static::create([
            'code' => $code,
            'promo_code_selection_date' => $selectionDate,
        ]);
    }

}
