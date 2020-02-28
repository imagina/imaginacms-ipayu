<?php

namespace Modules\Ipayu\Http\Controllers\Api;

use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

use Modules\Ipayu\Support\RecurringPayments\SupportPayUCreditCards;

class CreditCardsApiController extends BaseApiController
{

  private $payUCreditCards;

  public function __construct(SupportPayUCreditCards $payUCreditCards)
  {
    $this->payUCreditCards = $payUCreditCards;
  }

  public function create (Request $request)
  {
    try {
      $data = $request->input('attributes');
      $creditCard = $this->payUCreditCards->creation($data);
      $response = ["data" => $creditCard];
    } catch (\Exception $e) {

      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    return response()->json($response, $status ?? 200);
  }

  public function update ($criteria, Request $request)
  {
    try {
      $data = $request->input('attributes');
      $creditCard = $this->payUCreditCards->update($criteria, $data);
      $response = ["data" => $creditCard];
    } catch (\Exception $e) {

      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    return response()->json($response, $status ?? 200);
  }

  public function show ($criteria)
  {
    try{
      $creditCard = $this->payUCreditCards->query($criteria);
      $response = [
        'data' => $creditCard
      ];
      $status = 200;
    }catch (PayUException $e){
      $status = 500;
      $response = ["errors" => $e];
    }
    return response()->json($response, $status);
  }

  public function delete ($criteria)
  {
    try {
      $creditCard = $this->payUCreditCards->delete($criteria);
      $response = ["data" => $creditCard];
    } catch (\Exception $e) {

      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    return response()->json($response, $status ?? 200);
  }

}
