<?php

namespace App\Integration;

class ApiDataSerializer
{

    public function deserialize($dataApi)
    {
        // Extraindo a informação dos infectados por estado
        $dataListInfected = [];
        foreach($dataApi['infectedByRegion'] as $infoCovid) {
            array_push($dataListInfected, $infoCovid);
        }
        
        // Extraindo a informação dos mortos por estado
        $dataListDead = [];
        foreach($dataApi['deceasedByRegion'] as $infoCovid) {;
            array_push($dataListDead, $infoCovid);
        }
        
        // Mesclando as informações de infectados e mortos por estado
        $dataListCovid = [];
        $states = $this->getStates();
        for($index = 0; $index < count($dataListInfected); $index++) {
            $dataInfected = $dataListInfected[ $index ];
            $dataDeaded = $dataListDead[ $index ];
            $state = $states[ $dataInfected['state'] ];
            $infoCovid = [
                'state' => $state, 
                'acronym' => $dataInfected['state'], 
                'infected' => $dataInfected['count'],
                'deaded' => $dataDeaded['count']
            ];

            array_push($dataListCovid, $infoCovid);
        }

        // Montando a estrutura de retorno dos dados para a tela
        $date = date_create($dataApi['lastUpdatedAtSource']);
        $lastUpdatedAtSource = date_format($date,"d/m/Y H:i:s");
        $dataCovidResult = [
            'lastUpdatedAtSource' => $lastUpdatedAtSource,
            'infected' => $dataApi['infected'],
            'deceased' => $dataApi['deceased'],
            'dataListCovid' => $dataListCovid
        ];
        return $dataCovidResult;

    }

    private function getStates()
    {
        $states = [
            'AC'=>'Acre',
            'AL'=>'Alagoas',
            'AP'=>'Amapá',
            'AM'=>'Amazonas',
            'BA'=>'Bahia',
            'CE'=>'Ceará',
            'DF'=>'Distrito Federal',
            'ES'=>'Espírito Santo',
            'GO'=>'Goiás',
            'MA'=>'Maranhão',
            'MT'=>'Mato Grosso',
            'MS'=>'Mato Grosso do Sul',
            'MG'=>'Minas Gerais',
            'PA'=>'Pará',
            'PB'=>'Paraíba',
            'PR'=>'Paraná',
            'PE'=>'Pernambuco',
            'PI'=>'Piauí',
            'RJ'=>'Rio de Janeiro',
            'RN'=>'Rio Grande do Norte',
            'RS'=>'Rio Grande do Sul',
            'RO'=>'Rondônia',
            'RR'=>'Roraima',
            'SC'=>'Santa Catarina',
            'SP'=>'São Paulo',
            'SE'=>'Sergipe',
            'TO'=>'Tocantins'
        ];

        return $states;

    }
    
}
