<?php

namespace PhpCompiler\Telegram\Tools;

class Customiz
{

    /**
     * @param $args
     * @param string $sep
     * @param string $prefix
     * @param string $suffix
     * @param bool $mb
     * @return string
     */
    public function align($args, string $sep = ': ', string $prefix = '', string $suffix = '', bool $mb = false): string
    {
        [$result, $maxLength, $method] = ['', 0, $mb ? 'mb_strlen' : 'strlen'];
        foreach($args as $key => $val){
            if ($method($key) > $maxLength){
                $maxLength = $method($key);
            }
        }
        foreach($args as $key => $val){
            $result .= $prefix.$key.str_repeat(' ', $maxLength - $method($key)).$sep.$val.$suffix.PHP_EOL;
        }
        return $result;
    }

    /**
     * @param mixed $text
     * @return void
     */
    public function closeConnection(mixed $text = null): void
    {
        if(is_callable('litespeed_finish_request') || is_callable('fastcgi_finish_request')) {
            if ($text !== null) {
                echo $text;
            }
            session_write_close();
            is_callable('fastcgi_finish_request')
                ? fastcgi_finish_request()
                : litespeed_finish_request()
            ;
        }
    }

    /**
     * @param $path
     * @return void
     */
    public function delDir($path): void
    {
        $files = glob($path . '/*');
        foreach($files as $file)
            is_dir($file)
                ? $this->delDir($file)
                : unlink($file)
            ;
        rmdir($path);
    }

    /**
     * @param $text
     * @return array|string
     */
    public function mEscape($text): array|string
    {
        return str_replace([
            '*', '`', '[', ']', '(', ')', '_'], [
            '\*', '\`', '\[', '\]', '\(', '\)', '\_',
        ], $text);
    }

}