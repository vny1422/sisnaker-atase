<?php
require_once("../connection.php");
require_once("lib/nusoap.php");

function my_character2numeric($t)
{
    $convmap = array(0x0, 0x2FFFF, 0, 0xFFFF);
    return mb_encode_numericentity($t, $convmap, 'UTF-8');
}

function esc($value) {
	return $value != null ? preg_replace('/\p{Cc}+/u', '', $value) : null;
}

/*****************************************************************************
*** KONFIGURASI SOAP
******************************************************************************/
$server = new soap_server();
$server->soap_defencoding = "utf-8";
$server->configureWSDL("Services", "urn:Services_wsdl");



/*****************************************************************************
*** STRUCTURE
******************************************************************************/

// struct DetailJO
$server->wsdl->addComplexType(
	"DetailJO",
	"complexType",
	"struct",
	"all",
	"",
	array(
		"jobdid" => array("name" => "jobdid", "type" => "xsd:string"),
		"jpid" => array("name" => "jpid", "type" => "xsd:string"),
		"jobdl" => array("name" => "jobdl", "type" => "xsd:string"),
		"jobdp" => array("name" => "jobdp", "type" => "xsd:string"),
		"jobdc" => array("name" => "jobdc", "type" => "xsd:string")
	)
);

$server->wsdl->addComplexType(
	"DetailJOArray",
	"complexType",
	"array",
	"",
	"SOAP-ENC:Array",
	array(),
	array(
		array("ref" => "SOAP-ENC:arrayType", "wsdl:arrayType" => "tns:DetailJO[]")
	),
	"tns:DetailJO"
);


// struct JO
$server->wsdl->addComplexType(
	"JO",
	"complexType",
	"struct",
	"all",
	"",
	array(
		"jobid" => array("name" => "jobid", "type" => "xsd:int"),
		"agid" => array("name" => "agid", "type" => "xsd:int"),
		"ppkode" => array("name" => "ppkode", "type" => "xsd:string"),
		"jobno" => array("name" => "jobno", "type" => "xsd:string"),
		"jobtglawal" => array("name" => "jobtglawal", "type" => "xsd:string"),
		"jobtglakhir" => array("name" => "jobtglakhir", "type" => "xsd:string"),
		"detail" => array("name" => "detail", "type" => "tns:DetailJOArray")
	)
);


$server->wsdl->addComplexType(
	"JOArray",
	"complexType",
	"array",
	"",
	"SOAP-ENC:Array",
	array(),
	array(
		array("ref" => "SOAP-ENC:arrayType", "wsdl:arrayType" => "tns:JO[]")
	),
	"tns:JO"
);


$server->wsdl->addComplexType(
	"tki",
	"complexType",
	"struct",
	"all",
	"",
	array(
		"tkid" => array("name" => "tkid", "type" => "xsd:int"),
		"tknama" => array("name" => "tknama", "type" => "xsd:string"),
		"tknamacn" => array("name" => "tknamacn", "type" => "xsd:string"),
		"tkalmtid" => array("name" => "tkalmtid", "type" => "xsd:string"),
		"tkpaspor" => array("name" => "tkpaspor", "type" => "xsd:string"),
		"tktglkeluar" => array("name" => "tktglkeluar", "type" => "xsd:string"),
		"tktmptkeluar" => array("name" => "tktmptkeluar", "type" => "xsd:string"),
		"tktgllahir" => array("name" => "tktgllahir", "type" => "xsd:string"),
		"tktmptlahir" => array("name" => "tktmptlahir", "type" => "xsd:string"),
		"tkjk" => array("name" => "tkjk", "type" => "xsd:string"),
		"tkstatkwn" => array("name" => "tkstatkwn", "type" => "xsd:string"),
		"tkjmlanaktanggungan" => array("name" => "tkjmlanaktanggungan", "type" => "xsd:string"),
		"tkahliwaris" => array("name" => "tkahliwaris", "type" => "xsd:string"),
		"tknama2" => array("name" => "tknama2", "type" => "xsd:string"),
		"tknamacn2" => array("name" => "tknamacn2", "type" => "xsd:string"),
		"tkalmt2" => array("name" => "tkalmt2", "type" => "xsd:string"),
		"tkalmtcn2" => array("name" => "tkalmtcn2", "type" => "xsd:string"),
		"tktelp" => array("name" => "tktelp", "type" => "xsd:string"),
		"tkhub" => array("name" => "tkhub", "type" => "xsd:string"),
		"tkstat" => array("name" => "tkstat", "type" => "xsd:string"),
		"tkrevid" => array("name" => "tkrevid", "type" => "xsd:int"),
		"tktglubah" => array("name" => "tktglubah", "type" => "xsd:string"),
		"tktglendorsement" => array("name" => "tktglendorsement", "type" => "xsd:string"),
		"tktglendorsement2" => array("name" => "tktglendorsement2", "type" => "xsd:string"),
		"tkiid" => array("name" => "tkiid", "type" => "xsd:int")
	)
);


$server->wsdl->addComplexType(
	"tkiArray",
	"complexType",
	"array",
	"",
	"SOAP-ENC:Array",
	array(),
	array(
		array("ref" => "SOAP-ENC:arrayType", "wsdl:arrayType" => "tns:tki[]")
	),
	"tns:tki"
);

$server->wsdl->addComplexType(
	"tkiej",
	"complexType",
	"struct",
	"all",
	"",
	array(
		"tkid" => array("name" => "tkid", "type" => "xsd:int"),
		"tknama" => array("name" => "tknama", "type" => "xsd:string"),
		"tknamacn" => array("name" => "tknamacn", "type" => "xsd:string"),
		"tkalmtid" => array("name" => "tkalmtid", "type" => "xsd:string"),
		"tkpaspor" => array("name" => "tkpaspor", "type" => "xsd:string"),
		"tktglkeluar" => array("name" => "tktglkeluar", "type" => "xsd:string"),
		"tktmptkeluar" => array("name" => "tktmptkeluar", "type" => "xsd:string"),
		"tktgllahir" => array("name" => "tktgllahir", "type" => "xsd:string"),
		"tktmptlahir" => array("name" => "tktmptlahir", "type" => "xsd:string"),
		"tkjk" => array("name" => "tkjk", "type" => "xsd:string"),
		"tkstatkwn" => array("name" => "tkstatkwn", "type" => "xsd:string"),
		"tkjmlanaktanggungan" => array("name" => "tkjmlanaktanggungan", "type" => "xsd:string"),
		"tkahliwaris" => array("name" => "tkahliwaris", "type" => "xsd:string"),
		"tknama2" => array("name" => "tknama2", "type" => "xsd:string"),
		"tknamacn2" => array("name" => "tknamacn2", "type" => "xsd:string"),
		"tkalmt2" => array("name" => "tkalmt2", "type" => "xsd:string"),
		"tkalmtcn2" => array("name" => "tkalmtcn2", "type" => "xsd:string"),
		"tktelp" => array("name" => "tktelp", "type" => "xsd:string"),
		"tkhub" => array("name" => "tkhub", "type" => "xsd:string"),
		"tkstat" => array("name" => "tkstat", "type" => "xsd:string"),
		"tkrevid" => array("name" => "tkrevid", "type" => "xsd:int"),
		"tktglubah" => array("name" => "tktglubah", "type" => "xsd:string"),
		"tktglendorsement" => array("name" => "tktglendorsement", "type" => "xsd:string"),
		"tktglendorsement2" => array("name" => "tktglendorsement2", "type" => "xsd:string"),
		"tkiid" => array("name" => "tkiid", "type" => "xsd:int"),

		"ejid" => array("name" => "ejid", "type" => "xsd:int"),
		"jpid" => array("name" => "jpid", "type" => "xsd:int"),
		"agnama" => array("name" => "agnama", "type" => "xsd:string"),
		"agnamacn" => array("name" => "agnamacn", "type" => "xsd:string"),
		"agnoijincla" => array("name" => "agnoijincla", "type" => "xsd:string"),
		"agalmtkantor" => array("name" => "agalmtkantor", "type" => "xsd:string"),
		"agalmtkantorcn" => array("name" => "agalmtkantorcn", "type" => "xsd:string"),
		"agpngjwb" => array("name" => "agpngjwb", "type" => "xsd:string"),
		"agpngjwbcn" => array("name" => "agpngjwbcn", "type" => "xsd:string"),
		"agtelp" => array("name" => "agtelp", "type" => "xsd:string"),
		"agfax" => array("name" => "agfax", "type" => "xsd:string"),
		"mjktp" => array("name" => "mjktp", "type" => "xsd:string"),
		"mjnama" => array("name" => "mjnama", "type" => "xsd:string"),
		"mjnamacn" => array("name" => "mjnamacn", "type" => "xsd:string"),
		"mjalmt" => array("name" => "mjalmt", "type" => "xsd:string"),
		"mjalmtcn" => array("name" => "mjalmtcn", "type" => "xsd:string"),
		"mjtelp" => array("name" => "mjtelp", "type" => "xsd:string"),
		"mjfax" => array("name" => "mjfax", "type" => "xsd:string"),
		"mjpngjwb" => array("name" => "mjpngjwb", "type" => "xsd:string"),
		"mjpngjwbcn" => array("name" => "mjpngjwbcn", "type" => "xsd:string"),
		"ppnama" => array("name" => "ppnama", "type" => "xsd:string"),
		"ppalmtkantor" => array("name" => "ppalmtkantor", "type" => "xsd:string"),
		"pptelp" => array("name" => "pptelp", "type" => "xsd:string"),
		"ppfax" => array("name" => "ppfax", "type" => "xsd:string"),
		"ppijin" => array("name" => "ppijin", "type" => "xsd:string"),
		"pppngjwb" => array("name" => "pppngjwb", "type" => "xsd:string"),
		"joclano" => array("name" => "joclano", "type" => "xsd:string"),
		"joclatgl" => array("name" => "joclatgl", "type" => "xsd:string"),
		"joestduedate" => array("name" => "joestduedate", "type" => "xsd:string"),
		"jojmltki" => array("name" => "jojmltki", "type" => "xsd:int"),
		"jomkthn" => array("name" => "jomkthn", "type" => "xsd:string"),
		"jomkbln" => array("name" => "jomkbln", "type" => "xsd:string"),
		"jomkhr" => array("name" => "jomkhr", "type" => "xsd:string"),
		"jocatatan" => array("name" => "jocatatan", "type" => "xsd:string"),
		"joposisi" => array("name" => "joposisi", "type" => "xsd:string"),
		"joposisicn" => array("name" => "joposisicn", "type" => "xsd:string"),
		"joakomodasi" => array("name" => "joakomodasi", "type" => "xsd:float"),
		"ejtglendorsement" => array("name" => "ejtglendorsement", "type" => "xsd:string"),
		"ejdatefilled" => array("name" => "ejdatefilled", "type" => "xsd:string"),
		"jpgaji" => array("name" => "jpgaji", "type" => "xsd:float"),
		"jpakomodasi" => array("name" => "jpakomodasi", "type" => "xsd:float"),
		"tki" => array("name" => "tki", "type" => "tns:tkiArray"),

		"kotatempatbekerja" => array("name" => "kotatempatbekerja", "type" => "xsd:string"),

		"url_pdf_tki" => array("name" => "url_pdf_tki", "type" => "xsd:string")
	)
);


$server->wsdl->addComplexType(
	"tkiejArray",
	"complexType",
	"array",
	"",
	"SOAP-ENC:Array",
	array(),
	array(
		array("ref" => "SOAP-ENC:arrayType", "wsdl:arrayType" => "tns:tkiej[]")
	),
	"tns:tkiej"
);


$server->wsdl->addComplexType(
	"cekalresponse",
	"complexType",
	"struct",
	"all",
	"",
	array(
		"status" => array("name" => "status", "type" => "xsd:string"),
		"nama" => array("name" => "nama", "type" => "xsd:string"),
		"comment" => array("name" => "comment", "type" => "xsd:string")
	)
);


// struct PKPacket
$server->wsdl->addComplexType(
	"PKPacket",
	"complexType",
	"struct",
	"all",
	"",
	array(
		"ejid" => array("name" => "ejid", "type" => "xsd:int"),
		"jpid" => array("name" => "jpid", "type" => "xsd:int"),
		"agnama" => array("name" => "agnama", "type" => "xsd:string"),
		"agnamacn" => array("name" => "agnamacn", "type" => "xsd:string"),
		"agnoijincla" => array("name" => "agnoijincla", "type" => "xsd:string"),
		"agalmtkantor" => array("name" => "agalmtkantor", "type" => "xsd:string"),
		"agalmtkantorcn" => array("name" => "agalmtkantorcn", "type" => "xsd:string"),
		"agpngjwb" => array("name" => "agpngjwb", "type" => "xsd:string"),
		"agpngjwbcn" => array("name" => "agpngjwbcn", "type" => "xsd:string"),
		"agtelp" => array("name" => "agtelp", "type" => "xsd:string"),
		"agfax" => array("name" => "agfax", "type" => "xsd:string"),
		"mjktp" => array("name" => "mjktp", "type" => "xsd:string"),
		"mjnama" => array("name" => "mjnama", "type" => "xsd:string"),
		"mjnamacn" => array("name" => "mjnamacn", "type" => "xsd:string"),
		"mjalmt" => array("name" => "mjalmt", "type" => "xsd:string"),
		"mjalmtcn" => array("name" => "mjalmtcn", "type" => "xsd:string"),
		"mjtelp" => array("name" => "mjtelp", "type" => "xsd:string"),
		"mjfax" => array("name" => "mjfax", "type" => "xsd:string"),
		"mjpngjwb" => array("name" => "mjpngjwb", "type" => "xsd:string"),
		"mjpngjwbcn" => array("name" => "mjpngjwbcn", "type" => "xsd:string"),
		"ppnama" => array("name" => "ppnama", "type" => "xsd:string"),
		"ppalmtkantor" => array("name" => "ppalmtkantor", "type" => "xsd:string"),
		"pptelp" => array("name" => "pptelp", "type" => "xsd:string"),
		"ppfax" => array("name" => "ppfax", "type" => "xsd:string"),
		"ppijin" => array("name" => "ppijin", "type" => "xsd:string"),
		"pppngjwb" => array("name" => "pppngjwb", "type" => "xsd:string"),
		"joclano" => array("name" => "joclano", "type" => "xsd:string"),
		"joclatgl" => array("name" => "joclatgl", "type" => "xsd:string"),
		"joestduedate" => array("name" => "joestduedate", "type" => "xsd:string"),
		"jojmltki" => array("name" => "jojmltki", "type" => "xsd:int"),
		"jomkthn" => array("name" => "jomkthn", "type" => "xsd:string"),
		"jomkbln" => array("name" => "jomkbln", "type" => "xsd:string"),
		"jomkhr" => array("name" => "jomkhr", "type" => "xsd:string"),
		"jocatatan" => array("name" => "jocatatan", "type" => "xsd:string"),
		"joposisi" => array("name" => "joposisi", "type" => "xsd:string"),
		"joposisicn" => array("name" => "joposisicn", "type" => "xsd:string"),
		"joakomodasi" => array("name" => "joakomodasi", "type" => "xsd:float"),
		"ejtglendorsement" => array("name" => "ejtglendorsement", "type" => "xsd:string"),
		"ejdatefilled" => array("name" => "ejdatefilled", "type" => "xsd:string"),
		"jpgaji" => array("name" => "jpgaji", "type" => "xsd:float"),
		"jpakomodasi" => array("name" => "jpakomodasi", "type" => "xsd:float"),
		"tki" => array("name" => "tki", "type" => "tns:tkiArray")
	)
);

