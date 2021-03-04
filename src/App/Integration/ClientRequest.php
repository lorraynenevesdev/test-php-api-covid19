<?php

namespace App\Integration;

class ClientRequest{
    private $urlRequest = "";

    public function __construct()
    {
        $this->urlRequest = "https://api.apify.com/v2/key-value-stores/TyToNta7jGKkpszMZ/records/LATEST?disableRedirect=true";
    }

    public function getResultApi()
    {
        $ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $this->urlRequest); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE );
		$output = curl_exec($ch); 
		$output = json_decode( $output, true );
		
		$status_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE);
						
		if( $status_code !== 200 ) {
			curl_close( $ch );
			return false;
		} else {
			curl_close( $ch );
			return $output;
		}				
		
    }
}