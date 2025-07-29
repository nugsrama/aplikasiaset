
<?php


defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//Login, regis , logout
$route['login'] = 'welcome/login';
$route['registrasi'] = 'welcome/registrasi';
$route['login'] = 'welcome/hallogin';
$route['logout'] = 'welcome/logout';


//Master asset
$route['home'] = 'home/halhome';
$route['editmaster'] = 'home/halaman_edit';
$route['tambahasset'] = 'home/tambahasset';
$route['editmaster'] = 'home/editmaster';


//Asset masuk
$route['assetmasuk'] = 'assetmasuk/asetmasuk';
$route['detailassetmasuk'] = 'assetmasuk/detailassetmasuk';
$route['editdetailmasuk'] = 'assetmasuk/ editMasukDetail';
$route['editmasuk'] = 'assetmasuk/editMasuk';
$route['tambahassetmasuk'] = 'assetmasuk/tambahassetmasuk';
$route['tambahdetailmasuk'] = 'assetmasuk/tambahdetailassetmasuk';


//Asset keluar
$route['assetkeluar'] = 'assetkeluar/asetkeluar';
$route['detailassetkeluar'] = 'assetkeluar/detailassetkeluar';
$route['editkeluar'] = 'assetkeluar/editKeluar';
$route['tambahassetkeluar'] = 'assetkeluar/tambahassetkeluar';
$route['tambahdetailkeluar'] = 'assetkeluar/tambahdetailassetkeluar';


//Asset adjustment
$route['assetadjustment'] = 'adjustment/assetadjustment';
$route['detailadjustment'] = 'adjustment/detailassetadjustment';
$route['editadjustment'] = 'adjustment/editAdjustment';
$route['tambahassetadjustment'] = 'adjustment/tambahassetadjustment';
$route['tambahdetailadjustment'] = 'adjustment/tambahdetailassetadjustment';


//Asset writeoff
$route['assetwriteoff'] = 'writeoff/assetwriteoff';
$route['detailwriteoff'] = 'writeoff/detailassetwriteoff';
$route['editwriteoff'] = 'writeoff/editWriteoff';
$route['tambahassetwriteoff'] = 'writeoff/tambahassetwriteoff';
$route['tambahdetailwriteoff'] = 'writeoff/tambahdetailassetwriteoff';

//Cekstock
$route['cekstock'] = 'cekstock/cekstock';

//Closingbulanan
$route['closingbulanan'] = 'Closingbulanan/closing';



$route['welcome/delete/(:num)']['delete'] = "welcome/delete/$1";
