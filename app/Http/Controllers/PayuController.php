<?php

namespace App\Http\Controllers;

use App\Monedero;
use App\MonederoMovimiento;
use App\Transaccion;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PayuController extends Controller
{
   public function payPayu(Request $request){

      $user = auth('api')->user();
      
      $headers = [
          'Content-Type' => 'application/json',
          'Accept' => 'application/json',
      ];

      $client = new Client([
          'headers' => $headers
      ]);

      $urlPayu = 'https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi';

      $apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
      $merchantid = "508029";
      $referenceCode =  "TestPayU"; //unica por cada transaccion

      $signature =  md5($apiKey."~".$merchantid."~".$referenceCode."~".$request->monto."~COP");

      $json = '{
         "language": "es",
         "command": "SUBMIT_TRANSACTION",
         "merchant": {
            "apiKey": "'.$apiKey.'",
            "apiLogin": "pRRXKOl8ikMmt9u"
         },
         "transaction": {
            "order": {
               "accountId": "512321",
               "referenceCode": "'.$referenceCode.'",
               "description": "pago del usuario '.$user->name.'",
               "language": "es",
               "signature": "'.$signature.'",
               "additionalValues": {
                  "TX_VALUE": {
                     "value": '.$request->monto.',
                     "currency": "COP"
                  }
               },
               "buyer": {
                  "merchantBuyerId":"'.$user->id.'",
                  "fullName": "'.$user->name.'",
                  "emailAddress": "yoecrown@gmail.com"
               }
            },
            "creditCard": {
               "number": "'.$request->numero.'",
               "securityCode": "'.$request->codigo.'",
               "expirationDate": "'.$request->fecha.'",
               "name": "'.$request->nombre.'"
            },
            "type": "AUTHORIZATION_AND_CAPTURE",
            "paymentMethod": "'.$request->tipo_cuenta.'",
            "paymentCountry": "CO",
            "deviceSessionId": "'.$request->deviceSessionId.'"
         },
         "test": false
      }';

      // return response()->json($json, 201);

      $res = $client->request('POST', $urlPayu, ['json' => json_decode($json)
      ]);

      $res->getStatusCode();
      $response =  $res->getBody()->getContents();

      return $response;
   }

   public function payPayuMount(Request $request){

      $user = auth('api')->user();
      
      $apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
      $merchantid = "508029";
      $referenceCode =  "Recarga ".$user->name." ".now(); //unica por cada transaccion
      $accountId =  "512321"; 
      $email =  $user->email; 
      $name =  $user->name; 
      $UserId =  $user->id; 

      $signature =  md5($apiKey."~".$merchantid."~".$referenceCode."~".$request->amount."~COP");

      $data = collect([
         "merchantId" => $merchantid,
         "reference" => $referenceCode,
         "amount" => $request->amount,
         "email" => $email,
         "signature" => $signature,
         "accountId" => $accountId,
         "name" => $name,
         "userId" => $UserId,
      ]);

      $data->toJson();

      return response()->json($data, 201);
   }


   public function response(Request $request){

      // dd($request->all());
      $transactionState = $request->transactionState; //estado
      $processingDate = $request->processingDate;      //fecha del proceso
      $buyerEmail = $request->buyerEmail;               //email del comprador 
      $transactionId = $request->transactionId;         //transaccion id
      $message = $request->message;                      //mensaje
      $amount = $request->TX_VALUE;                       //amount    
      $description = $request->description;              //descripcion(estado)    
      $pseBank = $request->pseBank;              //pse    
      $pseCycle = $request->pseCycle;              //pse    
      $user_id = $request->extra1;              //user   
      $reference_pol = $request->reference_pol; //Referencia de pago    

      if ($transactionState == 4 ) {
            
            $transaccion = new Transaccion;
            $transaccion->user_id = $user_id ;        
            $transaccion->fecha = $processingDate;
            $transaccion->transaccion_id = $transactionId;
            $transaccion->transaccion_message = $message;
            $transaccion->amount = $amount;
            $transaccion->pse_bank = $pseCycle;
            $transaccion->pse_cycle = $pseCycle;
            $transaccion->reference_pol = $reference_pol;
            $transaccion->save();

            $monedero = Monedero::where('user_id', $user_id)->first();


            $movimiento = new MonederoMovimiento;
            $movimiento->valor = $amount;
            $movimiento->monedero_id = $monedero->id;
            $movimiento->cliente_id = user_id;
            $movimiento->state = "entry";
            $movimiento->save();

            $monedero->stock = $monedero->stock + $amount;
            $monedero->save();
      }


   }
}