$server->wsdl->addComplexType(
	"PKPacketArray",
	"complexType",
	"array",
	"",
	"SOAP-ENC:Array",
	array(),
	array(
		array("ref" => "SOAP-ENC:arrayType", "wsdl:arrayType" => "tns:PKPacket[]")
	),
	"tns:PKPacket"
);


// direct hiring
$server->wsdl->addComplexType(
	"hiring",
	"complexType",
	"struct",
	"all",
	"",
	array(
		"idhiring" => array("name" => "idhiring", "type" => "xsd:string"),
		"namatki" => array("name" => "namatki", "type" => "xsd:string"),
		"nomorpaspor" => array("name" => "nomorpaspor", "type" => "xsd:string"),
		"nomorarc" => array("name" => "nomorarc", "type" => "xsd:string"),
		"alamatindonesia" => array("name" => "alamatindonesia", "type" => "xsd:string"),
		"nomorteleponindonesia" => array("name" => "nomorteleponindonesia", "type" => "xsd:string"),
		"nomortelepontaiwan" => array("name" => "nomortelepontaiwan", "type" => "xsd:string"),
		"tanggaldikeluarkan" => array("name" => "tanggaldikeluarkan", "type" => "xsd:string"),
		"pptkis" => array("name" => "pptkis", "type" => "xsd:string"),
		"tanggalpermohonan" => array("name" => "tanggalpermohonan", "type" => "xsd:string"),
		"nomorijincla" => array("name" => "nomorijincla", "type" => "xsd:string"),
		"tanggalijincla" => array("name" => "tanggalijincla", "type" => "xsd:string"),
		"namamajikan" => array("name" => "namamajikan", "type" => "xsd:string"),
		"nomorktpmajikan" => array("name" => "nomorktpmajikan", "type" => "xsd:string"),
		"nomorteleponmajikan" => array("name" => "nomorteleponmajikan", "type" => "xsd:string"),
		"namaorangdirawat" => array("name" => "namaorangdirawat", "type" => "xsd:string"),
		"nomorktporangdirawat" => array("name" => "nomorktporangdirawat", "type" => "xsd:string"),
		"alamattempatbekerja" => array("name" => "alamattempatbekerja", "type" => "xsd:string"),
		"kotatempatbekerja" => array("name" => "kotatempatbekerja", "type" => "xsd:string"),
		"namamajikaneg" => array("name" => "namamajikaneg", "type" => "xsd:string"),
		"alamattempatbekerjaeg" => array("name" => "alamattempatbekerjaeg", "type" => "xsd:string"),
	)
);

$server->wsdl->addComplexType(
	"hiringArray",
	"complexType",
	"array",
	"",
	"SOAP-ENC:Array",
	array(),
	array(
		array("ref" => "SOAP-ENC:arrayType", "wsdl:arrayType" => "tns:hiring[]")
	),
	"tns:hiring"
);

//serviskeberangkatan

$server->wsdl->addComplexType(
'keberangkatan',
'complexType',
'struct',
'all',
'',
array(
'keberangkatanid' => array('name' => 'keberangkatanid', 'type' => 'xsd:string'),
'tkiid' => array('name' => 'tkiid', 'type' => 'xsd:string'),
'tkpaspor' => array('name' => 'tkpaspor', 'type' => 'xsd:string'),
'departurebandaracode' => array ('name' => 'departurebandaracode', 'type' => 'xsd:string'),
'transitport' => array ('name' => 'transitport', 'type' => 'xsd:string'),
'timestamp' => array('name' => 'timestamp', 'type' => 'xsd:string')
));

$server->wsdl->addComplexType(
'keberangkatanReq',
'complexType',
'struct',
'all',
'',
array(
'tkiid' => array('name' => 'tkiid', 'type' => 'xsd:string'),
'tkpaspor' => array('name' => 'tkpaspor', 'type' => 'xsd:string'),
'departurebandaracode' => array ('name' => 'departurebandaracode', 'type' => 'xsd:string'),
'transitport' => array ('name' => 'transitport', 'type' => 'xsd:string'),
'timestamp' => array('name' => 'timestamp', 'type' => 'xsd:string')
));

$server->wsdl->addComplexType(
	"keberangkatanArray",
	"complexType",
	"array",
	"",
	"SOAP-ENC:Array",
	array(),
	array(
		array("ref" => "SOAP-ENC:arrayType", "wsdl:arrayType" => "tns:keberangkatan[]")
	),
	"tns:keberangkatan"
);

$server->wsdl->addComplexType(
'kepulangan',
'complexType',
'struct',
'all',
'',
array(
'kepulanganid' => array('name' => 'kepulanganid', 'type' => 'xsd:string'),
'tkiid' => array('name' => 'tkiid', 'type' => 'xsd:string'),
'tkpaspor' => array('name' => 'tkpaspor', 'type' => 'xsd:string'),
'arrivalbandaracode' => array ('name' => 'arrivalbandaracode', 'type' => 'xsd:string'),
'transitport' => array ('name' => 'transitport', 'type' => 'xsd:string'),
'timestamp' => array('name' => 'timestamp', 'type' => 'xsd:string')
));

$server->wsdl->addComplexType(
'kepulanganReq',
'complexType',
'struct',
'all',
'',
array(
'tkiid' => array('name' => 'tkiid', 'type' => 'xsd:string'),
'tkpaspor' => array('name' => 'tkpaspor', 'type' => 'xsd:string'),
'arrivalbandaracode' => array ('name' => 'arrivalbandaracode', 'type' => 'xsd:string'),
'transitport' => array ('name' => 'transitport', 'type' => 'xsd:string'),
'timestamp' => array('name' => 'timestamp', 'type' => 'xsd:string')
));

$server->wsdl->addComplexType(
	"kepulanganArray",
	"complexType",
	"array",
	"",
	"SOAP-ENC:Array",
	array(),
	array(
		array("ref" => "SOAP-ENC:arrayType", "wsdl:arrayType" => "tns:kepulangan[]")
	),
	"tns:kepulangan"
);

$server->wsdl->addComplexType(
'perlintasan',
'complexType',
'struct',
'all',
'',
array(
'bandaracode' => array('name' => 'bandaracode', 'type' => 'xsd:string'),
'bandaraname' => array('name' => 'bandaraname', 'type' => 'xsd:string'),
'bandaranegaraname' => array ('name' => 'bandaranegaraname', 'type' => 'xsd:string'),
'bandaranegaracode' => array ('name' => 'bandaranegaracode', 'type' => 'xsd:string'),
'bandaraicao' => array('name' => 'bandaraicao', 'type' => 'xsd:string')
));

$server->wsdl->addComplexType(
'perlintasanReq',
'complexType',
'struct',
'all',
'',
array(
'bandaracode' => array('name' => 'bandaracode', 'type' => 'xsd:string'),
'bandaraname' => array('name' => 'bandaraname', 'type' => 'xsd:string'),
'bandaranegaraname' => array ('name' => 'bandaranegaraname', 'type' => 'xsd:string'),
'bandaranegaracode' => array ('name' => 'bandaranegaracode', 'type' => 'xsd:string'),
'bandaraicao' => array('name' => 'bandaraicao', 'type' => 'xsd:string')
));

$server->wsdl->addComplexType(
	"perlintasanArray",
	"complexType",
	"array",
	"",
	"SOAP-ENC:Array",
	array(),
	array(
		array("ref" => "SOAP-ENC:arrayType", "wsdl:arrayType" => "tns:perlintasan[]")
	),
	"tns:perlintasan"
);

//


$server->wsdl->addComplexType(
	"stringArray",
	"complexType",
	"array",
	"",
	"SOAP-ENC:Array",
	array(),
	array(
		array("ref" => "SOAP-ENC:arrayType", "wsdl:arrayType" => "xsd:string[]")
	),
	"xsd:string"
);





/*****************************************************************************
*** Services
******************************************************************************/
 // 1. getJO
