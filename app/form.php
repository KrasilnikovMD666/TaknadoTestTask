<?php
require_once('connect.php');
require_once('Dadata.php');

/**
 * Получение данных из массива по Dadata API и дальнейшая их запись в бд
 * @param array $data Массив данных полученных по Dadata API
 * @param object $connect подключение к базе данных
 */
function getCompanyData(array $data, object $connect)
{
    foreach($data as $companies) {
        foreach($companies as $company) {
            if($company['data']['type'] == 'LEGAL') {
                $type = 1;
            } 
            if($company['data']['type'] == 'INDIVIDUAL') {
                $type = 2;
            }
            $name = $company['value'];
            $inn =  $company['data']['inn'];
            $ogrn = $company['data']['ogrn'];
            if(isset($company['data']['management']['post'])) {
                $management_post = $company['data']['management']['post'];
            } else {
                $management_post = null;
            }
            if(isset($company['data']['management']['name'])) {
                $management_name = $company['data']['management']['name'];
            } else {
                $management_name = null;
            }
            $email = $company['data']['emails'];
            $phone = $company['data']['phones'];
            $adress = trim($company['data']['address']['unrestricted_value']);
            $sql = "INSERT INTO `data` (`company_type`, `company_name`, `inn`, `ogrn`, `manager_post`, 
                                `manager_name`,`email`, `phone`, `full_adress`)
                    VALUES ('$type', '$name', '$inn', '$ogrn', '$management_post', '$management_name',
                            '$email', '$phone', '$adress')";
            $result = mysqli_query($connect, $sql);
        }
    }
    echo 'Данные о компании записаны в базу данных!';
}

$inn = $_POST['inn'];
settype($inn, 'integer');

$token = "84784b2fb2a2a0787b13a4e79281b5dab69ba3b0";
$secret = "4c0b2db02715735590347cd3ec60e75a116d30cc";

$dadata = new Dadata($token, $secret);
$dadata->init();

$fields = array("query" => $inn, "count" => 5);
$result = $dadata->suggest("party", $fields);
getCompanyData($result, $connect);
