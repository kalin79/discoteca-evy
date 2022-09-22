<?php

function getSortValues($input, $default_field = 'id', $default_dir = 'desc')
{

    if($input){
        $sort['field'] = $input[0]['field'];
        $sort['dir']   = $input[0]['dir'];
    }else{
        $sort['field'] = $default_field;
        $sort['dir']   = $default_dir;
    }

    return $sort;
}

function getFilterValues($filters)
{

    $operators = ['eq'=>'=', 'neq'=>'!=', 'gt' => '>', 'lt'=>'<', 'gte' => '>=', 'lte'=>'<=', '='=>'=', 'like'=>'like',
        'contains' => 'like', 'doesnotcontains' => 'not like', 'startswith' => 'like', 'endswith' => 'like',
        'isempty' => '', 'isnotempty' => ''];

    if ($filters) {
        foreach ($filters['filters'] as $filter) {
            $operator = $operators[$filter['operator']] ?? '=';
            $key_operator = $filter['operator'];
            $logic = isset($filter['logic']) ? $filter['logic'] : '';

            if (in_array($key_operator, ['like', 'contains', 'doesnotcontains'])) {
                $value = '%'.$filter['value'].'%';
            } else if ($key_operator == 'startswith') {
                $value = $filter['value'].'%';
            } else if ($key_operator == 'endswith') {
                $value = '%'.$filter['value'];
            } else {
                $value = $filter['value'];
            }

            $fields[$filter['field']] = ['value' => $value, 'operator' => $operator, 'logic' => $logic];
        }

        return $fields;
    }

    return null;
}

function array_findByVal($array, $value, $key)
{
    $arr_new = null;
    if (is_array($array)) {
        foreach ($array as $k => $v) {
            if ($v[$key] == $value) {
                $v['key'] = $k;
                $arr_new = $v;
                break;
            }
        }
    }
    return $arr_new;
}

function segmentDirectory($dir, $number, $init = 0)
{
    $new_dir = '';
    $array_dir = explode('/', $dir);

    if (!isset($array_dir[$number-1])) {

        return false;
    }

    for ($i = 1; $i <= $number; $i++) {
        if ($i >= $init) {
            $new_dir = $new_dir.'/'.$array_dir[$i-1];
        }
    }

    return $new_dir;
}
function codigo_generate_format($prefix, $subfix_init = 0, int $digit_min = 3)
{
    $subfix_correlative = str_replace_first($prefix, '', $subfix_init);
    return $prefix.sprintf("%'.0".$digit_min."d", ($subfix_correlative+1));
}

function operator($operator, $default = '=')
{
    $array = ['lte' => '<=',
        'gte' => '>=',
        'lt' => '<',
        'gt' => '>',
        'eq' => '=',
        'neq' => '!=',
        'like' => 'like',
        'startswith' => 'like',
        'endswith' => 'like',
        'notlike' => 'not like',
        'in' => 'in'
    ];

    return $array[$operator] ?? $default;
}

function condicion_number($number_one, $operator, $number_two)
{
    switch (operator($operator)){
        case '<=':
            if($number_one <= $number_two){
                return true;
            }
            break;
        case '>=':
            if($number_one >= $number_two){
                return true;
            }
            break;
        case '<':
            if($number_one < $number_two){
                return true;
            }
            break;
        case '>':
            if($number_one > $number_two){
                return true;
            }
            break;
        case '=':
            if($number_one == $number_two){
                return true;
            }
            break;
        case '!=':
            if($number_one != $number_two){
                return true;
            }
            break;
            return false;
    }
}

function operator_format_like_string($string, $operator)
{
    $array = ['like' => '%'.str_replace(' ', '%', $string).'%',
        'notlike' => '%'.str_replace(' ', '%', $string).'%',
        'startswith' => $string.'%',
        'endswith' => '%'.$string];

    if (! isset($array[$operator])) {
        return $string;
    }

    return [$array[$operator]];
}

function operator_format_string($string, $operator, $search_in)
{
    switch($operator){
        case 'like':
            return str_contains($search_in, $string);
            break;
        case 'notlike':
            return !str_contains($search_in, $string);
            break;
        case 'startswith':
            return starts_with($search_in, $string);
            break;
        case 'endswith':
            return ends_with($search_in, $string);
            break;
        case 'eq':
            return $search_in === $string;
            break;
        case 'neq':
            return $search_in !== $string;
            break;
    }
}

