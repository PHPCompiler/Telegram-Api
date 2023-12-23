<?php

namespace PhpCompiler\Telegram;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use PhpCompiler\Telegram\Exception\InvalidArgumentException;
use PhpCompiler\Telegram\Tools\Response;

class Request extends Methods
{
    /**
     * @var int
     */
    public int $BotID;
    /**
     * @var string
     */
    private string $Token;
    /**
     * @var string
     */
    private string $SecretToken;
    /**
     * @var string
     */
    private string $ApiUrl  = 'https://api.telegram.org/bot%s/';
    /**
     * @var array
     */
    public array $Proxy     = [];
    /**
     * @var string
     */
    public static string $Logger = '';


    /**
     * @param string $Token
     * @param string $SecretToken
     * @param string $Logger
     * @throws InvalidArgumentException
     */
    public function __construct(
        string $Token       = '',
        string $SecretToken = '',
        string $Logger      = ''
    ) {
        $this->Token       = $Token;
        $this->SecretToken = $SecretToken;
        $this->BotID       = explode(':', $this->Token)[0];
        $this->ApiUrl      = sprintf($this->ApiUrl, $this->Token);
        self::$Logger      = $Logger;
        if (!empty($this->SecretToken) and ($_SERVER['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN'] ?? NULL) !== $this->SecretToken) {
            die('I can\'t trust you!');
        }
        if (false && !$this->apiRequest('getMe')->isSuccess()) {
            if (!empty($Logger)) {
                $Logger = new Logger('TOKEN_IS_INVILD');
                $Logger->pushHandler(new StreamHandler(self::$Logger, Level::Error));
                $Logger->log(Level::Error, 'The robot token is wrong.');
            }
            throw new InvalidArgumentException('TOKEN_IS_INVILD');
        }
    }

    /**
     * @param array $Proxy
     */
    public function setProxy(array $Proxy): void
    {
        $this->Proxy = $Proxy;
    }

    /**
     * @return array
     */
    public function getProxy(): array
    {
        return $this->Proxy;
    }

    /**
     * @param string $secret_token
     */
    public function setSecretToken(string $secret_token): void
    {
        $this->SecretToken = $secret_token;
    }

    /**
     * @return string
     */
    public function getSecretToken(): string
    {
        return $this->SecretToken;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->Token;
    }

    /**
     * @param string $Token
     */
    public function setToken(string $Token): void
    {
        $this->Token = $Token;
    }

    /**
     * @param string $method
     * @param array $params
     * @return Response
     */
    public function apiRequest(string $method, array $params = []): Response
    {
        $init = curl_init($this->ApiUrl . $method);

        curl_setopt_array($init, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => array_map(
                fn ($param) => (is_array($param)) ? json_encode($param): $param,
                $params
            ),
        ]);
        curl_setopt_array($init, $this->Proxy ?? false);

        $exec = json_decode(curl_exec($init), JSON_OBJECT_AS_ARRAY);

        return new Response(
            $exec['ok'],
            $exec['error_code'] ?? 0,
            $exec['description'] ?? '',
            $exec['result'] ?? [],
            is_array(($exec['result'] ?? NULL)) ? count($exec['result']): 0,
        );
    }
}