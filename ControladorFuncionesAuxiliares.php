<?php

    class ControladorFuncionesAuxiliares{

        public static function formateaString($string_formatear){


            if(strpos($string_formatear, '├æ') !== false){
                $string_formateado = str_replace('├æ', 'Ñ', $string_formatear);
            }
            elseif(strpos($string_formatear, '├▒') !== false){
                $string_formateado = str_replace('├▒', 'ñ', $string_formatear);
            }
            elseif(strpos($string_formatear, '├ô') !== false){
                $string_formateado = str_replace('├ô', 'Ó', $string_formatear);
            }
            elseif(strpos($string_formatear, '├│') !== false){
                $string_formateado = str_replace('├│', 'ó', $string_formatear);
            }
            elseif(strpos($string_formatear, '├Ü') !== false){
                $string_formateado = str_replace('├Ü', 'Ú', $string_formatear);
            }
            elseif(strpos($string_formatear, '├ì') !== false){
                $string_formateado = str_replace('├ì', 'Í', $string_formatear);
            }
            else{
                $string_formateado = $string_formatear;
            }

            return $string_formateado;

        }

    }

?>

