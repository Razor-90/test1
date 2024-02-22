<?php
use Illuminate\Database\Seeder;
use App\PromoCode;

class PromoCodeSeeder extends Seeder
{

 public function run()
    {
        // Открываем файл для чтения
        $file = fopen('E:\OSPanel\userdata\temp\upload\alinex.txt', 'r');

        // Читаем файл построчно
        while (!feof($file)) {
            // Читаем строку из файла
            $line = fgets($file);

            // Убираем лишние пробелы и символы переноса строки
            $line = trim($line);

            // Проверяем, что строка не пустая
            if (!empty($line)) {
                // Создаем новую запись промо-кода
                $promoCode = new PromoCode([
                    'code' => $line,
                    'user_id' => null,
                    'promo_code_selection_date' => null,
                    'is_winned' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Сохраняем запись в базе данных
                $promoCode->save();
            }
        }

        // Закрываем файл
        fclose($file);

        // Добавляем промо-коды с фиксированными значениями is_winned и prize
       /*  PromoCode::insert([
            [
                'code' => 'M12S6QU',
                'user_id' => null,
                'promo_code_selection_date' => null,
                'is_winned' => true,
                'prize' => 'Some prize',
                'prize_received' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CZ2RAOL',
                'user_id' => null,
                'promo_code_selection_date' => null,
                'is_winned' => true,
                'prize' => 'Some prize',
                'prize_received' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Добавьте другие промо-коды с фиксированными значениями по аналогии
        ]);*/
    }


}
