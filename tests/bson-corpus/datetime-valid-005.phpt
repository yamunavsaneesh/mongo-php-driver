--TEST--
DateTime: leading zero ms
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/tools.php';

$canonicalBson = hex2bin('10000000096100D1D6D6CC3B01000000');
$canonicalExtJson = '{"a" : {"$date" : {"$numberLong" : "1356351330001"}}}';
$relaxedExtJson = '{"a" : {"$date" : "2012-12-24T12:15:30.001Z"}}';

// Canonical BSON -> Native -> Canonical BSON
echo bin2hex(fromPHP(toPHP($canonicalBson))), "\n";

// Canonical BSON -> Canonical extJSON
echo json_canonicalize(toCanonicalExtendedJSON($canonicalBson)), "\n";

// Canonical BSON -> Relaxed extJSON
echo json_canonicalize(toRelaxedExtendedJSON($canonicalBson)), "\n";

// Canonical extJSON -> Canonical BSON
echo bin2hex(fromJSON($canonicalExtJson)), "\n";

// Relaxed extJSON -> BSON -> Relaxed extJSON
echo json_canonicalize(toRelaxedExtendedJSON(fromJSON($relaxedExtJson))), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
10000000096100d1d6d6cc3b01000000
{"a":{"$date":{"$numberLong":"1356351330001"}}}
{"a":{"$date":"2012-12-24T12:15:30.001Z"}}
10000000096100d1d6d6cc3b01000000
{"a":{"$date":"2012-12-24T12:15:30.001Z"}}
===DONE===