function toHours($min,$type='')
{ //obtener segundos
    $sec = $min * 60;
    //dias es la division de n segs entre 86400 segundos que representa un dia
    $dias=floor($sec/86400);
    //mod_hora es el sobrante, en horas, de la division de días;
    $mod_hora=$sec%86400;
    //hora es la division entre el sobrante de horas y 3600 segundos que representa una hora;
    $horas=floor($mod_hora/3600);
    //mod_minuto es el sobrante, en minutos, de la division de horas;
    $mod_minuto=$mod_hora%3600;
    //minuto es la division entre el sobrante y 60 segundos que representa un minuto;
    $minutos=floor($mod_minuto/60);
    if($horas<=0)
    {
        $text = $minutos.' min';
    }
    elseif($dias<=0)
    {
        if($type=='round')
            //nos apoyamos de la variable type para especificar si se muestra solo las horas
        {
            $text = $horas.' hrs';
        }else
        {
            $text = $horas." hrs ".$minutos.' min';
        }
    }
    else
    {
        //nos apoyamos de la variable type para especificar si se muestra solo los dias
        if($type=='round')
        {
            $text = $dias.' dias';
        }
        else
        {
            $text = $dias." dias ".$horas." hrs ".$minutos." min";
        }
    }
    return $text;
}

function fechaCastellano ($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia.", ".$numeroDia." de ".$nombreMes." de ".$anio;
}


function encrypt_str($string) {

    return encrypt($string);
}

function decrypt_str($string) {

    try {
        $descrypt = decrypt($string);
    } catch (Exception $exc) {
        $descrypt = $string;
    }

    return $descrypt;
}

function uniqueKey($limit = 10, $numbers = true, $uppercase = true, $lowercase = true)
{
    $characters = '';
    if ($numbers) {
        $characters = '0123456789';
    }
    if ($uppercase) {
        $characters .= 'ABCDEFGHJKLMNPQRSTUVWXYZ';//IO
    }
    if ($lowercase) {
        $characters .= 'abcdefghijklmnopqrstuvwxyz';
    }

    $randstring = '';
    for ($i = 0; $i < $limit; $i++) {
        $randstring .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randstring;
}

function havePermission($permission_name){
    //dd($permission,auth()->user());
    $user = auth()->user();
    foreach ($user->role as $roles){
        if($roles->has("permission")){
            foreach ($roles->permission as $permission){
                if($permission->name ==$permission_name ){
                    return true;
                }
            }
        }
    }
    return false;
}

function check_pcomplex($string, $minchar, $level)
{
    /*$level = 1- Requerido al menos una letra de cualquier tipo o numeros, especiales son validos
      $level = 2- Lo del $level 1, pero con al menos una minuscula obligatoria
      $level = 3- Lo del $level 2, pero con al menos un numero obligatorio
      $level = 4- Lo del $level 3, pero con al menos una mayuscula, obligatoria
      $level = 5- Lo del $level 4, pero con al menos un caracter especial, obligatorio.*/
    $lowcase = preg_match('/[a-z]/', $string);
    $uppcase = preg_match('/[A-Z]/', $string);
    $numbers = preg_match('/\d/', $string);
    $special = preg_match('/[^a-zA-Z\d]/', $string);

    $passed = true;
    switch ($level) {
        case 5:
            $passed = ($passed and $special);
        case 4:
            $passed = ($passed and $uppcase);
        case 3:
            $passed = ($passed and $numbers);
        case 2:
            $passed = ($passed and $lowcase);
        case 1:
            $passed = ($passed and ($lowcase or $uppcase or $numbers));
        case 0:
            $passed = ($passed and (strlen($string) >= $minchar));
            break;
        default:
            $passed = false;
    }
    return $passed;
}

function captchaVerify($privkey, $response, $remoteip)
{
    $responsed = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $privkey . "&response=" . $response . "&remoteip=" . $remoteip), true);
    return $responsed['success'];
}

function mesCastellano($numero_mes)
{
    $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    return $meses[$numero_mes - 1];
}
