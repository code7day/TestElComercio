<?php

$app->get('/',function(){
    echo '<h2>Welcome</h2>';
    echo '<hr>';
    echo '<a href="/employees">Go to employees</a>';
});

$app->get('/employees',function($request,$response,$args){

    $str = file_get_contents('employees.json');
    $data = json_decode($str, true);
    
    $employees = [];

    foreach($data as $employee){
        $employees[] = [
            'id'        => $employee['id'],
            'name'      => $employee['name'],
            'email'     => $employee['email'],
            'position'  => $employee['position'],
            'salary'    => $employee['salary'],
        ];
    }

    $args['employees'] = $employees;
    $args['q'] = '';

    return $this->view->render($response, "employees.phtml", $args);

});

$app->post('/employees',function($request,$response,$args){

    $str = file_get_contents('employees.json');
    $data = json_decode($str, true);
    

    $post = $request->getParsedBody();
    $q = empty($post['q'])?'@':$post['q'];

    $employees = [];
    foreach($data as $employee){
        if(isset($employee['email']) && stristr($employee['email'] , $q)) {
            $employees[] = [
                'id'        => $employee['id'],
                'name'      => $employee['name'],
                'email'     => $employee['email'],
                'position'  => $employee['position'],
                'salary'    => $employee['salary'],
            ];
        }
    }

    $args['employees'] = $employees;
    $args['q'] = $q;

    return $this->view->render($response, "employees.phtml", $args);

});



$app->get('/employees/{id}',function($request,$response,$args){
    

    $str = file_get_contents('employees.json');
    $data = json_decode($str, true);
//var_dump($args['id']);exit;
    foreach($data as $employee){
        if(isset($employee['id']) && $employee['id']==$args['id']) {
            $data = $employee;
            break;
        }
    }
    $args['employee'] = $employee;

    return $this->view->render($response, "employeesDetail.phtml", $args);
});


$app->get('/employees.xml',function($request,$response,$args){

    $str = file_get_contents('employees.json');
    $data = json_decode($str, true);
    
    $employees = [];


    $get = $request->getQueryParams();

    $pass = false;
    if((empty($get['min'])) && (empty($get['max']))){
        $pass = true;
    }

    $min = empty($get['min'])?0:(int)$get['min'];
    $max = empty($get['max'])?0:(int)$get['max'];

    
    //var_dump($pass);

    header('Content-type: text/xml');
    echo '<?xml version="1.0" encoding="UTF-8" ?>';
    echo '<employees>';
    foreach($data as $employee) {
        if(is_array($employee)) {
            if((isset($employee['salary']) && (cleanFormat($employee['salary'])>=$min && cleanFormat($employee['salary'])<=$max)) or $pass) {
                echo '<employee>';
                foreach($employee as $key => $value) {
                    echo '<',$key,'>';
                    if(is_array($value)) {
                        foreach($value as $tag => $val) {
                            if(is_array($val)) {
                                foreach($val as $i => $item) {
                                    echo '<',$i,'>',$item,'</',$i,'>';
                                }
                            }else{
                                echo $val;
                            }
                        }
                    }else{
                        echo $value;
                    }
                    echo '</',$key,'>';
                }
                echo '</employee>';
            }
        }
    }
    echo '</employees>';

    exit;
});

function cleanFormat($salary){
    $salary = str_replace('$','',$salary);
    $salary = str_replace(',','',$salary);
    $salary = str_replace('\'','',$salary);
    return round($salary);
}