<?php


namespace MrSayrax\Tochka;


class Tochka extends TochkaClient
{

    /** 
     * Get list of organizations and accounts
     *
     * @return object|null 
     */
    public function getOrganisationList()
    {
        return $this->getResponse('/v1/organizations/list');
    }

    /** 
     * Get account list
     *
     * @return object|null 
     */
    public function getAccountList()
    {
        return $this->getResponse('/v1/account/list');
    }

    /** 
     * Get bank statement 
     *
     * @param array $params
     *
     *   "account_code": "Account Number", 
     *   "bank_code": "Bank Identifier", 
     *   "date_end": "Statement last date , Y-m-d", 
     *   "date_start": "Statement first date, Y-m-d" 
     *
     * @return object|null
     */

    public function getBankStatement(array $params)
    {
        return $this->postResponse('/v1/statement', $params);
    }

}
