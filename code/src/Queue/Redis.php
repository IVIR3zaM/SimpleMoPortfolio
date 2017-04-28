<?php
namespace IVIR3zaM\SimpleMoPortfolio\Queue;

use IVIR3zaM\SimpleMoPortfolio\MoInterface;
use Redis as RedisClient;

class Redis implements QueueInterface
{
    /**
     * @var RedisClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $host = '127.0.0.1';

    /**
     * @var int
     */
    protected $port = 6379;

    /**
     * @var string
     */
    protected $listName = 'MoList';

    /**
     * @param array $options
     * @param RedisClient|null $client
     */
    public function __construct($options = null, RedisClient $client = null)
    {
        if (!empty($options['host'])) {
            $this->setHost($options['host']);
        }
        if (!empty($options['port'])) {
            $this->setPort($options['port']);
        }
        if (!empty($options['list'])) {
            $this->setListName($options['list']);
        }

        if (!$client) {
            $client = new RedisClient();
        }
        $this->setClient($client);
        $this->connect();
    }

    private function connect()
    {
        $this->getClient()->pconnect($this->getHost(), $this->getPort());
    }

    /**
     * @param RedisClient $client
     * @return $this
     */
    public function setClient(RedisClient $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return RedisClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return string The name of the list in the redis
     */
    public function getListName()
    {
        return $this->listName;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setListName($name)
    {
        $this->listName = (string)$name;
        return $this;
    }

    /**
     * @return string The host name of redis server
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = (string)$host;
        return $this;
    }

    /**
     * @return string The host name of redis server
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string $port
     * @return $this
     */
    public function setPort($port)
    {
        $this->port = intval($port);
        return $this;
    }

    /**
     * Push an Mo object into the queue
     * @param MoInterface $mo
     * @return $this
     */
    public function push(MoInterface $mo)
    {
        $this->client->rpush($this->getListName(), serialize($mo));
        return $this;
    }

    /**
     * Get the first item in the queue and remove it from the queue
     * @return MoInterface
     */
    public function pop()
    {
        return unserialize($this->client->lpop($this->getListName()));
    }

    /**
     * Count the number of MOs in the queue
     * @return number
     */
    public function count()
    {
        return $this->client->llen($this->getListName());
    }

    /**
     * Clear all MOs in the queue
     * @return boolean was the process successful or not
     */
    public function clear()
    {
        return $this->client->ltrim($this->getListName(), 1, 0);
    }
}