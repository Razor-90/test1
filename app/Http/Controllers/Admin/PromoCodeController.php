<?php

namespace App\Http\Controllers\Admin;

use LaravelCsvImporter\CSV\CSVMaker;
use App\Http\Controllers\Controller;
use App\PromoCode;
use App\User;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;
use Symfony\Component\HttpFoundation\StreamedResponse;
use League\Csv\Writer;
use League\Csv\CannotInsertRecord;

class PromoCodeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    public function index()
    {
        $promoCodes = PromoCode::all();
        // Get only the registered (used) promo codes
        $usedPromoCodes  = PromoCode::whereNotNull('user_id')->oldest('promo_code_selection_date')->get();

        return view('admin.promo_codes.index', compact('promoCodes', 'usedPromoCodes'));
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function bulkCreateCSV()
    {
        return view('admin.promo_codes.bulk_create_csv');
    }

    public function storeBulkCSV (Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');

        $csv = Reader::createFromPath($file->path());
        $csv->setHeaderOffset(0);

        $promoCodes = $csv->getRecords();


        foreach ($promoCodes as $record) {
            $user_id = $record[1] ?? null;
            $promo_code_selection_date = $record[2] ?? null;
dd($record);
                    PromoCode::create([
                        'code' => $record['code'],
                        'user_id' => $user_id,
                        'promo_code_selection_date' => $promo_code_selection_date,
                        // Add other attributes based on the columns in your CSV file
                    ]);

        }

        return redirect()->route('admin.promo_codes.index')->with('success', 'Promo codes created successfully.');
    }

    public function create()
    {
        return view('admin.promo_codes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:promo_codes',
            // Add other validation rules if needed
        ]);

        // Create and save the promo code
        PromoCode::create([
            'code' => $request->input('code'),
            // Add other attributes as needed
        ]);

        return redirect()->route('admin.promo_codes.index')->with('success', 'Promo code added successfully.');
    }
    public function uploadCSV(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt|max:10240', // Максимальный размер файла - 10 МБ
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $path = $request->file('csv_file')->getRealPath();

        $csvData = array_map('str_getcsv', file($path));
        array_shift($csvData); // Удаляем заголовок

        // Создаем массив для сохранения промокодов
        $promoCodesToInsert = [];

        // Обрабатываем данные CSV и добавляем их в массив для сохранения
        foreach ($csvData as $record) {

            $code = $record[0] ?? null;

            if (!empty($code)) {
                $promoCodesToInsert[] = [
                    'code' => $code,
                    // Добавьте другие атрибуты промокода, если они есть в CSV файле
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

        }

        // Массовое сохранение промокодов
        PromoCode::insert($promoCodesToInsert);

        return redirect()->route('admin.promo_codes.index')->with('success', 'Промокоды успешно загружены из CSV файла.');
    }
}
