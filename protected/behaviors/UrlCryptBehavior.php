<?php

/**
 * Encrypts and decrypts strings, namely those used in GET arguments
 */

class UrlCryptBehavior extends CBehavior
{
    /**
     * @var string Key used for two-way ecryption
     */

    public $key;

    /**
     * Encrypts input
     *
     * @param string $input Unencrypted value meant to be transferred via GET
     * @return string Encrypted version of $input
     */

    public function encrypt($input)
    {
        return rawurlencode(
                base64_encode(
                 mcrypt_encrypt(
                    MCRYPT_RIJNDAEL_256,
                    md5($this->key),
                    $input,
                    MCRYPT_MODE_CBC,
                    md5(md5($this->key))
                )));
    }

    /**
     * Decrypts input encrypted using {@link UrlCryptBehavior::encrypt}
     *
     * @param string $input Value encrypted with {@link UrlCryptBehavior::encrypt}
     * @return string Decrypted string value
     */

    public function decrypt($input)
    {
        return rtrim(
                mcrypt_decrypt(
                 MCRYPT_RIJNDAEL_256,
                 md5($this->key),
                 rawurldecode(base64_decode($input)),
                 MCRYPT_MODE_CBC,
                 md5(md5($this->key))),
                 "\0");
    }    
}
