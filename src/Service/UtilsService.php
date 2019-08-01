<?php


namespace App\Service;


use App\DBAL\Types\CurrencyEnum;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\FormInterface;

class UtilsService
{
    private $parameterBag;
    private $apiService;

    public function __construct(
        ParameterBagInterface $parameterBag,
        ApiService $apiService)
    {
        $this->parameterBag = $parameterBag;
        $this->apiService = $apiService;
    }

    public function getConversionValueForCurrency(string $currency)
    {
        $url = $this->parameterBag->get('API_CURRENCY_URL');
        switch ($currency) {
            case CurrencyEnum::EUR:
                $params['base'] = CurrencyEnum::USD;
                $params['symbols'] = CurrencyEnum::EUR;
                break;

            case CurrencyEnum::USD:
                $params['base'] = CurrencyEnum::EUR;
                $params['symbols'] = CurrencyEnum::USD;
                break;

            default:
                $params = [];
        }

        $response = $this->apiService->get($url, $params);
        $responseArray = json_decode($response, true);

        return $responseArray['rates'][$currency];
    }

    public function getErrorsFromForm(FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }
        return $errors;
    }
}