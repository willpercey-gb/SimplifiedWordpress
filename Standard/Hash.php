<?php


namespace Standard;


use Hashids\Hashids;

class Hash
{
    private const CHARS = '23456789ABCDEFGHJKMNPQRSTUVWXYZ';

    /**
     * @var Hashids
     */
    private $hashids;

    /**
     * @var string
     */
    private $key;

    /**
     * @var Hash
     */
    private static $instance;

    public static function __callStatic($name, $arguments)
    {
        call_user_func_array(self::$instance->$name, $arguments);
    }

    public function __construct(string $salt, int $length = 0)
    {
        $this->hashids = new Hashids($salt, $length, self::CHARS);
        $this->key = $salt;

        self::$instance = $this;
    }

    public function encode(int $id): string
    {
        return $this->hashids->encode($id);
    }

    public function decode(string $hashid): int
    {
        return $this->hashids->decode($hashid)[0] ?? 0;
    }
}