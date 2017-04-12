<?php

/**
 * Class CompleteRange
 */

class CompleteRange{
    /**
     * Usando la funcion php end() y range() (recomendado)
     * @var array
     * @param $collection
     */
    public function build($collection){
        $from = $collection[0];
        $to = end($collection);
        return range($from, $to);

    }

}

/**
* Sólo para probar la clase y metodos
*/
$collection = [5,8,10];  //change
$obj = new CompleteRange();
echo "Rango ingresado: " . json_encode($collection);
echo chr(10);
/**
* metodo 1 (recomendado)
*/
echo " | Completado: " . json_encode($obj->build($collection));
echo chr(10);
