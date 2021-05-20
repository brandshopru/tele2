<?php

namespace Brandshopru\Tele2;

use Brandshopru\Tele2\Response;

class Client
{
    private $login;
    private $password;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * Функция отправки SMS
     *
     * обязательные параметры:
     * @param $phone - список телефонов через запятую или точку с запятой
     * @param $message - отправляемое сообщение
     *
     * @return \Brandshopru\Tele2\Response
     * @throws \Exception
     */
    public function sendSms($phone, $message, $brandname)
    {
        /**
         * "msisdn" => "79266173928",
         * "shortcode" => "BRANDSHOP",
         * "text" => "Ваш заказ уже в пути. Его доставит Вакуров Сергей, т. 79687050044"
         */

        return $this->request("send", [
            "msisdn" => $phone,
            "shortcode" => $brandname,
            "text" => $message,
        ]);
    }

    /**
     * Функция вызова запроса. Формирует URL и
     * делает попытку чтения через подключение к сервису
     *
     * @param $cmd
     * @param array $data
     *
     * @return \Brandshopru\Tele2\Response
     * @throws \Exception
     */
    private function request($cmd, $data = [])
    {
        $base_url = "https://bsms.tele2.ru/api/";
        $data = array_merge($data, [
            "operation" => $cmd,
            "login" => $this->login,
            "password" => $this->password,
        ]);

        $client = new \GuzzleHttp\Client([
            "headers" => ["Expect" => ""],
            "timeout" => 20,
            "connect_timeout" => 10
        ]);

        $httpResponse = $client->request("GET", $base_url, ["query" => $data]);

        return new Response($httpResponse);
    }
}