<?php

/**
 * Class ChangeString
 */

class ChangeString{
    /**
     * @var array
     */
    protected $replace;
    
    public function __construct()
    {
        $this->replace  = [
            //minusculas
            'a' => 'b',
            'b' => 'c',
            'c' => 'd',
            'd' => 'e',
            'e' => 'f', 
            'f' => 'g', 
            'g' => 'h',
            'h' => 'i',
            'i' => 'j',
            'j' => 'k',
            'k' => 'l',
            'l' => 'm',
            'm' => 'n',
            'n' => 'ñ',
            'ñ' => 'o',
            'o' => 'p',
            'p' => 'q',
            'q' => 'r',
            'r' => 's',
            's' => 't',
            't' => 'u',
            'u' => 'v',
            'v' => 'w',
            'w' => 'x',
            'x' => 'y',
            'y' => 'z',
            'z' => 'a',

            //mayusculas
            'A' => 'B',
            'B' => 'C',
            'C' => 'D',
            'D' => 'E',
            'E' => 'F', 
            'F' => 'G', 
            'G' => 'H',
            'H' => 'I',
            'I' => 'J',
            'J' => 'K',
            'K' => 'L',
            'L' => 'M',
            'M' => 'N',
            'N' => 'Ñ',
            'Ñ' => 'O',
            'O' => 'P',
            'P' => 'Q',
            'Q' => 'R',
            'R' => 'S',
            'S' => 'T',
            'T' => 'U',
            'U' => 'V',
            'V' => 'W',
            'W' => 'X',
            'X' => 'Y',
            'Y' => 'Z',
            'Z' => 'A',
            
        ];
    }

    /**
     * Usando la funcion php strtr() (recomendado)
     * @param $string
     */
    public function build($string){

        return strtr($string, $this->replace);

    }

    /**
     * Haciendo un algoritmo
     * @param $string
     */
    public function build_src($string){

        $replace = $this->replace;
        $output = '';
        for($i=0; $i<strlen($string); $i++){
            if (preg_match('/[a-zA-Z]/', $string[$i])){
                $output .= $replace[$string[$i]];
            }else{
                $output .= $string[$i];
            }
        }
        return $output;

    }

}

/**
* Sólo para probar la clase y metodos
*/
$text = '**Casa 52Z';  //change
$obj = new ChangeString();
echo "Texto ingresado: {$text}";
echo chr(10);
/**
* metodo 1 (recomendado)
*/
echo " | Metodo 1 (recomendado): " . $obj->build($text);
echo chr(10);

/**
* metodo 2
*/
echo " | Metodo 2: " . $obj->build_src($text);
echo chr(10);