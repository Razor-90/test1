<?php

// Параметры подключения к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laravel2";

// Создаем подключение к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Открываем файл CSV для чтения
$filename = "путь_к_вашему_файлу.csv";
$file = fopen($filename, "r");

// Проверяем, что файл открыт успешно
if ($file === false) {
    die("Error opening file.");
}

// Перебираем файл по строкам и вставляем данные в базу данных
while (($data = fgetcsv($file, 1000, ",")) !== false) {
    $sql = "INSERT INTO promo_codes (id, code, user_id, promo_code_selection_date, is_winned, prize_received, created_at, updated_at) 
            VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]')";
    if ($conn->query($sql) === false) {
        echo "Error inserting data: " . $conn->error;
    }
}

// Закрываем файл и соединение с базой данных
fclose($file);
$conn->close();

echo "Data inserted successfully.";
?>
