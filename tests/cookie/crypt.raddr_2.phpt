--TEST--
cookie encryption using REMOTE_ADDR (cryptraddr=2)
--SKIPIF--
<?php include "../skipif.inc"; ?>
--INI--
suhosin.cookie.encrypt=1
suhosin.cookie.cryptkey=
suhosin.cookie.cryptua=Off
suhosin.cookie.cryptdocroot=Off
suhosin.cookie.cryptraddr=2
suhosin.cookie.checkraddr=0
;suhosin.cookie.cryptlist=
;suhosin.cookie.plainlist=
--ENV--
return <<<END
REMOTE_ADDR=127.0.0.1
END;
--COOKIE--
a=b
--FILE--
<?php
setcookie('foo', 'bar');
$ch = preg_grep("/^Set-Cookie:/", headers_list());
echo join("\n", array_values($ch));
?>
--EXPECTF--
Set-Cookie: foo=iTnKmpON_PFkZ2Sv8omXt_myOw0LIxwZTmj5OZYQ5c8.