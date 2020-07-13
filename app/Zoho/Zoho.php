<?php

    namespace App\Zoho;

    use Illuminate\Support\Facades\Http;
    use App\Interfaces\ApiInterface;

    class Zoho implements ApiInterface {
        
        private $token;
        private $domain = 'https://zohoapis.eu/crm/v2';

        public function __construct() {
            if(session()->has('zohotoken')) {
                $this->token = session()->get('zohotoken')->__get('accessToken');
            }
        }

        public function getToken($code) {

            $response = Http::asForm()->post('https://accounts.zoho.eu/oauth/v2/token',[
                'grant_type' => 'authorization_code',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'redirect_uri' => env('REDIRECT_URI'),
                'code' => $code,
            ]);
    
            return $response->json();
        }

        public function refreshToken() {
        
            $response = Http::asForm()->post('https://accounts.zoho.eu/oauth/v2/token',[
                'grant_type' => 'refresh_token',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'refresh_token' => $this->token,
            ]);
    
            return $response->json();
        }

        public function getFields() {
            $response = Http::withHeaders(['Authorization'=>'Zoho-oauthtoken '.$this->token])
                            ->get($this->domain.'/settings/fields',['module' => 'leads']);
            
            $responseData = $response->json();

            $fields = [];
            if(!empty($responseData) && is_array($responseData)) {

                foreach ($responseData['fields'] as $field) {

                    $fields[] = [
                        'label' => $field['field_label'],
                        'property' => str_replace(' ', '_', $field['api_name']),
                        'mandatory' => $field['system_mandatory'],
                        'type' => $field['data_type'],
                    ];
                }

            }

            return $fields;
        }

        public function getEntities() {

            $response = Http::withHeaders(['Authorization'=>'Zoho-oauthtoken '.$this->token])
                            ->get($this->domain.'/Leads');

            $responseData = $response->json();

            if(isset($responseData['data']) && is_array($responseData['data'])) {
                return $responseData['data'];
            }
            else {
                return [];
            }
        }

        public function getEntity($id) {

            $response = Http::withHeaders(['Authorization'=>'Zoho-oauthtoken '.$this->token])
                            ->get($this->domain.'/Leads/'.$id);

            $responseData = $response->json();

            if(isset($responseData['data']) && is_array($responseData['data'])) {
                return $responseData['data'][0];
            }
            else {
                return [];
            }
        }

        public function deleteEntity($id) {

            $response = Http::withHeaders(['Authorization'=>'Zoho-oauthtoken '.$this->token])
                            ->delete($this->domain.'/Leads/'.$id);

            $responseData = $response->json();

            if(isset($responseData['data']) && $responseData['data'][0]['status'] == 'success') {
                return $responseData['data'][0];
            }
            else {
                return [];
            }
        }

        public function createEntity($data) {

            $jsonObject = json_encode(['data'=>[$data]]);

            $response = Http::withHeaders(['Authorization'=>'Zoho-oauthtoken '.$this->token])->withBody($jsonObject,'application/json')
                            ->post($this->domain.'/Leads');
            
            $responseData = $response->json();

            if(isset($responseData['data']) && $responseData['data'][0]['status'] == 'success') {
                return true;
            }
            else {
                return false;
            }
        }

        public function updateEntity($data) {

            $jsonObject = json_encode(['data'=>[$data]]);

            $response = Http::withHeaders(['Authorization'=>'Zoho-oauthtoken '.$this->token])->withBody($jsonObject,'application/json')
                            ->put($this->domain.'/Leads/'.$data['id']);
            
            $responseData = $response->json();

            if(isset($responseData['data']) && $responseData['data'][0]['status'] == 'success') {
                return true;
            }
            else {
                return false;
            }
        }
    }