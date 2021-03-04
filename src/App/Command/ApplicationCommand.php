<?php

namespace App\Command;
use App\Integration\ClientRequest;
use App\Integration\ApiDataSerializer;
use App\View\ScreenBuilder;

class ApplicationCommand
{

    public function execute() {
        // Carrega dados da api covid 19
        $integrationApi = new ClientRequest();
        $dataApi = $integrationApi->getResultApi();

        // Serializa dados da api para o formato de dados necessarios na tela
        $integrationSerializer = new ApiDataSerializer();
        $apiData = $integrationSerializer->deserialize($dataApi);
        $viewVariables = ['apiData' => $apiData, 'apiDataJson' => json_encode($apiData)];
        
        // Constroi a tela com os dados formatados para o frontend
        $view = new ScreenBuilder();
        print $view->loadScreen('views/home.html', $viewVariables);
    }
    
}