<?php
namespace App\TrinityCore\Abstracts;

use App\TrinityCore\Exceptions\SoapException;

/**
 * Class BaseClient
 * @package FreedomCore\TrinityCore\Console\Abstracts
 */
abstract class BaseClient
{

    /**
     * Package Version
     * @var string
     */
    const VERSION = '1.0.5';

    /**
     * Server Address
     * @var string
     */
    private $serverAddress = '127.0.0.1';

    /**
     * Server Port
     * @var int
     */
    private $serverPort = 7878;

    /**
     * SoapClient Instance
     * @var \SoapClient
     */
    private $client = null;

    /**
     * Username used to connect to the server
     * @var null|string
     */
    private $username = null;

    /**
     * Password used to connect to the server
     * @var null|string
     */
    private $password = null;

    /**
     * BaseClient constructor.
     * @param string $username Username used to connect to the server
     * @param string $password Password used to connect to the server
     * @param boolean $createNow Should the connection be created as soon as possible
     * @throws SoapException | \RuntimeException
     */
    public function __construct(string $username, string $password, bool $createNow = true)
    {
        $this->isSoapEnabled();
        $this->setUsername($username);
        $this->setPassword($password);
        $this->validateSettings();
        if ($createNow) {
            $this->createConnection();
        }
    }

    /**
     * @return string
     */
    public function getServerAddress(): string
    {
        return $this->serverAddress;
    }

    /**
     * @param string $serverAddress
     */
    public function setServerAddress(string $serverAddress): void
    {
        $this->serverAddress = $serverAddress;
    }

    /**
     * @return int
     */
    public function getServerPort(): int
    {
        return $this->serverPort;
    }

    /**
     * @param int $serverPort
     */
    public function setServerPort(int $serverPort): void
    {
        $this->serverPort = $serverPort;
    }



    /**
     * Set username variable
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * Get username variable
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * Set password variable
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * Get password variable
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * Set Server Address
     * @param string $serverAddress
     * @return BaseClient
     */
    public function setAddress(string $serverAddress) : BaseClient
    {
        $this->serverAddress = $serverAddress;
        return $this;
    }

    /**
     * Get Server Address
     * @return string
     */
    public function getAddress() : string
    {
        return $this->serverAddress;
    }

    /**
     * Set Server Port
     * @param int $serverPort
     * @return BaseClient
     */
    public function setPort(int $serverPort) : BaseClient
    {
        $this->serverPort = $serverPort;
        return $this;
    }

    /**
     * Get Server Port
     * @return int
     */
    public function getPort() : int
    {
        return $this->serverPort;
    }

    /**
     * Get Client Version
     * @return string
     */
    public function getVersion() : string
    {
        return BaseClient::VERSION;
    }

    /**
     * Initialize Connection To The Server
     */
    public function createConnection()
    {
        $this->client = new \SoapClient(null, [
            'location'      =>  'http://' . $this->getServerAddress() . ':' . $this->getServerPort() . '/',
            'uri'           =>  'urn:TC',
            'login'         =>  $this->getUsername(),
            'password'      =>  $this->getPassword(),
            'style'         =>  SOAP_RPC,
            'keep_alive'    =>  false
        ]);
    }

    /**
     * Get Client Instance
     * @return \SoapClient
     */
    public function getClient() : \SoapClient
    {
        return $this->client;
    }

    /**
     * Check if SOAP extension is enabled
     * @throws SoapException
     * @codeCoverageIgnore
     */
    protected function isSoapEnabled()
    {
        if (!extension_loaded('soap')) {
            throw new SoapException('FreedomNet requires SOAP extension to be enabled.' . PHP_EOL . 'Please enable SOAP extension');
        }
    }

    /**
     * Validate Connection Settings
     * @codeCoverageIgnore
     */
    protected function validateSettings()
    {
        if ($this->serverAddress === null) {
            throw new \RuntimeException('SOAP Address cannot be null!');
        }
        if ($this->serverPort === null) {
            throw new \RuntimeException('SOAP Port cannot be null!');
        }
        if ($this->username === null) {
            throw new \RuntimeException('SOAP Username cannot be null!');
        }
        if ($this->password === null) {
            throw new \RuntimeException('SOAP Password cannot be null!');
        }
    }
}
