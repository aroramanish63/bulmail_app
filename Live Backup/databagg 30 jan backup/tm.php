
<?php 
echo "sasasasa";
error_reporting(E_ALL);
const CYPHER = 'blowfish';
const MODE   = 'cbc';
const KEY    = 'saurav';

function encrypt($plaintext)
{
    $td = mcrypt_module_open(CYPHER, '', MODE, '');
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td, KEY, $iv);
    $crypttext = mcrypt_generic($td, $plaintext);
    mcrypt_generic_deinit($td);
    return $iv.$crypttext;
}

 function decrypt($crypttext)
{
    $plaintext = '';
    $td        = mcrypt_module_open(CYPHER, '', MODE, '');
    $ivsize    = mcrypt_enc_get_iv_size($td);
    $iv        = substr($crypttext, 0, $ivsize);
    $crypttext = substr($crypttext, $ivsize);
    if ($iv)
    {
        mcrypt_generic_init($td, KEY, $iv);
        $plaintext = mdecrypt_generic($td, $crypttext);
    }
    return $plaintext;
}


$encrypted_string=encrypt('this is a test');
$decrypted_string=decrypt($encrypted_string);

echo "encrypted: $encrypted_string<br>";
echo "decrypted: $decrypted_string<br>";
?>













  