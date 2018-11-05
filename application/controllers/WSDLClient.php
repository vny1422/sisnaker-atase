
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WSDLClient extends CI_Controller {
  protected $server;

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    /*****************************************************************************
    *** KONFIGURASI SOAP
    ******************************************************************************/
    $this->server = new soap_server();
    $this->server->soap_defencoding = "utf-8";
    $this->server->configureWSDL("Services", "urn:Services_wsdl");

    /*****************************************************************************
    *** STRUCTURE
    ******************************************************************************/

    // struct DetailJO
    $this->server->wsdl->addComplexType(
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

    $this->server->wsdl->addComplexType(
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
    $this->server->wsdl->addComplexType(
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


    $this->server->wsdl->addComplexType(
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


    $this->server->wsdl->addComplexType(
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


    $this->server->wsdl->addComplexType(
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

    $this->server->wsdl->addComplexType(
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


    $this->server->wsdl->addComplexType(
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


    $this->server->wsdl->addComplexType(
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
    $this->server->wsdl->addComplexType(
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

    $this->server->wsdl->addComplexType(
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
    $this->server->wsdl->addComplexType(
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

    $this->server->wsdl->addComplexType(
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

    $this->server->wsdl->addComplexType(
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

    $this->server->wsdl->addComplexType(
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

    $this->server->wsdl->addComplexType(
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

    $this->server->wsdl->addComplexType(
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

    $this->server->wsdl->addComplexType(
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

    $this->server->wsdl->addComplexType(
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

    $this->server->wsdl->addComplexType(
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

    $this->server->wsdl->addComplexType(
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

    $this->server->wsdl->addComplexType(
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


    $this->server->wsdl->addComplexType(
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
    $this->server->register(
    	"ServicesWSDL.getJO",
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
  }

  function my_character2numeric($t)
  {
    $convmap = array(0x0, 0x2FFFF, 0, 0xFFFF);
    return mb_encode_numericentity($t, $convmap, 'UTF-8');
  }

  function esc($value) {
    return $value != null ? preg_replace('/\p{Cc}+/u', '', $value) : null;
  }

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

  function coba()
  {

    /*****************************************************************************
    *** CARA PENGGUNAAN
    ******************************************************************************/

    // Pastikan kelas SoapClient dapat diakses atau lihat http://php.net/manual/en/class.soapclient.php

    $soapClient = new SoapClient("http://localhost/sisnaker-atase/services/index.php?wsdl");

    /*
    11. getPKByDate    Input : date(yyyy-mm-dd)    Output : data PK
    */
    try {
      $result = $soapClient->__soapCall("getJO", array('ppkode' => "ALM282", 'agid' => "2557"));
      print_r($result);
    } catch (SoapFault $fault) {
      var_dump($soapClient->__soapCall("getJO", array('ppkode' => "ALM282", 'agid' => "2557")));
    }


  }

}
?>
