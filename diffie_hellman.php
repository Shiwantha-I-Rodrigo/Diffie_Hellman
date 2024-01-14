<!DOCTYPE html>
<html>

<body>

    <h1>Diffie-Hellman</h1>

    <?php

    // 2048-bit MODP Group prime
    $prime_hex_str = "FFFFFFFFFFFFFFFFC90FDAA22168C234C4C6628B80DC1CD129024E088A67CC74020BBEA63B139B22514A08798E3404DDEF9519B3CD3A431B302B0A6DF25F14374FE1356D6D51C245E485B576625E7EC6F44C42E9A637ED6B0BFF5CB6F406B7EDEE386BFB5A899FA5AE9F24117C4B1FE649286651ECE45B3DC2007CB8A163BF0598DA48361C55D39A69163FA8FD24CF5F83655D23DCA3AD961C62F356208552BB9ED529077096966D670C354E4ABC9804F1746C08CA18217C32905E462E36CE3BE39E772C180E86039B2783A2EC07A28FB5C55DF06F4C52C9DE2BCBF6955817183995497CEA956AE515D2261898FA051015728E5A8AACAA68FFFFFFFFFFFFFFFF";
    $prime_int_str = (string) gmp_init($prime_hex_str, 16);

    $generator_int_str = "2";

    $private_byt = random_bytes(128);
    $private_int_str = (string) gmp_import($private_byt);

    echo "prime: " . strlen($prime_int_str) . "\n" . $prime_int_str . "\n---------";
    echo "private_1: " . strlen($private_int_str) . "\n" . $private_int_str . "\n---------";

    $public_key = bcpowmod($generator_int_str, $private_int_str, $prime_int_str);
    echo "public_1: " . strlen($public_key) . "\n"  . $public_key . "\n---------";

    // recieved parameters

    $private_byt_2 = random_bytes(128);
    $private_int_str_2 = (string) gmp_import($private_byt_2);
    echo "private_2: " . strlen($private_int_str_2) . "\n" . $private_int_str_2 . "\n---------";
    $public_key_2 = bcpowmod($generator_int_str, $private_int_str_2, $prime_int_str);
    echo "public_2: " . strlen($public_key_2) . "\n"  . $public_key_2 . "\n---------";

    // handshake

    $mutual_key = bcpowmod($public_key_2,$private_int_str,$prime_int_str);
    $mutual_key_2 = bcpowmod($public_key,$private_int_str_2,$prime_int_str);
    echo "mutual_1: " . "\n"  . $mutual_key . "\n---------";
    echo "mutual_2: " . "\n"  . $mutual_key_2 . "\n---------";


    ?>

</body>
<!--sudo vim /etc/lighttpd/lighttpd.conf-->
<!--sudo vim /etc/php/php.ini-->
<!--sudo vim /var/log/lighttpd/error.log-->
<!--sudo cp diffie_hellman.php ../lighttpd_root/index.php-->
</html>