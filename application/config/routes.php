<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['assets/(:any)'] = 'assets/$1';
$route['(?i)sadmin'] = 'SAdmin/Sadmin';
$route['(?i)sadmin/(:any)'] = 'SAdmin/Sadmin/$1';
$route['(?i)institution'] = 'SAdmin/Institution';
$route['(?i)kantor'] = 'SAdmin/Kantor';
$route['(?i)jobtype'] = 'SAdmin/Jobtype';
$route['(?i)inputtype'] = 'SAdmin/Inputtype';
$route['(?i)infografik'] = 'Perlindungan/Infografik';
$route['(?i)privilege'] = 'SAdmin/Privilege';
$route['(?i)shelter'] = 'Perlindungan/Shelter';
$route['(?i)level'] = 'SAdmin/Level';
$route['(?i)currency'] = 'SAdmin/Currency';
$route['(?i)user'] = 'SAdmin/User';
$route['(?i)perlindungan'] = 'Perlindungan/Perlindungan';
$route['(?i)pusat'] = 'Pusat/Pusat';
$route['(?i)kasus'] = 'Perlindungan/Kasus';
$route['(?i)datatki'] = 'Perlindungan/DataTKI';
$route['(?i)agensipptkis'] = 'Perlindungan/AgensiPPTKIS';
$route['(?i)Rekap'] = 'Perlindungan/Rekap';
$route['(?i)Log'] = 'Perlindungan/Log';
$route['(?i)pemulangantki'] = 'Perlindungan/PemulanganTKI';
$route['(?i)classification'] = 'SAdmin/Classification';
$route['(?i)media'] = 'SAdmin/Media';
$route['(?i)wilayah'] = 'SAdmin/Wilayah';
$route['(?i)paket'] = 'Endorsement/Paket';
$route['(?i)cekal'] = 'Endorsement/Cekal';
$route['(?i)rekapendorsement'] = 'Endorsement/RekapEndorsement';
$route['(?i)kuitansi'] = 'Endorsement/Kuitansi';
$route['(?i)pk'] = 'Endorsement/Pk';
$route['(?i)endorsement'] = 'Endorsement/Endorsement';
$route['(?i)institution/(:any)'] = 'SAdmin/Institution/$1';
$route['(?i)pusat/(:any)'] = 'Pusat/Pusat/$1';
$route['(?i)kantor/(:any)'] = 'SAdmin/Kantor/$1';
$route['(?i)category/(:any)'] = 'SAdmin/Category/$1';
$route['(?i)privilege/(:any)'] = 'SAdmin/Privilege/$1';
$route['(?i)level/(:any)'] = 'SAdmin/Level/$1';
$route['(?i)input/(:any)'] = 'SAdmin/Input/$1';
$route['(?i)infografik/(:any)'] = 'Perlindungan/Infografik/$1';
$route['(?i)classification/(:any)'] = 'SAdmin/Classification/$1';
$route['(?i)media/(:any)'] = 'SAdmin/Media/$1';
$route['(?i)currency/(:any)'] = 'SAdmin/Currency/$1';
$route['(?i)wilayah/(:any)'] = 'SAdmin/Wilayah/$1';
$route['(?i)jobtype/(:any)'] = 'SAdmin/Jobtype/$1';
$route['(?i)user/(:any)'] = 'SAdmin/User/$1';
$route['(?i)inputtype/(:any)'] = 'SAdmin/Inputtype/$1';
$route['(?i)kasus/(:any)'] = 'Perlindungan/Kasus/$1';
$route['(?i)datatki/(:any)'] = 'Perlindungan/DataTKI/$1';
$route['(?i)datatki/(:any)/(:any)'] = 'Perlindungan/DataTKI/$1/$2';
$route['(?i)agensipptkis/(:any)'] = 'Perlindungan/AgensiPPTKIS/$1';
$route['(?i)rekap/(:any)'] = 'Perlindungan/Rekap/$1';
$route['(?i)shelter/(:any)'] = 'Perlindungan/Shelter/$1';
$route['(?i)perlindungan/(:any)'] = 'Perlindungan/Perlindungan/$1';
$route['(?i)pemulangantki/(:any)'] = 'Perlindungan/PemulanganTKI/$1';
$route['(?i)paket/(:any)'] = 'Endorsement/Paket/$1';
$route['(?i)cekal/(:any)'] = 'Endorsement/Cekal/$1';
$route['(?i)rekapendorsement/(:any)'] = 'Endorsement/RekapEndorsement/$1';
$route['(?i)kuitansi/(:any)'] = 'Endorsement/Kuitansi/$1';
$route['(?i)pk/(:any)'] = 'Endorsement/Pk/$1';
$route['(?i)endorsement/(:any)'] = 'Endorsement/Endorsement/$1';
$route['(?i)institution/(:any)/(:any)'] = 'SAdmin/Institution/$1/$2';
$route['(?i)pusat/(:any)/(:any)'] = 'Pusat/Pusat/$1/$2';
$route['(?i)kantor/(:any)/(:any)'] = 'SAdmin/Kantor/$1/$2';
$route['(?i)jobtype/(:any)/(:any)'] = 'SAdmin/Jobtype/$1/$2';
$route['(?i)currency/(:any)/(:any)'] = 'SAdmin/Currency/$1/$2';
$route['(?i)privilege/(:any)/(:any)'] = 'SAdmin/Privilege/$1/$2';
$route['(?i)inputtype/(:any)/(:any)'] = 'SAdmin/Inputtype/$1/$2';
$route['(?i)classification/(:any)/(:any)'] = 'SAdmin/Classification/$1/$2';
$route['(?i)media/(:any)/(:any)'] = 'SAdmin/Media/$1/$2';
$route['(?i)infografik/(:any)/(:any)'] = 'Perlindungan/Infografik/$1/$2';
$route['(?i)wilayah/(:any)/(:any)'] = 'SAdmin/Wilayah/$1/$2';
$route['(?i)level/(:any)/(:any)'] = 'SAdmin/Level/$1/$2';
$route['(?i)user/(:any)/(:any)'] = 'SAdmin/User/$1/$2';
$route['(?i)shelter/(:any)/(:any)'] = 'Perlindungan/Shelter/$1/$2';
$route['(?i)perlindungan/(:any)/(:any)'] = 'Perlindungan/Perlindungan/$1/$2';
$route['(?i)agensipptkis/(:any)/(:any)'] = 'Perlindungan/AgensiPPTKIS/$1/$2';
$route['(?i)pemulangantki/(:any)/(:any)'] = 'Perlindungan/PemulanganTKI/$1/$2';
$route['(?i)cekal/(:any)/(:any)'] = 'Endorsement/Cekal/$1/$2';
$route['(?i)rekapendorsement/(:any)/(:any)'] = 'Endorsement/RekapEndorsement/$1/$2';
$route['(?i)endorsement/(:any)/(:any)'] = 'Endorsement/Endorsement/$1/$2';
$route['(?i)pk/(:any)/(:any)'] = 'Endorsement/Pk/$1/$2';
$route['(?i)kuitansi/(:any)/(:any)'] = 'Endorsement/Kuitansi/$1/$2';
$route['(?i)agensi'] = 'Endorsement/Agensi';


$route['(?i)agensi/(:any)'] = 'Endorsement/Agensi/$1';