$server->register(
	"getJO",
	array(
		"ppkode" => "xsd:string",
		"agid" => "xsd:int"
	),
	array(
		"return" => "tns:JOArray"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#getJO",
	false,
	"encoded",
	"Mendapatkan JO dan detailnya"
);

// 2. readSuratPermintaanBC
$server->register(
	"readSuratPermintaanBC",
	array(
		"barcode" => "xsd:string"
	),
	array(
		"return" => "tns:PKPacket"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#readSuratPermintaanBC",
	false,
	"encoded",
	"Mendapatkan detail dari Paket PK dari barcode Surat Permintaan"
);

// 3. readSuratKuasaBC
$server->register(
	"readSuratKuasaBC",
	array(
		"barcode" => "xsd:string"
	),
	array(
		"return" => "tns:PKPacket"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#readSuratKuasaBC",
	false,
	"encoded",
	"Mendapatkan detail dari Paket PK dari barcode Surat Permintaan"
);

// 4. readPerjanjianKerjaBC
$server->register(
	"readPerjanjianKerjaBC",
	array(
		"barcode" => "xsd:string"
	),
	array(
		"return" => "tns:tki"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#readPerjanjianKerjaBC",
	false,
	"encoded",
	"Mendapatkan detail dari PK tki dari barcode perjanjian kerja"
);

// 5. getPKbyNoPaspor
$server->register(
	"readPerjanjianKerjaByNoPaspor",
	array(
		"nopaspor" => "xsd:string"
	),
	array(
		"return" => "tns:tkiej"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#readPerjanjianKerjaByNoPaspor",
	false,
	"encoded",
	"Mendapatkan detail dari PK tki dari nopaspor"
);

// 6. getPKbyBarcode
$server->register(
	"readPerjanjianKerjaByBarcode",
	array(
		"barcode" => "xsd:string"
	),
	array(
		"return" => "tns:tkiej"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#readPerjanjianKerjaByBarcode",
	false,
	"encoded",
	"Mendapatkan detail dari PK tki dari nopaspor"
);

// 7. isAgensiCekal
$server->register(
	"isAgensiCekal",
	array(
		"IDAgensi" => "xsd:string"
	),
	array(
		"return" => "tns:cekalresponse"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#isAgensiCekal",
	false,
	"encoded",
	"Mengetahui status cekal agensi"
);

// 8. isPPTKISCekal
$server->register(
	"isPPTKISCekal",
	array(
		"IDPPTKIS" => "xsd:string"
	),
	array(
		"return" => "tns:cekalresponse"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#isPPTKISCekal",
	false,
	"encoded",
	"Mengetahui status cekal pptkis"
);

// 9. getJOByDate
$server->register(
	"getJOByDate",
	array(
		"Date" => "xsd:string"
	),
	array(
		"return" => "tns:JOArray"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#getJOByDate",
	false,
	"encoded",
	"Mendapatkan JO dan detailnya berdasarkan waktu berlaku JO"
);

// 10. getDirectHiringByDate
$server->register(
	"getDirectHiringByDate",
	array(
		"Date" => "xsd:string"
	),
	array(
		"return" => "tns:hiringArray"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#getDirectHiringByDate",
	false,
	"encoded",
	"Mendapatkan data direct hiring berdasarkan tanggal"
);


// 11. getPKByDate
$server->register(
	"getPKByDate",
	array(
		"Date" => "xsd:string"
	),
	array(
		"return" => "tns:PKPacketArray"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#getPKByDate",
	false,
	"encoded",
	"Mendapatkan PKPacket berdasarkan tanggal"
);


// 12. getBlacklistAgenByDate
$server->register(
	"getBlacklistAgenByDate",
	array(
		"Date" => "xsd:string"
	),
	array(
		"return" => "tns:stringArray"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#getBlacklistAgenByDate",
	false,
	"encoded",
	"Mendapatkan daftar agensi yang di blacklist."
);

// 13. getDirectHiringbyNoPaspor
$server->register(
	"getDirectHiringbyNoPaspor",
	array(
		"nopaspor" => "xsd:string"
	),
	array(
		"return" => "tns:hiring"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#getDirectHiringbyNoPaspor",
	false,
	"encoded",
	"Mendapatkan detail Direct Hiring dari nopaspor"
);

// 14. pushKeberangkatan
$server->register(
	"pushKeberangkatan",
	array(
		"departArray" => "tns:keberangkatanReq"
	),
	array(
		"return" => "tns:keberangkatanArray"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#pushKeberangkatan",
	"rpc",
	"encoded",
	"Push Data Keberangkatan TKI"
);

// 15. pushKepulangan
$server->register(
	"pushKepulangan",
	array(
		"arriveArray" => "tns:kepulanganReq"
	),
	array(
		"return" => "tns:kepulanganArray"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#pushKepulangan",
	false,
	"encoded",
	"Push Data Kepulangan TKI"
);

// 16. pushPerlintasan
$server->register(
	"pushPerlintasan",
	array(
		"perlintasanArray" => "tns:perlintasanReq"
	),
	array(
		"return" => "tns:perlintasanArray"
	),
	"urn:Services_wsdl",
	"urn:Services_wsdl#pushPerlintasan",
	false,
	"encoded",
	"Push Data Perlintasan atau Bandara Baru"
);

function getJO($ppkode, $agid) {
	$ppkode = escape($ppkode);
	$agid = escape($agid);

	$sql = "
		SELECT
			agid,
			ppkode,
			jobid,
			jobno,
			jobtglawal,
			jobtglakhir
		FROM jo
		WHERE
			jo.agid = $agid
			AND jo.ppkode = $ppkode
		ORDER BY jo.jobid asc
	";
	$result = mysql_query($sql) or die($messages['err_query']);
	$i = 0;
	$r = array();
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$r[$i]["jobid"] = $row['jobid'];
		$r[$i]["agid"] = $row['agid'];
		$r[$i]["ppkode"] = $row['ppkode'];
		$r[$i]["jobno"] = $row['jobno'];
		$r[$i]["jobtglawal"] = $row['jobtglawal'];
		$r[$i]["jobtglakhir"] = $row['jobtglakhir'];

		foreach($r[$i] as $k => $v) {
			$r[$i][$k] = esc($v);
		}

		$sql2 = "
			SELECT
				jobdid,
				jobid,
				jpid,
				jobdl,
				jobdp,
				jobdc
			FROM jodetail
			WHERE
				jobid = " . $r[$i]["jobid"] . "
		";
		$result2 = mysql_query($sql2) or die($messages['err_query']);
		$j=0;
		while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
			$r[$i]["detail"][$j]["jobdid"] = $row2["jobdid"];
			$r[$i]["detail"][$j]["jpid"] = $row2["jpid"];
			$r[$i]["detail"][$j]["jobdl"] = $row2["jobdl"];
			$r[$i]["detail"][$j]["jobdp"] = $row2["jobdp"];
			$r[$i]["detail"][$j]["jobdc"] = $row2["jobdc"];

			foreach($r[$i]["detail"][$j] as $k => $v) {
				$r[$i]["detail"][$j][$k] = esc($v);
			}

			$j++;
		}

		$i++;
	}

	return $r;
}

function readSuratPermintaanBC($barcode) {
	$barcode = escape($barcode);

	$sql = "
		SELECT
			ejid,
			jpid,
			agnama,
			agnamacn,
			agnoijincla,
			agalmtkantor,
			agalmtkantorcn,
			agpngjwb,
			agpngjwbcn,
			agtelp,
			agfax,
			mjktp,
			mjnama,
			mjnamacn,
			mjalmt,
			mjalmtcn,
			mjtelp,
			mjfax,
			mjpngjwb,
			mjpngjwbcn,
			ppnama,
			ppalmtkantor,
			pptelp,
			ppfax,
			ppijin,
			pppngjwb,
			joclano,
			joclatgl,
			joestduedate,
			jojmltki,
			jomkthn,
			jomkbln,
			jomkhr,
			jocatatan,
			joposisi,
			joposisicn,
			joakomodasi,
			ejtglendorsement,
			ejdatefilled,
			jpgaji,
			jpakomodasi
		FROM entryjo
		WHERE
			ejbcsp = $barcode
	";
	$result = mysql_query($sql) or die($messages['err_query']);
	$r = array();
	if($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$r["ejid"] = $row["ejid"];
		$r["jpid"] = $row["jpid"];
		$r["agnama"] = $row["agnama"];
		$r["agnamacn"] = $row["agnamacn"];
		$r["agnoijincla"] = $row["agnoijincla"];
		$r["agalmtkantor"] = $row["agalmtkantor"];
		$r["agalmtkantorcn"] = $row["agalmtkantorcn"];
		$r["agpngjwb"] = $row["agpngjwb"];
		$r["agpngjwbcn"] = $row["agpngjwbcn"];
		$r["agtelp"] = $row["agtelp"];
		$r["agfax"] = $row["agfax"];
		$r["mjktp"] = $row["mjktp"];
		$r["mjnama"] = $row["mjnama"];
		$r["mjnamacn"] = $row["mjnamacn"];
		$r["mjalmt"] = $row["mjalmt"];
		$r["mjalmtcn"] = $row["mjalmtcn"];
		$r["mjtelp"] = $row["mjtelp"];
		$r["mjfax"] = $row["mjfax"];
		$r["mjpngjwb"] = $row["mjpngjwb"];
		$r["mjpngjwbcn"] = $row["mjpngjwbcn"];
		$r["ppnama"] = $row["ppnama"];
		$r["ppalmtkantor"] = $row["ppalmtkantor"];
		$r["pptelp"] = $row["pptelp"];
		$r["ppfax"] = $row["ppfax"];
		$r["ppijin"] = $row["ppijin"];
		$r["pppngjwb"] = $row["pppngjwb"];
		$r["joclano"] = $row["joclano"];
		$r["joclatgl"] = $row["joclatgl"];
		$r["joestduedate"] = $row["joestduedate"];
		$r["jojmltki"] = $row["jojmltki"];
		$r["jomkthn"] = $row["jomkthn"];
		$r["jomkbln"] = $row["jomkbln"];
		$r["jomkhr"] = $row["jomkhr"];
		$r["jocatatan"] = $row["jocatatan"];
		$r["joposisi"] = $row["joposisi"];
		$r["joposisicn"] = $row["joposisicn"];
		$r["joakomodasi"] = $row["joakomodasi"];
		$r["ejtglendorsement"] = $row["ejtglendorsement"];
		$r["ejdatefilled"] = $row["ejdatefilled"];
		$r["jpgaji"] = $row["jpgaji"];
		$r["jpakomodas"] = $row["jpakomodas"];

		foreach($r as $k => $v) {
			$r[$k] = esc($v);
		}

		$sql2 = "
			SELECT
				tkid,
				tknama,
				tknamacn,
				tkalmtid,
				tkpaspor,
				tktglkeluar,
				tktmptkeluar,
				tktgllahir,
				tktmptlahir,
				tkjk,
				tkstatkwn,
				tkjmlanaktanggungan,
				tkahliwaris,
				tknama2,
				tknamacn2,
				tkalmt2,
				tkalmtcn2,
				tktelp,
				tkhub,
				tkstat,
				tkrevid,
				tktglubah,
				tktglendorsement,
				tktglendorsement2,
				tkiid
			FROM tki
			WHERE
				ejid = " . $r["ejid"] . "
		";
		$result2 = mysql_query($sql2) or die($messages['err_query']);
		$i=0;
		while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
			$r["tki"][$i]["tkid"] = $row2["tkid"];
			$r["tki"][$i]["tknama"] = $row2["tknama"];
			$r["tki"][$i]["tknamacn"] = $row2["tknamacn"];
			$r["tki"][$i]["tkalmtid"] = $row2["tkalmtid"];
			$r["tki"][$i]["tkpaspor"] = $row2["tkpaspor"];
			$r["tki"][$i]["tktglkeluar"] = $row2["tktglkeluar"];
			$r["tki"][$i]["tktmptkeluar"] = $row2["tktmptkeluar"];
			$r["tki"][$i]["tktgllahir"] = $row2["tktgllahir"];
			$r["tki"][$i]["tktmptlahir"] = $row2["tktmptlahir"];
			$r["tki"][$i]["tkjk"] = $row2["tkjk"];
			$r["tki"][$i]["tkstatkwn"] = $row2["tkstatkwn"];
			$r["tki"][$i]["tkjmlanaktanggungan"] = $row2["tkjmlanaktanggungan"];
			$r["tki"][$i]["tkahliwaris"] = $row2["tkahliwaris"];
			$r["tki"][$i]["tknama2"] = $row2["tknama2"];
			$r["tki"][$i]["tknamacn2"] = $row2["tknamacn2"];
			$r["tki"][$i]["tkalmt2"] = $row2["tkalmt2"];
			$r["tki"][$i]["tkalmtcn2"] = $row2["tkalmtcn2"];
			$r["tki"][$i]["tktelp"] = $row2["tktelp"];
			$r["tki"][$i]["tkhub"] = $row2["tkhub"];
			$r["tki"][$i]["tkstat"] = $row2["tkstat"];
			$r["tki"][$i]["tkrevid"] = $row2["tkrevid"];
			$r["tki"][$i]["tktglubah"] = $row2["tktglubah"];
			$r["tki"][$i]["tktglendorsement"] = $row2["tktglendorsement"];
			$r["tki"][$i]["tktglendorsement2"] = $row2["tktglendorsement2"];
			$r["tki"][$i]["tkiid"] = $row2["tkiid"];

			foreach($r["tki"][$i] as $k => $v) {
				$r["tki"][$i][$k] = esc($v);
			}

			$i++;
		}
	}

	return $r;
}

function readSuratKuasaBC($barcode) {
	$barcode = escape($barcode);

	$sql = "
		SELECT
			ejid,
			jpid,
			agnama,
			agnamacn,
			agnoijincla,
			agalmtkantor,
			agalmtkantorcn,
			agpngjwb,
			agpngjwbcn,
			agtelp,
			agfax,
			mjktp,
			mjnama,
			mjnamacn,
			mjalmt,
			mjalmtcn,
			mjtelp,
			mjfax,
			mjpngjwb,
			mjpngjwbcn,
			ppnama,
			ppalmtkantor,
			pptelp,
			ppfax,
			ppijin,
			pppngjwb,
			joclano,
			joclatgl,
			joestduedate,
			jojmltki,
			jomkthn,
			jomkbln,
			jomkhr,
			jocatatan,
			joposisi,
			joposisicn,
			joakomodasi,
			ejtglendorsement,
			ejdatefilled,
			jpgaji,
			jpakomodasi
		FROM entryjo
		WHERE
			ejbcsk = $barcode
	";
	$result = mysql_query($sql) or die($messages['err_query']);
	$r = array();
	if($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$r["ejid"] = $row["ejid"];
		$r["jpid"] = $row["jpid"];
		$r["agnama"] = $row["agnama"];
		$r["agnamacn"] = $row["agnamacn"];
		$r["agnoijincla"] = $row["agnoijincla"];
		$r["agalmtkantor"] = $row["agalmtkantor"];
		$r["agalmtkantorcn"] = $row["agalmtkantorcn"];
		$r["agpngjwb"] = $row["agpngjwb"];
		$r["agpngjwbcn"] = $row["agpngjwbcn"];
		$r["agtelp"] = $row["agtelp"];
		$r["agfax"] = $row["agfax"];
		$r["mjktp"] = $row["mjktp"];
		$r["mjnama"] = $row["mjnama"];
		$r["mjnamacn"] = $row["mjnamacn"];
		$r["mjalmt"] = $row["mjalmt"];
		$r["mjalmtcn"] = $row["mjalmtcn"];
		$r["mjtelp"] = $row["mjtelp"];
		$r["mjfax"] = $row["mjfax"];
		$r["mjpngjwb"] = $row["mjpngjwb"];
		$r["mjpngjwbcn"] = $row["mjpngjwbcn"];
		$r["ppnama"] = $row["ppnama"];
		$r["ppalmtkantor"] = $row["ppalmtkantor"];
		$r["pptelp"] = $row["pptelp"];
		$r["ppfax"] = $row["ppfax"];
		$r["ppijin"] = $row["ppijin"];
		$r["pppngjwb"] = $row["pppngjwb"];
		$r["joclano"] = $row["joclano"];
		$r["joclatgl"] = $row["joclatgl"];
		$r["joestduedate"] = $row["joestduedate"];
		$r["jojmltki"] = $row["jojmltki"];
		$r["jomkthn"] = $row["jomkthn"];
		$r["jomkbln"] = $row["jomkbln"];
		$r["jomkhr"] = $row["jomkhr"];
		$r["jocatatan"] = $row["jocatatan"];
		$r["joposisi"] = $row["joposisi"];
		$r["joposisicn"] = $row["joposisicn"];
		$r["joakomodasi"] = $row["joakomodasi"];
		$r["ejtglendorsement"] = $row["ejtglendorsement"];
		$r["ejdatefilled"] = $row["ejdatefilled"];
		$r["jpgaji"] = $row["jpgaji"];
		$r["jpakomodasi"] = $row["jpakomodasi"];

		foreach($r as $k => $v) {
			$r[$k] = esc($v);
		}

		$sql2 = "
			SELECT
				tkid,
				tknama,
				tknamacn,
				tkalmtid,
				tkpaspor,
				tktglkeluar,
				tktmptkeluar,
				tktgllahir,
				tktmptlahir,
				tkjk,
				tkstatkwn,
				tkjmlanaktanggungan,
				tkahliwaris,
				tknama2,
				tknamacn2,
				tkalmt2,
				tkalmtcn2,
				tktelp,
				tkhub,
				tkstat,
				tkrevid,
				tktglubah,
				tktglendorsement,
				tktglendorsement2,
				tkiid
			FROM tki
			WHERE
				ejid = " . $r["ejid"] . "
		";
		$result2 = mysql_query($sql2) or die($messages['err_query']);
		$i=0;
		while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
			$r["tki"][$i]["tkid"] = $row2["tkid"];
			$r["tki"][$i]["tknama"] = $row2["tknama"];
			$r["tki"][$i]["tknamacn"] = $row2["tknamacn"];
			$r["tki"][$i]["tkalmtid"] = $row2["tkalmtid"];
			$r["tki"][$i]["tkpaspor"] = $row2["tkpaspor"];
			$r["tki"][$i]["tktglkeluar"] = $row2["tktglkeluar"];
			$r["tki"][$i]["tktmptkeluar"] = $row2["tktmptkeluar"];
			$r["tki"][$i]["tktgllahir"] = $row2["tktgllahir"];
			$r["tki"][$i]["tktmptlahir"] = $row2["tktmptlahir"];
			$r["tki"][$i]["tkjk"] = $row2["tkjk"];
			$r["tki"][$i]["tkstatkwn"] = $row2["tkstatkwn"];
			$r["tki"][$i]["tkjmlanaktanggungan"] = $row2["tkjmlanaktanggungan"];
			$r["tki"][$i]["tkahliwaris"] = $row2["tkahliwaris"];
			$r["tki"][$i]["tknama2"] = $row2["tknama2"];
			$r["tki"][$i]["tknamacn2"] = $row2["tknamacn2"];
			$r["tki"][$i]["tkalmt2"] = $row2["tkalmt2"];
			$r["tki"][$i]["tkalmtcn2"] = $row2["tkalmtcn2"];
			$r["tki"][$i]["tktelp"] = $row2["tktelp"];
			$r["tki"][$i]["tkhub"] = $row2["tkhub"];
			$r["tki"][$i]["tkstat"] = $row2["tkstat"];
			$r["tki"][$i]["tkrevid"] = $row2["tkrevid"];
			$r["tki"][$i]["tktglubah"] = $row2["tktglubah"];
			$r["tki"][$i]["tktglendorsement"] = $row2["tktglendorsement"];
			$r["tki"][$i]["tktglendorsement2"] = $row2["tktglendorsement2"];
			$r["tki"][$i]["tkiid"] = $row2["tkiid"];

			foreach($r["tki"][$i] as $k => $v) {
				$r["tki"][$i][$k] = esc($v);
			}

			$i++;
		}
	}

	return $r;
}

function readPerjanjianKerjaBC($barcode) {
	$barcode = escape($barcode);

	$sql = "
		SELECT
			tkid,
			tknama,
			tknamacn,
			tkalmtid,
			tkpaspor,
			tktglkeluar,
			tktmptkeluar,
			tktgllahir,
			tktmptlahir,
			tkjk,
			tkstatkwn,
			tkjmlanaktanggungan,
			tkahliwaris,
			tknama2,
			tknamacn2,
			tkalmt2,
			tkalmtcn2,
			tktelp,
			tkhub,
			tkstat,
			tkrevid,
			tktglubah,
			tktglendorsement,
			tktglendorsement2,
			tkiid
		FROM tki
		WHERE
			tkbc = $barcode
	";
	$result = mysql_query($sql) or die($messages['err_query']);
	$r = array();
	if($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$r["tkid"] = $row["tkid"];
		$r["tknama"] = $row["tknama"];
		$r["tknamacn"] = $row["tknamacn"];
		$r["tkalmtid"] = $row["tkalmtid"];
		$r["tkpaspor"] = $row["tkpaspor"];
		$r["tktglkeluar"] = $row["tktglkeluar"];
		$r["tktmptkeluar"] = $row["tktmptkeluar"];
		$r["tktgllahir"] = $row["tktgllahir"];
		$r["tktmptlahir"] = $row["tktmptlahir"];
		$r["tkjk"] = $row["tkjk"];
		$r["tkstatkwn"] = $row["tkstatkwn"];
		$r["tkjmlanaktanggungan"] = $row["tkjmlanaktanggungan"];
		$r["tkahliwaris"] = $row["tkahliwaris"];
		$r["tknama2"] = $row["tknama2"];
		$r["tknamacn2"] = $row["tknamacn2"];
		$r["tkalmt2"] = $row["tkalmt2"];
		$r["tkalmtcn2"] = $row["tkalmtcn2"];
		$r["tktelp"] = $row["tktelp"];
		$r["tkhub"] = $row["tkhub"];
		$r["tkstat"] = $row["tkstat"];
		$r["tkrevid"] = $row["tkrevid"];
		$r["tktglubah"] = $row["tktglubah"];
		$r["tktglendorsement"] = $row["tktglendorsement"];
		$r["tktglendorsement2"] = $row["tktglendorsement2"];
		$r["tkiid"] = $row["tkiid"];

		foreach($r as $k => $v) {
			$r[$k] = esc($v);
		}
	}

	return $r;
}


function readPerjanjianKerjaByNoPaspor($nopaspor) {
	$nopaspor = escape($nopaspor);

	$sql = "
		SELECT
			tkid,
			tknama,
			tknamacn,
			tkalmtid,
			tkpaspor,
			tktglkeluar,
			tktmptkeluar,
			tktgllahir,
			tktmptlahir,
			tkjk,
			tkstatkwn,
			tkjmlanaktanggungan,
			tkahliwaris,
			tknama2,
			tknamacn2,
			tkalmt2,
			tkalmtcn2,
			tktelp,
			tkhub,
			tkstat,
			tkrevid,
			tktglubah,
			tktglendorsement,
			tktglendorsement2,
			tkiid,
			tkbc,
			ej.ejid as ejid,
			jpid,
			agnama,
			agnamacn,
			agnoijincla,
			agalmtkantor,
			agalmtkantorcn,
			agpngjwb,
			agpngjwbcn,
			agtelp,
			agfax,
			mjktp,
			mjnama,
			mjnamacn,
			mjalmt,
			mjalmtcn,
			mjtelp,
			mjfax,
			mjpngjwb,
			mjpngjwbcn,
			ppnama,
			ppalmtkantor,
			pptelp,
			ppfax,
			ppijin,
			pppngjwb,
			joclano,
			joclatgl,
			joestduedate,
			jojmltki,
			jomkthn,
			jomkbln,
			jomkhr,
			jocatatan,
			joposisi,
			joposisicn,
			joakomodasi,
			ejtglendorsement,
			ejdatefilled,
			jpgaji,
			jpakomodasi,
			ejtoken
		FROM tki
		JOIN entryjo as ej
			ON ej.ejid = tki.ejid
		WHERE
			tkpaspor = $nopaspor
			and tktglendorsement IS NOT NULL
			and tkrevid IS NULL
		ORDER BY
			tkid DESC
		LIMIT 0, 1
	";

	$result = mysql_query($sql) or die($messages['err_query']);
	$r = array();
	if($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$r["tkid"] = $row["tkid"];
		$r["tknama"] = $row["tknama"];
		$r["tknamacn"] = $row["tknamacn"];
		$r["tkalmtid"] = $row["tkalmtid"];
		$r["tkpaspor"] = $row["tkpaspor"];
		$r["tktglkeluar"] = $row["tktglkeluar"];
		$r["tktmptkeluar"] = $row["tktmptkeluar"];
		$r["tktgllahir"] = $row["tktgllahir"];
		$r["tktmptlahir"] = $row["tktmptlahir"];
		$r["tkjk"] = $row["tkjk"];
		$r["tkstatkwn"] = $row["tkstatkwn"];
		$r["tkjmlanaktanggungan"] = $row["tkjmlanaktanggungan"];
		$r["tkahliwaris"] = $row["tkahliwaris"];
		$r["tknama2"] = $row["tknama2"];
		$r["tknamacn2"] = $row["tknamacn2"];
		$r["tkalmt2"] = $row["tkalmt2"];
		$r["tkalmtcn2"] = $row["tkalmtcn2"];
		$r["tktelp"] = $row["tktelp"];
		$r["tkhub"] = $row["tkhub"];
		$r["tkstat"] = $row["tkstat"];
		$r["tkrevid"] = $row["tkrevid"];
		$r["tktglubah"] = $row["tktglubah"];
		$r["tktglendorsement"] = $row["tktglendorsement"];
		$r["tktglendorsement2"] = $row["tktglendorsement2"];
		$r["tkiid"] = $row["tkiid"];

		$r["ejid"] = $row["ejid"];
		$r["jpid"] = $row["jpid"];
		$r["agnama"] = $row["agnama"];
		$r["agnamacn"] = $row["agnamacn"];
		$r["agnoijincla"] = $row["agnoijincla"];
		$r["agalmtkantor"] = $row["agalmtkantor"];
		$r["agalmtkantorcn"] = $row["agalmtkantorcn"];
		$r["agpngjwb"] = $row["agpngjwb"];
		$r["agpngjwbcn"] = $row["agpngjwbcn"];
		$r["agtelp"] = $row["agtelp"];
		$r["agfax"] = $row["agfax"];
		$r["mjktp"] = $row["mjktp"];
		$r["mjnama"] = $row["mjnama"];
		$r["mjnamacn"] = $row["mjnamacn"];
		$r["mjalmt"] = $row["mjalmt"];
		$r["mjalmtcn"] = $row["mjalmtcn"];
		$r["mjtelp"] = $row["mjtelp"];
		$r["mjfax"] = $row["mjfax"];
		$r["mjpngjwb"] = $row["mjpngjwb"];
		$r["mjpngjwbcn"] = $row["mjpngjwbcn"];
		$r["ppnama"] = $row["ppnama"];
		$r["ppalmtkantor"] = $row["ppalmtkantor"];
		$r["pptelp"] = $row["pptelp"];
		$r["ppfax"] = $row["ppfax"];
		$r["ppijin"] = $row["ppijin"];
		$r["pppngjwb"] = $row["pppngjwb"];
		$r["joclano"] = $row["joclano"];
		$r["joclatgl"] = $row["joclatgl"];
		$r["joestduedate"] = $row["joestduedate"];
		$r["jojmltki"] = $row["jojmltki"];
		$r["jomkthn"] = $row["jomkthn"];
		$r["jomkbln"] = $row["jomkbln"];
		$r["jomkhr"] = $row["jomkhr"];
		$r["jocatatan"] = $row["jocatatan"];
		$r["joposisi"] = $row["joposisi"];
		$r["joposisicn"] = $row["joposisicn"];
		$r["joakomodasi"] = $row["joakomodasi"];
		$r["ejtglendorsement"] = $row["ejtglendorsement"];
		$r["ejdatefilled"] = $row["ejdatefilled"];
		$r["jpgaji"] = $row["jpgaji"];
		$r["jpakomodasi"] = $row["jpakomodasi"];

		if ($row["jpid"] == 1) {
			$jp = 'nelayan.php';
		} else if ($row["jpid"] == 2) {
			$jp = 'pekerja.php';
		} else if ($row["jpid"] == 3) {
			$jp = 'perawatpanti.php';
		} else if ($row["jpid"] == 4) {
			$jp = 'perawatsakit.php';
		} else if ($row["jpid"] == 5) {
			$jp = 'penata.php';
		} else if ($row["jpid"] == 6) {
			$jp = 'konstruksi.php';
		}

		if ($r["ejtglendorsement"] !== NULL) {
			$r["url_pdf_tki"] = "http://".$_SERVER["SERVER_NAME"]."/doc/$jp?id=".$row["ejtoken"]."&x=".base64_encode($row["tkbc"]);
		} else {
			$r["url_pdf_tki"] = "NOTFOUND";
		}

		//deteksi kotatempatbekerja. Request by Mas Randy 20 Nov 2014. -bagus
		$kota = '';
		$arg1 = $row["mjalmt"];
		$arg2 = mb_substr($row["mjalmtcn"], 0, 30, 'UTF-8');

		if ((substr_count ($arg1, 'Changhua County') > 0) || (substr_count ($arg1, utf8_decode('彰化縣')) > 0) || (substr_count ($arg2, 'Changhua County') > 0) || (substr_count ($arg2, utf8_decode('彰化縣')) > 0))  {$kota = 'Changhua County';}
		else if ((substr_count ($arg1, 'Chiayi City') > 0) || (substr_count ($arg1, utf8_decode('嘉義市')) > 0) || (substr_count ($arg2, 'Chiayi City') > 0) || (substr_count ($arg2, utf8_decode('嘉義市')) > 0))  {$kota = 'Chiayi City';}
		else if ((substr_count ($arg1, 'Chiayi County') > 0) || (substr_count ($arg1, utf8_decode('嘉義縣')) > 0) || (substr_count ($arg2, 'Chiayi County') > 0) || (substr_count ($arg2, utf8_decode('嘉義縣')) > 0))  {$kota = 'Chiayi County';}
		else if ((substr_count ($arg1, 'Hsinchu City') > 0) || (substr_count ($arg1, utf8_decode('新竹市')) > 0) || (substr_count ($arg2, 'Hsinchu City') > 0) || (substr_count ($arg2, utf8_decode('新竹市')) > 0))  {$kota = 'Hsinchu City';}
		else if ((substr_count ($arg1, 'Hsinchu County') > 0) || (substr_count ($arg1, utf8_decode('新竹縣')) > 0) || (substr_count ($arg2, 'Hsinchu County') > 0) || (substr_count ($arg2, utf8_decode('新竹縣')) > 0))  {$kota = 'Hsinchu County';}
		else if ((substr_count ($arg1, 'Hualien County') > 0) || (substr_count ($arg1, utf8_decode('花蓮縣')) > 0) || (substr_count ($arg2, 'Hualien County') > 0) || (substr_count ($arg2, utf8_decode('花蓮縣')) > 0))  {$kota = 'Hualien County';}
		else if ((substr_count ($arg1, 'Kaohsiung City') > 0) || (substr_count ($arg1, utf8_decode('高雄市')) > 0) || (substr_count ($arg2, 'Kaohsiung City') > 0) || (substr_count ($arg2, utf8_decode('高雄市')) > 0))  {$kota = 'Kaohsiung City';}
		else if ((substr_count ($arg1, 'Keelung City') > 0) || (substr_count ($arg1, utf8_decode('基隆市')) > 0) || (substr_count ($arg2, 'Keelung City') > 0) || (substr_count ($arg2, utf8_decode('基隆市')) > 0))  {$kota = 'Keelung City';}
		else if ((substr_count ($arg1, 'Kinmen County') > 0) || (substr_count ($arg1, utf8_decode('金門縣')) > 0) || (substr_count ($arg2, 'Kinmen County') > 0) || (substr_count ($arg2, utf8_decode('金門縣')) > 0))  {$kota = 'Kinmen County';}
		else if ((substr_count ($arg1, 'Lienchiang County') > 0) || (substr_count ($arg1, utf8_decode('連江縣')) > 0) || (substr_count ($arg2, 'Lienchiang County') > 0) || (substr_count ($arg2, utf8_decode('連江縣')) > 0))  {$kota = 'Lienchiang County';}
		else if ((substr_count ($arg1, 'Miaoli County') > 0) || (substr_count ($arg1, utf8_decode('苗栗縣')) > 0) || (substr_count ($arg2, 'Miaoli County') > 0) || (substr_count ($arg2, utf8_decode('苗栗縣')) > 0))  {$kota = 'Miaoli County';}
		else if ((substr_count ($arg1, 'Nantou County') > 0) || (substr_count ($arg1, utf8_decode('南投縣')) > 0) || (substr_count ($arg2, 'Nantou County') > 0) || (substr_count ($arg2, utf8_decode('南投縣')) > 0))  {$kota = 'Nantou County';}
		else if ((substr_count ($arg1, 'New Taipei City') > 0) || (substr_count ($arg1, utf8_decode('新北市')) > 0) || (substr_count ($arg2, 'New Taipei City') > 0) || (substr_count ($arg2, utf8_decode('新北市')) > 0))  {$kota = 'New Taipei City';}
		else if ((substr_count ($arg1, 'Penghu County') > 0) || (substr_count ($arg1, utf8_decode('澎湖縣')) > 0) || (substr_count ($arg2, 'Penghu County') > 0) || (substr_count ($arg2, utf8_decode('澎湖縣')) > 0))  {$kota = 'Penghu County';}
		else if ((substr_count ($arg1, 'Pingtung County') > 0) || (substr_count ($arg1, utf8_decode('屏東縣')) > 0) || (substr_count ($arg2, 'Pingtung County') > 0) || (substr_count ($arg2, utf8_decode('屏東縣')) > 0))  {$kota = 'Pingtung County';}
		else if ((substr_count ($arg1, 'Tainan City') > 0) || (substr_count ($arg1, utf8_decode('臺南市')) > 0) || (substr_count ($arg2, 'Tainan City') > 0) || (substr_count ($arg2, utf8_decode('臺南市')) > 0))  {$kota = 'Tainan City';}
		else if ((substr_count ($arg1, 'Tainan City') > 0) || (substr_count ($arg1, utf8_decode('台南市')) > 0) || (substr_count ($arg2, 'Tainan City') > 0) || (substr_count ($arg2, utf8_decode('台南市')) > 0))  {$kota = 'Tainan City';}
		else if ((substr_count ($arg1, 'Taichung City') > 0) || (substr_count ($arg1, utf8_decode('臺中市')) > 0) || (substr_count ($arg2, 'Taichung City') > 0) || (substr_count ($arg2, utf8_decode('臺中市')) > 0))  {$kota = 'Taichung City';}
		else if ((substr_count ($arg1, 'Taichung City') > 0) || (substr_count ($arg1, utf8_decode('台中市')) > 0) || (substr_count ($arg2, 'Taichung City') > 0) || (substr_count ($arg2, utf8_decode('台中市')) > 0))  {$kota = 'Taichung City';}
		else if ((substr_count ($arg1, 'Taipei City') > 0) || (substr_count ($arg1, utf8_decode('臺北市')) > 0) || (substr_count ($arg2, 'Taipei City') > 0) || (substr_count ($arg2, utf8_decode('臺北市')) > 0))  {$kota = 'Taipei City';}
		else if ((substr_count ($arg1, 'Taipei City') > 0) || (substr_count ($arg1, utf8_decode('台北市')) > 0) || (substr_count ($arg2, 'Taipei City') > 0) || (substr_count ($arg2, utf8_decode('台北市')) > 0))  {$kota = 'Taipei City';}
		else if ((substr_count ($arg1, 'Taitung County') > 0) || (substr_count ($arg1, utf8_decode('臺東縣')) > 0) || (substr_count ($arg2, 'Taitung County') > 0) || (substr_count ($arg2, utf8_decode('臺東縣')) > 0))  {$kota = 'Taitung County';}
		else if ((substr_count ($arg1, 'Taitung County') > 0) || (substr_count ($arg1, utf8_decode('台東縣')) > 0) || (substr_count ($arg2, 'Taitung County') > 0) || (substr_count ($arg2, utf8_decode('台東縣')) > 0))  {$kota = 'Taitung County';}
		else if ((substr_count ($arg1, 'Taoyuan County') > 0) || (substr_count ($arg1, utf8_decode('桃園縣')) > 0) || (substr_count ($arg2, 'Taoyuan County') > 0) || (substr_count ($arg2, utf8_decode('桃園縣')) > 0))  {$kota = 'Taoyuan County';}
		else if ((substr_count ($arg1, 'Yilan County') > 0) || (substr_count ($arg1, utf8_decode('宜蘭縣')) > 0) || (substr_count ($arg2, 'Yilan County') > 0) || (substr_count ($arg2, utf8_decode('宜蘭縣')) > 0))  {$kota = 'Yilan County';}
		else if ((substr_count ($arg1, 'Yunlin County') > 0) || (substr_count ($arg1, utf8_decode('雲林縣')) > 0) || (substr_count ($arg2, 'Yunlin County') > 0) || (substr_count ($arg2, utf8_decode('雲林縣')) > 0))  {$kota = 'Yunlin County';}
		else {$kota = 'Kapal Laut atau Tidak Terdeteksi';}

		$r["kotatempatbekerja"] = $kota;
	// selesai

		foreach($r as $k => $v) {
			$r[$k] = esc($v);
		}
	}

	return $r;
}


function readPerjanjianKerjaByBarcode($barcode) {
	$barcode = escape($barcode);

	$sql = "
		SELECT
			tkid,
			tkbc,
			tknama,
			tknamacn,
			tkalmtid,
			tkpaspor,
			tktglkeluar,
			tktmptkeluar,
			tktgllahir,
			tktmptlahir,
			tkjk,
			tkstatkwn,
			tkjmlanaktanggungan,
			tkahliwaris,
			tknama2,
			tknamacn2,
			tkalmt2,
			tkalmtcn2,
			tktelp,
			tkhub,
			tkstat,
			tkrevid,
			tktglubah,
			tktglendorsement,
			tktglendorsement2,
			tkiid,
			ej.ejid as ejid,
			jpid,
			agnama,
			agnamacn,
			agnoijincla,
			agalmtkantor,
			agalmtkantorcn,
			agpngjwb,
			agpngjwbcn,
			agtelp,
			agfax,
			mjktp,
			mjnama,
			mjnamacn,
			mjalmt,
			mjalmtcn,
			mjtelp,
			mjfax,
			mjpngjwb,
			mjpngjwbcn,
			ppnama,
			ppalmtkantor,
			pptelp,
			ppfax,
			ppijin,
			pppngjwb,
			joclano,
			joclatgl,
			joestduedate,
			jojmltki,
			jomkthn,
			jomkbln,
			jomkhr,
			jocatatan,
			joposisi,
			joposisicn,
			joakomodasi,
			ejtglendorsement,
			ejdatefilled,
			jpgaji,
			jpakomodasi,
			ejtoken
		FROM tki
		JOIN entryjo as ej
			ON ej.ejid = tki.ejid
		WHERE
			tkbc = $barcode
		ORDER BY
			tkid DESC
		LIMIT 0, 1
	";

	$result = mysql_query($sql) or die($messages['err_query']);
	$r = array();
	if ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$r["tkid"] = $row["tkid"];
		$r["tknama"] = $row["tknama"];
		$r["tknamacn"] = $row["tknamacn"];
		$r["tkalmtid"] = $row["tkalmtid"];
		$r["tkpaspor"] = $row["tkpaspor"];
		$r["tktglkeluar"] = $row["tktglkeluar"];
		$r["tktmptkeluar"] = $row["tktmptkeluar"];
		$r["tktgllahir"] = $row["tktgllahir"];
		$r["tktmptlahir"] = $row["tktmptlahir"];
		$r["tkjk"] = $row["tkjk"];
		$r["tkstatkwn"] = $row["tkstatkwn"];
		$r["tkjmlanaktanggungan"] = $row["tkjmlanaktanggungan"];
		$r["tkahliwaris"] = $row["tkahliwaris"];
		$r["tknama2"] = $row["tknama2"];
		$r["tknamacn2"] = $row["tknamacn2"];
		$r["tkalmt2"] = $row["tkalmt2"];
		$r["tkalmtcn2"] = $row["tkalmtcn2"];
		$r["tktelp"] = $row["tktelp"];
		$r["tkhub"] = $row["tkhub"];
		$r["tkstat"] = $row["tkstat"];
		$r["tkrevid"] = $row["tkrevid"];
		$r["tktglubah"] = $row["tktglubah"];
		$r["tktglendorsement"] = $row["tktglendorsement"];
		$r["tktglendorsement2"] = $row["tktglendorsement2"];
		$r["tkiid"] = $row["tkiid"];

		$r["ejid"] = $row["ejid"];
		$r["jpid"] = $row["jpid"];
		$r["agnama"] = $row["agnama"];
		$r["agnamacn"] = $row["agnamacn"];
		$r["agnoijincla"] = $row["agnoijincla"];
		$r["agalmtkantor"] = $row["agalmtkantor"];
		$r["agalmtkantorcn"] = $row["agalmtkantorcn"];
		$r["agpngjwb"] = $row["agpngjwb"];
		$r["agpngjwbcn"] = $row["agpngjwbcn"];
		$r["agtelp"] = $row["agtelp"];
		$r["agfax"] = $row["agfax"];
		$r["mjktp"] = $row["mjktp"];
		$r["mjnama"] = $row["mjnama"];
		$r["mjnamacn"] = $row["mjnamacn"];
		$r["mjalmt"] = $row["mjalmt"];
		$r["mjalmtcn"] = $row["mjalmtcn"];
		$r["mjtelp"] = $row["mjtelp"];
		$r["mjfax"] = $row["mjfax"];
		$r["mjpngjwb"] = $row["mjpngjwb"];
		$r["mjpngjwbcn"] = $row["mjpngjwbcn"];
		$r["ppnama"] = $row["ppnama"];
		$r["ppalmtkantor"] = $row["ppalmtkantor"];
		$r["pptelp"] = $row["pptelp"];
		$r["ppfax"] = $row["ppfax"];
		$r["ppijin"] = $row["ppijin"];
		$r["pppngjwb"] = $row["pppngjwb"];
		$r["joclano"] = $row["joclano"];
		$r["joclatgl"] = $row["joclatgl"];
		$r["joestduedate"] = $row["joestduedate"];
		$r["jojmltki"] = $row["jojmltki"];
		$r["jomkthn"] = $row["jomkthn"];
		$r["jomkbln"] = $row["jomkbln"];
		$r["jomkhr"] = $row["jomkhr"];
		$r["jocatatan"] = $row["jocatatan"];
		$r["joposisi"] = $row["joposisi"];
		$r["joposisicn"] = $row["joposisicn"];
		$r["joakomodasi"] = $row["joakomodasi"];
		$r["ejtglendorsement"] = $row["ejtglendorsement"];
		$r["ejdatefilled"] = $row["ejdatefilled"];
		$r["jpgaji"] = $row["jpgaji"];
		$r["jpakomodasi"] = $row["jpakomodasi"];

		if ($row["jpid"] == 1) {
			$jp = 'nelayan.php';
		} else if ($row["jpid"] == 2) {
			$jp = 'pekerja.php';
		} else if ($row["jpid"] == 3) {
			$jp = 'perawatpanti.php';
		} else if ($row["jpid"] == 4) {
			$jp = 'perawatsakit.php';
		} else if ($row["jpid"] == 5) {
			$jp = 'penata.php';
		} else if ($row["jpid"] == 6) {
			$jp = 'konstruksi.php';
		}

		if ($r["ejtglendorsement"] !== NULL) {
			$r["url_pdf_tki"] = "http://".$_SERVER["SERVER_NAME"]."/doc/$jp?id=".$row["ejtoken"]."&x=".base64_encode($row["tkbc"]);
		} else {
			$r["url_pdf_tki"] = "NOTFOUND";
		}

		//deteksi kotatempatbekerja. Request by Mas Randy 20 Nov 2014. -bagus
		$kota = '';
		$arg1 = $row["mjalmt"];
		$arg2 = mb_substr($row["mjalmtcn"], 0, 30, 'UTF-8');

		if ((substr_count ($arg1, 'Changhua County') > 0) || (substr_count ($arg1, utf8_decode('彰化縣')) > 0) || (substr_count ($arg2, 'Changhua County') > 0) || (substr_count ($arg2, utf8_decode('彰化縣')) > 0))  {$kota = 'Changhua County';}
		else if ((substr_count ($arg1, 'Chiayi City') > 0) || (substr_count ($arg1, utf8_decode('嘉義市')) > 0) || (substr_count ($arg2, 'Chiayi City') > 0) || (substr_count ($arg2, utf8_decode('嘉義市')) > 0))  {$kota = 'Chiayi City';}
		else if ((substr_count ($arg1, 'Chiayi County') > 0) || (substr_count ($arg1, utf8_decode('嘉義縣')) > 0) || (substr_count ($arg2, 'Chiayi County') > 0) || (substr_count ($arg2, utf8_decode('嘉義縣')) > 0))  {$kota = 'Chiayi County';}
		else if ((substr_count ($arg1, 'Hsinchu City') > 0) || (substr_count ($arg1, utf8_decode('新竹市')) > 0) || (substr_count ($arg2, 'Hsinchu City') > 0) || (substr_count ($arg2, utf8_decode('新竹市')) > 0))  {$kota = 'Hsinchu City';}
		else if ((substr_count ($arg1, 'Hsinchu County') > 0) || (substr_count ($arg1, utf8_decode('新竹縣')) > 0) || (substr_count ($arg2, 'Hsinchu County') > 0) || (substr_count ($arg2, utf8_decode('新竹縣')) > 0))  {$kota = 'Hsinchu County';}
		else if ((substr_count ($arg1, 'Hualien County') > 0) || (substr_count ($arg1, utf8_decode('花蓮縣')) > 0) || (substr_count ($arg2, 'Hualien County') > 0) || (substr_count ($arg2, utf8_decode('花蓮縣')) > 0))  {$kota = 'Hualien County';}
		else if ((substr_count ($arg1, 'Kaohsiung City') > 0) || (substr_count ($arg1, utf8_decode('高雄市')) > 0) || (substr_count ($arg2, 'Kaohsiung City') > 0) || (substr_count ($arg2, utf8_decode('高雄市')) > 0))  {$kota = 'Kaohsiung City';}
		else if ((substr_count ($arg1, 'Keelung City') > 0) || (substr_count ($arg1, utf8_decode('基隆市')) > 0) || (substr_count ($arg2, 'Keelung City') > 0) || (substr_count ($arg2, utf8_decode('基隆市')) > 0))  {$kota = 'Keelung City';}
		else if ((substr_count ($arg1, 'Kinmen County') > 0) || (substr_count ($arg1, utf8_decode('金門縣')) > 0) || (substr_count ($arg2, 'Kinmen County') > 0) || (substr_count ($arg2, utf8_decode('金門縣')) > 0))  {$kota = 'Kinmen County';}
		else if ((substr_count ($arg1, 'Lienchiang County') > 0) || (substr_count ($arg1, utf8_decode('連江縣')) > 0) || (substr_count ($arg2, 'Lienchiang County') > 0) || (substr_count ($arg2, utf8_decode('連江縣')) > 0))  {$kota = 'Lienchiang County';}
		else if ((substr_count ($arg1, 'Miaoli County') > 0) || (substr_count ($arg1, utf8_decode('苗栗縣')) > 0) || (substr_count ($arg2, 'Miaoli County') > 0) || (substr_count ($arg2, utf8_decode('苗栗縣')) > 0))  {$kota = 'Miaoli County';}
		else if ((substr_count ($arg1, 'Nantou County') > 0) || (substr_count ($arg1, utf8_decode('南投縣')) > 0) || (substr_count ($arg2, 'Nantou County') > 0) || (substr_count ($arg2, utf8_decode('南投縣')) > 0))  {$kota = 'Nantou County';}
		else if ((substr_count ($arg1, 'New Taipei City') > 0) || (substr_count ($arg1, utf8_decode('新北市')) > 0) || (substr_count ($arg2, 'New Taipei City') > 0) || (substr_count ($arg2, utf8_decode('新北市')) > 0))  {$kota = 'New Taipei City';}
		else if ((substr_count ($arg1, 'Penghu County') > 0) || (substr_count ($arg1, utf8_decode('澎湖縣')) > 0) || (substr_count ($arg2, 'Penghu County') > 0) || (substr_count ($arg2, utf8_decode('澎湖縣')) > 0))  {$kota = 'Penghu County';}
		else if ((substr_count ($arg1, 'Pingtung County') > 0) || (substr_count ($arg1, utf8_decode('屏東縣')) > 0) || (substr_count ($arg2, 'Pingtung County') > 0) || (substr_count ($arg2, utf8_decode('屏東縣')) > 0))  {$kota = 'Pingtung County';}
		else if ((substr_count ($arg1, 'Tainan City') > 0) || (substr_count ($arg1, utf8_decode('臺南市')) > 0) || (substr_count ($arg2, 'Tainan City') > 0) || (substr_count ($arg2, utf8_decode('臺南市')) > 0))  {$kota = 'Tainan City';}
		else if ((substr_count ($arg1, 'Tainan City') > 0) || (substr_count ($arg1, utf8_decode('台南市')) > 0) || (substr_count ($arg2, 'Tainan City') > 0) || (substr_count ($arg2, utf8_decode('台南市')) > 0))  {$kota = 'Tainan City';}
		else if ((substr_count ($arg1, 'Taichung City') > 0) || (substr_count ($arg1, utf8_decode('臺中市')) > 0) || (substr_count ($arg2, 'Taichung City') > 0) || (substr_count ($arg2, utf8_decode('臺中市')) > 0))  {$kota = 'Taichung City';}
		else if ((substr_count ($arg1, 'Taichung City') > 0) || (substr_count ($arg1, utf8_decode('台中市')) > 0) || (substr_count ($arg2, 'Taichung City') > 0) || (substr_count ($arg2, utf8_decode('台中市')) > 0))  {$kota = 'Taichung City';}
		else if ((substr_count ($arg1, 'Taipei City') > 0) || (substr_count ($arg1, utf8_decode('臺北市')) > 0) || (substr_count ($arg2, 'Taipei City') > 0) || (substr_count ($arg2, utf8_decode('臺北市')) > 0))  {$kota = 'Taipei City';}
		else if ((substr_count ($arg1, 'Taipei City') > 0) || (substr_count ($arg1, utf8_decode('台北市')) > 0) || (substr_count ($arg2, 'Taipei City') > 0) || (substr_count ($arg2, utf8_decode('台北市')) > 0))  {$kota = 'Taipei City';}
		else if ((substr_count ($arg1, 'Taitung County') > 0) || (substr_count ($arg1, utf8_decode('臺東縣')) > 0) || (substr_count ($arg2, 'Taitung County') > 0) || (substr_count ($arg2, utf8_decode('臺東縣')) > 0))  {$kota = 'Taitung County';}
		else if ((substr_count ($arg1, 'Taitung County') > 0) || (substr_count ($arg1, utf8_decode('台東縣')) > 0) || (substr_count ($arg2, 'Taitung County') > 0) || (substr_count ($arg2, utf8_decode('台東縣')) > 0))  {$kota = 'Taitung County';}
		else if ((substr_count ($arg1, 'Taoyuan County') > 0) || (substr_count ($arg1, utf8_decode('桃園縣')) > 0) || (substr_count ($arg2, 'Taoyuan County') > 0) || (substr_count ($arg2, utf8_decode('桃園縣')) > 0))  {$kota = 'Taoyuan County';}
		else if ((substr_count ($arg1, 'Yilan County') > 0) || (substr_count ($arg1, utf8_decode('宜蘭縣')) > 0) || (substr_count ($arg2, 'Yilan County') > 0) || (substr_count ($arg2, utf8_decode('宜蘭縣')) > 0))  {$kota = 'Yilan County';}
		else if ((substr_count ($arg1, 'Yunlin County') > 0) || (substr_count ($arg1, utf8_decode('雲林縣')) > 0) || (substr_count ($arg2, 'Yunlin County') > 0) || (substr_count ($arg2, utf8_decode('雲林縣')) > 0))  {$kota = 'Yunlin County';}
		else {$kota = 'Kapal Laut atau Tidak Terdeteksi';}

		$r["kotatempatbekerja"] = $kota;
	// selesai

		foreach($r as $k => $v) {
			$r[$k] = esc($v);
		}
	}

	return $r;
}

function isAgensiCekal($IDAgensi) {
	$IDAgensi = escape($IDAgensi);
	$r = array();

	$sql = "
		SELECT
			mag.agcekal,
			mag.agnama
		FROM magensi mag
		WHERE
			mag.agid = $IDAgensi
	";

	$result = mysql_query($sql) or die($messages['err_query']);

	if ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		switch ($row["agcekal"]) {
			case "0":
				$r["status"] = "ACTIVE";
				$r["comment"] = "Tidak dicekal";
				break;
			case "1":
				$r["status"] = "INACTIVE";
				$r["comment"] = "Dicekal";
				break;
		}

		$r["nama"] = strtoupper($row["agnama"]);
	} else {
		$r["status"] = "NOT FOUND";
		$r["nama"] = "";
		$r["comment"] = "Tidak ada Agensi";
	}

	return $r;
}

function isPPTKISCekal($IDPPTKIS) {
	$IDPPTKIS = escape($IDPPTKIS);
	$r = array();

	$sql = "
		SELECT
			mpp.ppcekal,
			mpp.ppnama
		FROM mpptkis mpp
		WHERE
			mpp.ppkode = $IDPPTKIS
	";

	$result = mysql_query($sql) or die($messages['err_query']);

	if ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		switch ($row["ppcekal"]) {
			case "0":
				$r["status"] = "ACTIVE";
				$r["comment"] = "Tidak dicekal";
				break;
			case "1":
				$r["status"] = "INACTIVE";
				$r["comment"] = "Dicekal";
				break;
		}

		$r["nama"] = strtoupper($row["ppnama"]);
	} else {
		$r["status"] = "NOT FOUND";
		$r["nama"] = "";
		$r["comment"] = "Tidak ada PPTKIS";
	}

	return $r;
}

function getJOByDate($date) {
	ini_set('max_execution_time', 600);

	$date = escape($date);

	$sql = "
		SELECT
			agid,
			ppkode,
			jobid,
			jobno,
			jobtglawal,
			jobtglakhir
		FROM jo
		WHERE
			STR_TO_DATE($date, '%Y-%m-%d') BETWEEN jobtglawal AND jobtglakhir
		ORDER BY jo.jobid asc
	";
	$result = mysql_query($sql) or die($messages['err_query']);
	$i = 0;
	$r = array();
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$r[$i]["jobid"] = $row['jobid'];
		$r[$i]["agid"] = $row['agid'];
		$r[$i]["ppkode"] = $row['ppkode'];
		$r[$i]["jobno"] = $row['jobno'];
		$r[$i]["jobtglawal"] = $row['jobtglawal'];
		$r[$i]["jobtglakhir"] = $row['jobtglakhir'];

		foreach($r[$i] as $k => $v) {
			$r[$i][$k] = esc($v);
		}

		$sql2 = "
			SELECT
				jobdid,
				jobid,
				jpid,
				jobdl,
				jobdp,
				jobdc
			FROM jodetail
			WHERE
				jobid = " . $r[$i]["jobid"] . "
		";
		$result2 = mysql_query($sql2) or die($messages['err_query']);
		$j=0;
		while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
			$r[$i]["detail"][$j]["jobdid"] = $row2["jobdid"];
			$r[$i]["detail"][$j]["jpid"] = $row2["jpid"];
			$r[$i]["detail"][$j]["jobdl"] = $row2["jobdl"];
			$r[$i]["detail"][$j]["jobdp"] = $row2["jobdp"];
			$r[$i]["detail"][$j]["jobdc"] = $row2["jobdc"];

			foreach($r[$i]["detail"][$j] as $k => $v) {
				$r[$i]["detail"][$j][$k] = esc($v);
			}

			$j++;
		}

		$i++;
	}

	return $r;
}

function getDirectHiringByDate($date) {
	$date = escape($date, false);

	$link2 = mysql_connect("localhost", "endorsement", "kdei") or die($messages['err_connect_db']);
	mysql_select_db("hiring") or die($messages['err_select_db']);

	mysql_query("SET character_set_client=utf8", $link2);
	mysql_query("SET character_set_connection=utf8", $link2);
	mysql_query("SET character_set_results=utf8", $link2);

	$sql = "
		SELECT
			keterangan.idhiring,
			formulir.namatki,
			formulir.nomorpaspor,
			formulir.nomorarc,
			formulir.alamatindonesia,
			formulir.nomorteleponindonesia,
			formulir.nomortelepontaiwan,
			keterangan.tanggaltandatangan,
			formulir.pptkis,
			formulir.tanggalpermohonan,
			formulir.nomorijincla,
			formulir.tanggalcla,
			formulir.namamajikan,
			formulir.nomorktpmajikan,
			formulir.nomorteleponmajikan,
			formulir.namaorangdirawat,
			formulir.nomorktporangdirawat,
			formulir.alamattempatbekerja,
			formulir.namamajikaneg,
			formulir.alamattempatbekerjaeg
		FROM keterangan, formulir
		WHERE
			keterangan.idhiring = formulir.idhiring
			AND keterangan.uploadtime LIKE '%$date%'
	";

	$result = mysql_query($sql, $link2) or die($messages['err_query']);
	$r = array();
	$i=0;
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$r[$i]["idhiring"] = $row["idhiring"];
		$r[$i]["namatki"] = $row["namatki"];
		$r[$i]["nomorpaspor"] = $row["nomorpaspor"];
		$r[$i]["nomorarc"] = $row["nomorarc"];
		$r[$i]["alamatindonesia"] = $row["alamatindonesia"];
		$r[$i]["nomorteleponindonesia"] = $row["nomorteleponindonesia"];
		$r[$i]["nomortelepontaiwan"] = $row["nomortelepontaiwan"];
		$r[$i]["tanggaltandatangan"] = $row["tanggaltandatangan"];
		$r[$i]["pptkis"] = $row["pptkis"];
		$r[$i]["tanggalpermohonan"] = $row["tanggalpermohonan"];
		$r[$i]["nomorijincla"] = $row["nomorijincla"];
		$r[$i]["tanggalcla"] = $row["tanggalcla"];
		$r[$i]["namamajikan"] = $row["namamajikan"];
		$r[$i]["nomorktpmajikan"] = $row["nomorktpmajikan"];
		$r[$i]["nomorteleponmajikan"] = $row["nomorteleponmajikan"];
		$r[$i]["namaorangdirawat"] = $row["namaorangdirawat"];
		$r[$i]["nomorktporangdirawat"] = $row["nomorktporangdirawat"];
		$r[$i]["alamattempatbekerja"] = $row["alamattempatbekerja"];

		//[2014-03-12] Request mas randy minta kota tempat bekerja
		$kota = '';
		$arg1 = '';
		$arg2 = my_character2numeric($row["alamattempatbekerja"]);

		if ((substr_count ($arg1, 'Changhua County') > 0) || (substr_count ($arg1, utf8_decode('&#24432;&#21270;&#32291;')) > 0) || (substr_count ($arg2, 'Changhua County') > 0) || (substr_count ($arg2, utf8_decode('&#24432;&#21270;&#32291;')) > 0))  {$kota = 'Changhua County';}
		else if ((substr_count ($arg1, 'Chiayi City') > 0) || (substr_count ($arg1, utf8_decode('&#22025;&#32681;&#24066;')) > 0) || (substr_count ($arg2, 'Chiayi City') > 0) || (substr_count ($arg2, utf8_decode('&#22025;&#32681;&#24066;')) > 0))  {$kota = 'Chiayi City';}
		else if ((substr_count ($arg1, 'Chiayi County') > 0) || (substr_count ($arg1, utf8_decode('&#22025;&#32681;&#32291;')) > 0) || (substr_count ($arg2, 'Chiayi County') > 0) || (substr_count ($arg2, utf8_decode('&#22025;&#32681;&#32291;')) > 0))  {$kota = 'Chiayi County';}
		else if ((substr_count ($arg1, 'Hsinchu City') > 0) || (substr_count ($arg1, utf8_decode('&#26032;&#31481;&#24066;')) > 0) || (substr_count ($arg2, 'Hsinchu City') > 0) || (substr_count ($arg2, utf8_decode('&#26032;&#31481;&#24066;')) > 0))  {$kota = 'Hsinchu City';}
		else if ((substr_count ($arg1, 'Hsinchu County') > 0) || (substr_count ($arg1, utf8_decode('&#26032;&#31481;&#32291;')) > 0) || (substr_count ($arg2, 'Hsinchu County') > 0) || (substr_count ($arg2, utf8_decode('&#26032;&#31481;&#32291;')) > 0))  {$kota = 'Hsinchu County';}
		else if ((substr_count ($arg1, 'Hualien County') > 0) || (substr_count ($arg1, utf8_decode('&#33457;&#34030;&#32291;')) > 0) || (substr_count ($arg2, 'Hualien County') > 0) || (substr_count ($arg2, utf8_decode('&#33457;&#34030;&#32291;')) > 0))  {$kota = 'Hualien County';}
		else if ((substr_count ($arg1, 'Kaohsiung City') > 0) || (substr_count ($arg1, utf8_decode('&#39640;&#38596;&#24066;')) > 0) || (substr_count ($arg2, 'Kaohsiung City') > 0) || (substr_count ($arg2, utf8_decode('&#39640;&#38596;&#24066;')) > 0))  {$kota = 'Kaohsiung City';}
		else if ((substr_count ($arg1, 'Keelung City') > 0) || (substr_count ($arg1, utf8_decode('&#22522;&#38534;&#24066;')) > 0) || (substr_count ($arg2, 'Keelung City') > 0) || (substr_count ($arg2, utf8_decode('&#22522;&#38534;&#24066;')) > 0))  {$kota = 'Keelung City';}
		else if ((substr_count ($arg1, 'Kinmen County') > 0) || (substr_count ($arg1, utf8_decode('&#37329;&#38272;&#32291;')) > 0) || (substr_count ($arg2, 'Kinmen County') > 0) || (substr_count ($arg2, utf8_decode('&#37329;&#38272;&#32291;')) > 0))  {$kota = 'Kinmen County';}
		else if ((substr_count ($arg1, 'Lienchiang County') > 0) || (substr_count ($arg1, utf8_decode('&#36899;&#27743;&#32291;')) > 0) || (substr_count ($arg2, 'Lienchiang County') > 0) || (substr_count ($arg2, utf8_decode('&#36899;&#27743;&#32291;')) > 0))  {$kota = 'Lienchiang County';}
		else if ((substr_count ($arg1, 'Miaoli County') > 0) || (substr_count ($arg1, utf8_decode('&#33495;&#26647;&#32291;')) > 0) || (substr_count ($arg2, 'Miaoli County') > 0) || (substr_count ($arg2, utf8_decode('&#33495;&#26647;&#32291;')) > 0))  {$kota = 'Miaoli County';}
		else if ((substr_count ($arg1, 'Nantou County') > 0) || (substr_count ($arg1, utf8_decode('&#21335;&#25237;&#32291;')) > 0) || (substr_count ($arg2, 'Nantou County') > 0) || (substr_count ($arg2, utf8_decode('&#21335;&#25237;&#32291;')) > 0))  {$kota = 'Nantou County';}
		else if ((substr_count ($arg1, 'New Taipei City') > 0) || (substr_count ($arg1, utf8_decode('&#26032;&#21271;&#24066;')) > 0) || (substr_count ($arg2, 'New Taipei City') > 0) || (substr_count ($arg2, utf8_decode('&#26032;&#21271;&#24066;')) > 0))  {$kota = 'New Taipei City';}
		else if ((substr_count ($arg1, 'Penghu County') > 0) || (substr_count ($arg1, utf8_decode('&#28558;&#28246;&#32291;')) > 0) || (substr_count ($arg2, 'Penghu County') > 0) || (substr_count ($arg2, utf8_decode('&#28558;&#28246;&#32291;')) > 0))  {$kota = 'Penghu County';}
		else if ((substr_count ($arg1, 'Pingtung County') > 0) || (substr_count ($arg1, utf8_decode('&#23631;&#26481;&#32291;')) > 0) || (substr_count ($arg2, 'Pingtung County') > 0) || (substr_count ($arg2, utf8_decode('&#23631;&#26481;&#32291;')) > 0))  {$kota = 'Pingtung County';}
		else if ((substr_count ($arg1, 'Tainan City') > 0) || (substr_count ($arg1, utf8_decode('&#33274;&#21335;&#24066;')) > 0) || (substr_count ($arg2, 'Tainan City') > 0) || (substr_count ($arg2, utf8_decode('&#33274;&#21335;&#24066;')) > 0))  {$kota = 'Tainan City';}
		else if ((substr_count ($arg1, 'Tainan City') > 0) || (substr_count ($arg1, utf8_decode('&#21488;&#21335;&#24066;')) > 0) || (substr_count ($arg2, 'Tainan City') > 0) || (substr_count ($arg2, utf8_decode('&#21488;&#21335;&#24066;')) > 0))  {$kota = 'Tainan City';}
		else if ((substr_count ($arg1, 'Taichung City') > 0) || (substr_count ($arg1, utf8_decode('&#33274;&#20013;&#24066;')) > 0) || (substr_count ($arg2, 'Taichung City') > 0) || (substr_count ($arg2, utf8_decode('&#33274;&#20013;&#24066;')) > 0))  {$kota = 'Taichung City';}
		else if ((substr_count ($arg1, 'Taichung City') > 0) || (substr_count ($arg1, utf8_decode('&#21488;&#20013;&#24066;')) > 0) || (substr_count ($arg2, 'Taichung City') > 0) || (substr_count ($arg2, utf8_decode('&#21488;&#20013;&#24066;')) > 0))  {$kota = 'Taichung City';}
		else if ((substr_count ($arg1, 'Taipei City') > 0) || (substr_count ($arg1, utf8_decode('&#33274;&#21271;&#24066;')) > 0) || (substr_count ($arg2, 'Taipei City') > 0) || (substr_count ($arg2, utf8_decode('&#33274;&#21271;&#24066;')) > 0))  {$kota = 'Taipei City';}
		else if ((substr_count ($arg1, 'Taipei City') > 0) || (substr_count ($arg1, utf8_decode('&#21488;&#21271;&#24066;')) > 0) || (substr_count ($arg2, 'Taipei City') > 0) || (substr_count ($arg2, utf8_decode('&#21488;&#21271;&#24066;')) > 0))  {$kota = 'Taipei City';}
		else if ((substr_count ($arg1, 'Taitung County') > 0) || (substr_count ($arg1, utf8_decode('&#33274;&#26481;&#32291;')) > 0) || (substr_count ($arg2, 'Taitung County') > 0) || (substr_count ($arg2, utf8_decode('&#33274;&#26481;&#32291;')) > 0))  {$kota = 'Taitung County';}
		else if ((substr_count ($arg1, 'Taitung County') > 0) || (substr_count ($arg1, utf8_decode('&#21488;&#26481;&#32291;')) > 0) || (substr_count ($arg2, 'Taitung County') > 0) || (substr_count ($arg2, utf8_decode('&#21488;&#26481;&#32291;')) > 0))  {$kota = 'Taitung County';}
		else if ((substr_count ($arg1, 'Taoyuan County') > 0) || (substr_count ($arg1, utf8_decode('&#26691;&#22290;&#32291;')) > 0) || (substr_count ($arg2, 'Taoyuan County') > 0) || (substr_count ($arg2, utf8_decode('&#26691;&#22290;&#32291;')) > 0))  {$kota = 'Taoyuan County';}
		else if ((substr_count ($arg1, 'Yilan County') > 0) || (substr_count ($arg1, utf8_decode('&#23452;&#34349;&#32291;')) > 0) || (substr_count ($arg2, 'Yilan County') > 0) || (substr_count ($arg2, utf8_decode('&#23452;&#34349;&#32291;')) > 0))  {$kota = 'Yilan County';}
		else if ((substr_count ($arg1, 'Yunlin County') > 0) || (substr_count ($arg1, utf8_decode('&#38642;&#26519;&#32291;')) > 0) || (substr_count ($arg2, 'Yunlin County') > 0) || (substr_count ($arg2, utf8_decode('&#38642;&#26519;&#32291;')) > 0))  {$kota = 'Yunlin County';}
		else {$kota = 'Kapal Laut atau Tidak Terdeteksi';}

		$r[$i]["kotatempatbekerja"]  = $kota;
		$r[$i]["namamajikaneg"] = $row["namamajikaneg"];
		$r[$i]["alamattempatbekerjaeg"] = $row["alamattempatbekerjaeg"];

		foreach($r[$i] as $k => $v) {
			$r[$i][$k] = esc($v);
		}

		$i++;
	}

	return $r;
}

function getDirectHiringbyNoPaspor($nopaspor) {
	$nopaspor = str_replace(" ", "", $nopaspor);
	$nopaspor = escape($nopaspor, false);


	$link2 = mysql_connect("localhost", "endorsement", "kdei") or die($messages['err_connect_db']);
	mysql_select_db("hiring") or die($messages['err_select_db']);

	mysql_query("SET character_set_client=utf8", $link2);
	mysql_query("SET character_set_connection=utf8", $link2);
	mysql_query("SET character_set_results=utf8", $link2);

	$sql = "
		SELECT
			keterangan.idhiring,
			formulir.namatki,
			formulir.nomorpaspor,
			formulir.nomorarc,
			formulir.alamatindonesia,
			formulir.nomorteleponindonesia,
			formulir.nomortelepontaiwan,
			keterangan.tanggaltandatangan,
			formulir.pptkis,
			formulir.tanggalpermohonan,
			formulir.nomorijincla,
			formulir.tanggalcla,
			formulir.namamajikan,
			formulir.nomorktpmajikan,
			formulir.nomorteleponmajikan,
			formulir.namaorangdirawat,
			formulir.nomorktporangdirawat,
			formulir.alamattempatbekerja,
			formulir.namamajikaneg,
			formulir.alamattempatbekerjaeg
		FROM keterangan, formulir
		WHERE
			keterangan.idhiring = formulir.idhiring
			AND formulir.nomorpaspor LIKE '$nopaspor'
	";

	$result = mysql_query($sql, $link2) or die($messages['err_query']);
	$r = array();
	$i=0;
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$r["idhiring"] = $row["idhiring"];
		$r["namatki"] = $row["namatki"];
		$r["nomorpaspor"] = $row["nomorpaspor"];
		$r["nomorarc"] = $row["nomorarc"];
		$r["alamatindonesia"] = $row["alamatindonesia"];
		$r["nomorteleponindonesia"] = $row["nomorteleponindonesia"];
		$r["nomortelepontaiwan"] = $row["nomortelepontaiwan"];
		$r["tanggaltandatangan"] = $row["tanggaltandatangan"];
		$r["pptkis"] = $row["pptkis"];
		$r["tanggalpermohonan"] = $row["tanggalpermohonan"];
		$r["nomorijincla"] = $row["nomorijincla"];
		$r["tanggalcla"] = $row["tanggalcla"];
		$r["namamajikan"] = $row["namamajikan"];
		$r["nomorktpmajikan"] = $row["nomorktpmajikan"];
		$r["nomorteleponmajikan"] = $row["nomorteleponmajikan"];
		$r["namaorangdirawat"] = $row["namaorangdirawat"];
		$r["nomorktporangdirawat"] = $row["nomorktporangdirawat"];
		$r["alamattempatbekerja"] = $row["alamattempatbekerja"];

		//[2014-03-12] Request mas randy minta kota tempat bekerja
		$kota = '';
		$arg1 = '';
		$arg2 = my_character2numeric($row["alamattempatbekerja"]);

		if ((substr_count ($arg1, 'Changhua County') > 0) || (substr_count ($arg1, utf8_decode('&#24432;&#21270;&#32291;')) > 0) || (substr_count ($arg2, 'Changhua County') > 0) || (substr_count ($arg2, utf8_decode('&#24432;&#21270;&#32291;')) > 0))  {$kota = 'Changhua County';}
		else if ((substr_count ($arg1, 'Chiayi City') > 0) || (substr_count ($arg1, utf8_decode('&#22025;&#32681;&#24066;')) > 0) || (substr_count ($arg2, 'Chiayi City') > 0) || (substr_count ($arg2, utf8_decode('&#22025;&#32681;&#24066;')) > 0))  {$kota = 'Chiayi City';}
		else if ((substr_count ($arg1, 'Chiayi County') > 0) || (substr_count ($arg1, utf8_decode('&#22025;&#32681;&#32291;')) > 0) || (substr_count ($arg2, 'Chiayi County') > 0) || (substr_count ($arg2, utf8_decode('&#22025;&#32681;&#32291;')) > 0))  {$kota = 'Chiayi County';}
		else if ((substr_count ($arg1, 'Hsinchu City') > 0) || (substr_count ($arg1, utf8_decode('&#26032;&#31481;&#24066;')) > 0) || (substr_count ($arg2, 'Hsinchu City') > 0) || (substr_count ($arg2, utf8_decode('&#26032;&#31481;&#24066;')) > 0))  {$kota = 'Hsinchu City';}
		else if ((substr_count ($arg1, 'Hsinchu County') > 0) || (substr_count ($arg1, utf8_decode('&#26032;&#31481;&#32291;')) > 0) || (substr_count ($arg2, 'Hsinchu County') > 0) || (substr_count ($arg2, utf8_decode('&#26032;&#31481;&#32291;')) > 0))  {$kota = 'Hsinchu County';}
		else if ((substr_count ($arg1, 'Hualien County') > 0) || (substr_count ($arg1, utf8_decode('&#33457;&#34030;&#32291;')) > 0) || (substr_count ($arg2, 'Hualien County') > 0) || (substr_count ($arg2, utf8_decode('&#33457;&#34030;&#32291;')) > 0))  {$kota = 'Hualien County';}
		else if ((substr_count ($arg1, 'Kaohsiung City') > 0) || (substr_count ($arg1, utf8_decode('&#39640;&#38596;&#24066;')) > 0) || (substr_count ($arg2, 'Kaohsiung City') > 0) || (substr_count ($arg2, utf8_decode('&#39640;&#38596;&#24066;')) > 0))  {$kota = 'Kaohsiung City';}
		else if ((substr_count ($arg1, 'Keelung City') > 0) || (substr_count ($arg1, utf8_decode('&#22522;&#38534;&#24066;')) > 0) || (substr_count ($arg2, 'Keelung City') > 0) || (substr_count ($arg2, utf8_decode('&#22522;&#38534;&#24066;')) > 0))  {$kota = 'Keelung City';}
		else if ((substr_count ($arg1, 'Kinmen County') > 0) || (substr_count ($arg1, utf8_decode('&#37329;&#38272;&#32291;')) > 0) || (substr_count ($arg2, 'Kinmen County') > 0) || (substr_count ($arg2, utf8_decode('&#37329;&#38272;&#32291;')) > 0))  {$kota = 'Kinmen County';}
		else if ((substr_count ($arg1, 'Lienchiang County') > 0) || (substr_count ($arg1, utf8_decode('&#36899;&#27743;&#32291;')) > 0) || (substr_count ($arg2, 'Lienchiang County') > 0) || (substr_count ($arg2, utf8_decode('&#36899;&#27743;&#32291;')) > 0))  {$kota = 'Lienchiang County';}
		else if ((substr_count ($arg1, 'Miaoli County') > 0) || (substr_count ($arg1, utf8_decode('&#33495;&#26647;&#32291;')) > 0) || (substr_count ($arg2, 'Miaoli County') > 0) || (substr_count ($arg2, utf8_decode('&#33495;&#26647;&#32291;')) > 0))  {$kota = 'Miaoli County';}
		else if ((substr_count ($arg1, 'Nantou County') > 0) || (substr_count ($arg1, utf8_decode('&#21335;&#25237;&#32291;')) > 0) || (substr_count ($arg2, 'Nantou County') > 0) || (substr_count ($arg2, utf8_decode('&#21335;&#25237;&#32291;')) > 0))  {$kota = 'Nantou County';}
		else if ((substr_count ($arg1, 'New Taipei City') > 0) || (substr_count ($arg1, utf8_decode('&#26032;&#21271;&#24066;')) > 0) || (substr_count ($arg2, 'New Taipei City') > 0) || (substr_count ($arg2, utf8_decode('&#26032;&#21271;&#24066;')) > 0))  {$kota = 'New Taipei City';}
		else if ((substr_count ($arg1, 'Penghu County') > 0) || (substr_count ($arg1, utf8_decode('&#28558;&#28246;&#32291;')) > 0) || (substr_count ($arg2, 'Penghu County') > 0) || (substr_count ($arg2, utf8_decode('&#28558;&#28246;&#32291;')) > 0))  {$kota = 'Penghu County';}
		else if ((substr_count ($arg1, 'Pingtung County') > 0) || (substr_count ($arg1, utf8_decode('&#23631;&#26481;&#32291;')) > 0) || (substr_count ($arg2, 'Pingtung County') > 0) || (substr_count ($arg2, utf8_decode('&#23631;&#26481;&#32291;')) > 0))  {$kota = 'Pingtung County';}
		else if ((substr_count ($arg1, 'Tainan City') > 0) || (substr_count ($arg1, utf8_decode('&#33274;&#21335;&#24066;')) > 0) || (substr_count ($arg2, 'Tainan City') > 0) || (substr_count ($arg2, utf8_decode('&#33274;&#21335;&#24066;')) > 0))  {$kota = 'Tainan City';}
		else if ((substr_count ($arg1, 'Tainan City') > 0) || (substr_count ($arg1, utf8_decode('&#21488;&#21335;&#24066;')) > 0) || (substr_count ($arg2, 'Tainan City') > 0) || (substr_count ($arg2, utf8_decode('&#21488;&#21335;&#24066;')) > 0))  {$kota = 'Tainan City';}
		else if ((substr_count ($arg1, 'Taichung City') > 0) || (substr_count ($arg1, utf8_decode('&#33274;&#20013;&#24066;')) > 0) || (substr_count ($arg2, 'Taichung City') > 0) || (substr_count ($arg2, utf8_decode('&#33274;&#20013;&#24066;')) > 0))  {$kota = 'Taichung City';}
		else if ((substr_count ($arg1, 'Taichung City') > 0) || (substr_count ($arg1, utf8_decode('&#21488;&#20013;&#24066;')) > 0) || (substr_count ($arg2, 'Taichung City') > 0) || (substr_count ($arg2, utf8_decode('&#21488;&#20013;&#24066;')) > 0))  {$kota = 'Taichung City';}
		else if ((substr_count ($arg1, 'Taipei City') > 0) || (substr_count ($arg1, utf8_decode('&#33274;&#21271;&#24066;')) > 0) || (substr_count ($arg2, 'Taipei City') > 0) || (substr_count ($arg2, utf8_decode('&#33274;&#21271;&#24066;')) > 0))  {$kota = 'Taipei City';}
		else if ((substr_count ($arg1, 'Taipei City') > 0) || (substr_count ($arg1, utf8_decode('&#21488;&#21271;&#24066;')) > 0) || (substr_count ($arg2, 'Taipei City') > 0) || (substr_count ($arg2, utf8_decode('&#21488;&#21271;&#24066;')) > 0))  {$kota = 'Taipei City';}
		else if ((substr_count ($arg1, 'Taitung County') > 0) || (substr_count ($arg1, utf8_decode('&#33274;&#26481;&#32291;')) > 0) || (substr_count ($arg2, 'Taitung County') > 0) || (substr_count ($arg2, utf8_decode('&#33274;&#26481;&#32291;')) > 0))  {$kota = 'Taitung County';}
		else if ((substr_count ($arg1, 'Taitung County') > 0) || (substr_count ($arg1, utf8_decode('&#21488;&#26481;&#32291;')) > 0) || (substr_count ($arg2, 'Taitung County') > 0) || (substr_count ($arg2, utf8_decode('&#21488;&#26481;&#32291;')) > 0))  {$kota = 'Taitung County';}
		else if ((substr_count ($arg1, 'Taoyuan County') > 0) || (substr_count ($arg1, utf8_decode('&#26691;&#22290;&#32291;')) > 0) || (substr_count ($arg2, 'Taoyuan County') > 0) || (substr_count ($arg2, utf8_decode('&#26691;&#22290;&#32291;')) > 0))  {$kota = 'Taoyuan County';}
		else if ((substr_count ($arg1, 'Yilan County') > 0) || (substr_count ($arg1, utf8_decode('&#23452;&#34349;&#32291;')) > 0) || (substr_count ($arg2, 'Yilan County') > 0) || (substr_count ($arg2, utf8_decode('&#23452;&#34349;&#32291;')) > 0))  {$kota = 'Yilan County';}
		else if ((substr_count ($arg1, 'Yunlin County') > 0) || (substr_count ($arg1, utf8_decode('&#38642;&#26519;&#32291;')) > 0) || (substr_count ($arg2, 'Yunlin County') > 0) || (substr_count ($arg2, utf8_decode('&#38642;&#26519;&#32291;')) > 0))  {$kota = 'Yunlin County';}
		else {$kota = 'Kapal Laut atau Tidak Terdeteksi';}

		$r["kotatempatbekerja"]  = $kota;
		$r["namamajikaneg"] = $row["namamajikaneg"];
		$r["alamattempatbekerjaeg"] = $row["alamattempatbekerjaeg"];

		foreach($r as $k => $v) {
			$r[$k] = esc($v);
		}
	}
	return $r;
}


function getPKByDate($date) {
	ini_set('max_execution_time', 600);

	$date = escape($date, false);

	$sql = "
		SELECT
			ejid,
			jpid,
			agnama,
			agnamacn,
			agnoijincla,
			agalmtkantor,
			agalmtkantorcn,
			agpngjwb,
			agpngjwbcn,
			agtelp,
			agfax,
			mjktp,
			mjnama,
			mjnamacn,
			mjalmt,
			mjalmtcn,
			mjtelp,
			mjfax,
			mjpngjwb,
			mjpngjwbcn,
			ppnama,
			ppalmtkantor,
			pptelp,
			ppfax,
			ppijin,
			pppngjwb,
			joclano,
			joclatgl,
			joestduedate,
			jojmltki,
			jomkthn,
			jomkbln,
			jomkhr,
			jocatatan,
			joposisi,
			joposisicn,
			joakomodasi,
			ejtglendorsement,
			ejdatefilled,
			jpgaji,
			jpakomodasi
		FROM entryjo
		WHERE
			ejtglendorsement = DATE_FORMAT('$date', '%Y-%m-%d')
	";
	$result = mysql_query($sql) or die($messages['err_query']);
	$r2 = array();
	$j=0;
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$r = array();

		$r["ejid"] = $row["ejid"];
		$r["jpid"] = $row["jpid"];
		$r["agnama"] = $row["agnama"];
		$r["agnamacn"] = $row["agnamacn"];
		$r["agnoijincla"] = $row["agnoijincla"];
		$r["agalmtkantor"] = $row["agalmtkantor"];
		$r["agalmtkantorcn"] = $row["agalmtkantorcn"];
		$r["agpngjwb"] = $row["agpngjwb"];
		$r["agpngjwbcn"] = $row["agpngjwbcn"];
		$r["agtelp"] = $row["agtelp"];
		$r["agfax"] = $row["agfax"];
		$r["mjktp"] = $row["mjktp"];
		$r["mjnama"] = $row["mjnama"];
		$r["mjnamacn"] = $row["mjnamacn"];
		$r["mjalmt"] = $row["mjalmt"];
		$r["mjalmtcn"] = $row["mjalmtcn"];
		$r["mjtelp"] = $row["mjtelp"];
		$r["mjfax"] = $row["mjfax"];
		$r["mjpngjwb"] = $row["mjpngjwb"];
		$r["mjpngjwbcn"] = $row["mjpngjwbcn"];
		$r["ppnama"] = $row["ppnama"];
		$r["ppalmtkantor"] = $row["ppalmtkantor"];
		$r["pptelp"] = $row["pptelp"];
		$r["ppfax"] = $row["ppfax"];
		$r["ppijin"] = $row["ppijin"];
		$r["pppngjwb"] = $row["pppngjwb"];
		$r["joclano"] = $row["joclano"];
		$r["joclatgl"] = $row["joclatgl"];
		$r["joestduedate"] = $row["joestduedate"];
		$r["jojmltki"] = $row["jojmltki"];
		$r["jomkthn"] = $row["jomkthn"];
		$r["jomkbln"] = $row["jomkbln"];
		$r["jomkhr"] = $row["jomkhr"];
		$r["jocatatan"] = $row["jocatatan"];
		$r["joposisi"] = $row["joposisi"];
		$r["joposisicn"] = $row["joposisicn"];
		$r["joakomodasi"] = $row["joakomodasi"];
		$r["ejtglendorsement"] = $row["ejtglendorsement"];
		$r["ejdatefilled"] = $row["ejdatefilled"];
		$r["jpgaji"] = $row["jpgaji"];
		$r["jpakomodas"] = $row["jpakomodas"];

		foreach($r as $k => $v) {
			$r[$k] = esc($v);
		}

		$sql2 = "
			SELECT
				tkid,
				tknama,
				tknamacn,
				tkalmtid,
				tkpaspor,
				tktglkeluar,
				tktmptkeluar,
				tktgllahir,
				tktmptlahir,
				tkjk,
				tkstatkwn,
				tkjmlanaktanggungan,
				tkahliwaris,
				tknama2,
				tknamacn2,
				tkalmt2,
				tkalmtcn2,
				tktelp,
				tkhub,
				tkstat,
				tkrevid,
				tktglubah,
				tktglendorsement,
				tktglendorsement2,
				tkiid
			FROM tki
			WHERE
				ejid = " . $r["ejid"] . "
		";
		$result2 = mysql_query($sql2) or die($messages['err_query']);
		$i=0;
		while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
			$r["tki"][$i]["tkid"] = $row2["tkid"];
			$r["tki"][$i]["tknama"] = $row2["tknama"];
			$r["tki"][$i]["tknamacn"] = $row2["tknamacn"];
			$r["tki"][$i]["tkalmtid"] = $row2["tkalmtid"];
			$r["tki"][$i]["tkpaspor"] = $row2["tkpaspor"];
			$r["tki"][$i]["tktglkeluar"] = $row2["tktglkeluar"];
			$r["tki"][$i]["tktmptkeluar"] = $row2["tktmptkeluar"];
			$r["tki"][$i]["tktgllahir"] = $row2["tktgllahir"];
			$r["tki"][$i]["tktmptlahir"] = $row2["tktmptlahir"];
			$r["tki"][$i]["tkjk"] = $row2["tkjk"];
			$r["tki"][$i]["tkstatkwn"] = $row2["tkstatkwn"];
			$r["tki"][$i]["tkjmlanaktanggungan"] = $row2["tkjmlanaktanggungan"];
			$r["tki"][$i]["tkahliwaris"] = $row2["tkahliwaris"];
			$r["tki"][$i]["tknama2"] = $row2["tknama2"];
			$r["tki"][$i]["tknamacn2"] = $row2["tknamacn2"];
			$r["tki"][$i]["tkalmt2"] = $row2["tkalmt2"];
			$r["tki"][$i]["tkalmtcn2"] = $row2["tkalmtcn2"];
			$r["tki"][$i]["tktelp"] = $row2["tktelp"];
			$r["tki"][$i]["tkhub"] = $row2["tkhub"];
			$r["tki"][$i]["tkstat"] = $row2["tkstat"];
			$r["tki"][$i]["tkrevid"] = $row2["tkrevid"];
			$r["tki"][$i]["tktglubah"] = $row2["tktglubah"];
			$r["tki"][$i]["tktglendorsement"] = $row2["tktglendorsement"];
			$r["tki"][$i]["tktglendorsement2"] = $row2["tktglendorsement2"];
			$r["tki"][$i]["tkiid"] = $row2["tkiid"];

			foreach($r["tki"][$i] as $k => $v) {
				$r["tki"][$i][$k] = esc($v);
			}

			$i++;
		}

		$r2[$j++] = $r;
	}

	return $r2;
}

function getBlacklistAgenByDate($date) {
	$sql = "
		SELECT
			agid
		FROM magensi
		WHERE
			agcekal = 1
			AND DATE_FORMAT('$date', '%Y-%m-%d') BETWEEN agcekalawal and agcekalakhir
	";
	$result = mysql_query($sql) or die($messages['err_query']);

	$r = array();
	$i = 0;
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$r[$i++] = $row["agid"];
	}

	return $r;
}

function pushKeberangkatan($departArray){
	$sql = "insert into keberangkatan (tkiid, tkpaspor, bandaracode, transitport, timestamp) VALUES
	        ('".$departArray['tkiid']."', '".$departArray['tkpaspor']."', '".$departArray['departurebandaracode']."', '".$departArray['transitport']."', '".$departArray['timestamp']."')";
	$result = mysql_query($sql) or die($messages['err_query']);
	$newid = mysql_insert_id();
	$r[] = array('keberangkatanid' => $newid, 'tkiid' => $departArray['tkiid'], 'tkpaspor' => $departArray['tkpaspor'], 'departurebandaracode' => $departArray['departurebandaracode'],
	               'transitport' => $departArray['transitport'], 'timestamp' => $departArray['timestamp'] );
	return $r;
}

function pushKepulangan($arriveArray){
	$sql = "insert into kepulangan (tkiid, tkpaspor, bandaracode, transitport, timestamp) VALUES
	        ('".$arriveArray['tkiid']."', '".$arriveArray['tkpaspor']."', '".$arriveArray['arrivalbandaracode']."', '".$arriveArray['transitport']."', '".$arriveArray['timestamp']."')";
	$result = mysql_query($sql) or die($messages['err_query']);
	$newid = mysql_insert_id();
	$r[] = array('kepulanganid' => $newid, 'tkiid' => $arriveArray['tkiid'], 'tkpaspor' => $arriveArray['tkpaspor'], 'arrivalbandaracode' => $arriveArray['arrivalbandaracode'],
	               'transitport' => $arriveArray['transitport'], 'timestamp' => $arriveArray['timestamp'] );
	return $r;
}

function pushPerlintasan($perlintasanArray){
	$sql = "insert into perlintasan (bandaracode, bandaraname, bandaranegaraname, bandaranegaracode, bandaraicao) VALUES
	        ('".$perlintasanArray['bandaracode']."', '".$perlintasanArray['bandaraname']."', '".$perlintasanArray['bandaranegaraname']."', '".$perlintasanArray['bandaranegaracode']."', '".$perlintasanArray['bandaraicao']."')";
	$result = mysql_query($sql) or die($messages['err_query']);
	$r[] = array('bandaracode' => $perlintasanArray['bandaracode'], 'bandaraname' => $perlintasanArray['bandaraname'], 'bandaranegaraname' => $perlintasanArray['bandaranegaraname'],
	             'bandaranegaracode' => $perlintasanArray['bandaranegaracode'], 'bandaraicao' => $perlintasanArray['bandaraicao']);
	return $r;
}


$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";
$server->service($HTTP_RAW_POST_DATA);

?>
