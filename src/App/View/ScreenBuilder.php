<?php

namespace App\View;

class ScreenBuilder {

    public function loadViewVariables($viewVariables = [])
    {
        foreach($viewVariables as $variable => $value){
            $this->{$variable} = $value;
        }
    }

    public function loadScreen($pathHtml, $viewVariables = [])
    {
        // Carregar variaveis do html
        $this->loadViewVariables($viewVariables);

        if( file_exists($pathHtml)){
            ob_start();
            include($pathHtml) ;
            $contents = trim( ob_get_contents() );
            ob_get_clean();

            return $contents;
         } else {
             return NULL;
         }
    }
}