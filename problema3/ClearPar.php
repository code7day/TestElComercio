<?php

/**
 * Class ClearPar
 */

class ClearPar{
    /**
     * Usando la funcion php substr() (recomendado)
     * @var string
     * @param $cadena
     */
    public function build($cadena){
        $output = '';
        
        for($i=0;$i < strlen($cadena);$i++){
            $chars = substr($cadena,$i,2);
            if($chars=='()'){
                $output .= $chars;
            }
        }
        return $output;
    }

}

/**
* Sólo para probar la clase y metodos
*/
$text = '(()()()()(()))))())((())';  //change
$obj = new ClearPar();
echo "Cadena ingresada: " . $text;
echo chr(10);

/**
* metodo 1 (recomendado)
*/
echo " | Limpiada: " . $obj->build($text);
echo chr(10);

/**
* metodo 2: se podria hacer usando "Expresiones Regulare".
*/