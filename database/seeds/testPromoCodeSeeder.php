<?php
use Illuminate\Database\Seeder;
use App\PromoCode;

class PromoCodeSeeder extends Seeder
{
    public function run()
    {
// Generate 1,000,000 promo codes
        factory(PromoCode::class, 1000000)->create();
    }
}
