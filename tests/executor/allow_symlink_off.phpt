--TEST--
suhosin.executor.allow_symlink=Off
--SKIPIF--
<?php if (!function_exists("memory_get_usage")) print "skip PHP not compiled with memory_limit support"; ?>
--INI--
error_reporting=E_ALL
open_basedir=
suhosin.log.stdout=255
suhosin.log.script=0
suhosin.log.syslog=0
suhosin.log.sapi=0
suhosin.executor.allow_symlink=Off
--FILE--
<?php
symlink();
ini_set("open_basedir", ".");
symlink();
?>
--EXPECTF--
Warning: symlink() expects exactly 2 parameters, 0 given in %s on line 2
ALERT - symlink called during open_basedir (attacker 'REMOTE_ADDR not set', file '%s', line 4)
