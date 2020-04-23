<?php


namespace Standard;


use Hashids\Hashids;
use Standard\Uniform\Hash as HashInterface;

class Hash implements HashInterface
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
    /**
     * @var int
     */
    private $length;

    public static function getInstance()
    {
        return self::$instance;
    }

    public function __construct(string $salt, int $length = 0)
    {
        $this->hashids = new Hashids($salt, $length, self::CHARS);
        $this->key = $salt;
        $this->length = $length;

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

    public function str_rand(): string
    {
        $len = strlen(self::CHARS);
        $str = '';
        for ($i = 0; $i < $this->length; $i++) {
            $str .= self::CHARS[rand(0, $len - 1)];
        }
        return $str;
    }
}