<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('mobil', 'Mobil::index');
$routes->get('mobil/tambah_mobil', 'Mobil::tambah_mobil');
$routes->post('mobil/simpan_mobil', 'Mobil::aksi_tambah_mobil');
$routes->post('mobil/update/(:num)', 'Mobil::aksi_edit_mobil/$1');
$routes->get('mobil/edit_mobil/(:num)', 'Mobil::edit_mobil/$1');
$routes->get('mobil/dihapus_mobil', 'Mobil::dihapus_mobil');
$routes->get('mobil/delete_mobil/(:num)', 'Mobil::delete_mobil/$1');
$routes->get('mobil/restore_mobil/(:num)', 'Mobil::restore_mobil/$1');
$routes->get('mobil/hapus_mobil/(:num)', 'Mobil::hapus_mobil/$1');
$routes->get('mobil/detail_mobil/(:num)', 'Mobil::detail_mobil/$1');

$routes->get('mobil/jual/(:num)', 'Mobil::jual/$1');
$routes->post('mobil/simpan_jual', 'Mobil::simpan_jual');
$routes->get('mobil/input_profit_credit/(:num)', 'Mobil::inputProfitCredit/$1');
$routes->post('mobil/simpan_profit_credit/(:num)', 'Mobil::simpanProfitCredit/$1');


$routes->get('sold', 'sold::index');
$routes->get('sold/tambah_sold', 'sold::tambah_sold');
$routes->post('sold/simpan_sold', 'sold::aksi_tambah_sold');
$routes->post('sold/update/(:num)', 'sold::update_sold/$1');
$routes->get('sold/edit_sold/(:num)', 'sold::edit_sold/$1');
$routes->get('sold/dihapus_sold', 'sold::dihapus_sold');
$routes->get('sold/delete_sold/(:num)', 'sold::delete_sold/$1');
$routes->get('sold/restore_sold/(:num)', 'sold::restore_sold/$1');
$routes->get('sold/hapus_sold/(:num)', 'sold::hapus_sold/$1');
$routes->get('sold/detail_sold/(:num)', 'sold::detail_sold/$1');
$routes->get('sold/printImage/(:num)', 'Sold::printImage/$1');



$routes->get('laba', 'laba::index');
$routes->get('laba/tambah_laba', 'laba::tambah_laba');
$routes->post('laba/simpan_laba', 'laba::aksi_tambah_laba');
$routes->post('laba/update/(:num)', 'laba::update_laba/$1');
$routes->get('laba/edit_laba/(:num)', 'laba::edit_laba/$1');
$routes->get('laba/dihapus_laba', 'laba::dihapus_laba');
$routes->get('laba/delete_laba/(:num)', 'laba::delete_laba/$1');
$routes->get('laba/restore_laba/(:num)', 'laba::restore_laba/$1');
$routes->get('laba/hapus_laba/(:num)', 'laba::hapus_laba/$1');
$routes->get('laba/detail_laba/(:num)', 'laba::detail_laba/$1');
$routes->get('laba/detail/(:num)/(:num)', 'Laba::detail/$1/$2');
$routes->post('laba/simpan_keuangan', 'Laba::simpan_keuangan');

$routes->get('beli', 'beli::index');
$routes->get('beli/tambah_beli', 'beli::tambah_beli');
$routes->post('beli/simpan_beli', 'beli::aksi_tambah_beli');
$routes->post('beli/update/(:num)', 'beli::update_beli/$1');
$routes->get('beli/edit_beli/(:num)', 'beli::edit_beli/$1');
$routes->get('beli/hapus_beli/(:num)', 'beli::hapus_beli/$1');
$routes->get('beli/kredit', 'beli::kredit');
$routes->get('beli/hapus_kredit/(:num)', 'beli::hapus_kredit/$1');

$routes->get('tukar', 'tukar::index');
$routes->get('tukar/tambah', 'tukar::tambah');
$routes->post('tukar/simpan', 'tukar::aksi_tambah_tukar');
$routes->post('tukar/update/(:num)', 'tukar::update/$1');
$routes->get('tukar/edit_tukar/(:num)', 'tukar::edit/$1');
$routes->get('tukar/hapus_tukar/(:num)', 'tukar::hapus_tukar/$1');

$routes->get('penjualan', 'Penjualan::index');
$routes->get('penjualan/tambah_penjualan', 'Penjualan::tambah_penjualan');
$routes->post('penjualan/simpan_penjualan', 'Penjualan::aksi_tambah_penjualan');
$routes->post('penjualan/update/(:num)', 'Penjualan::update_penjualan/$1');
$routes->get('penjualan/edit_penjualan/(:num)', 'penjualan::edit_penjualan/$1');
$routes->get('penjualan/dihapus_penjualan', 'penjualan::dihapus_penjualan');
$routes->get('penjualan/delete_penjualan/(:num)', 'penjualan::delete_penjualan/$1');
$routes->get('penjualan/restore_penjualan/(:num)', 'penjualan::restore_penjualan/$1');
$routes->get('penjualan/hapus_penjualan/(:num)', 'penjualan::hapus_penjualan/$1');
$routes->get('penjualan/detail_penjualan/(:num)', 'penjualan::detail_penjualan/$1');
 
$routes->get('pelanggan', 'Pelanggan::index');
$routes->get('pelanggan/tambah_pelanggan', 'Pelanggan::tambah_pelanggan');
$routes->post('pelanggan/simpan_pelanggan', 'Pelanggan::aksi_tambah_pelanggan');
$routes->post('pelanggan/update/(:num)', 'pelanggan::update_pelanggan/$1');
$routes->get('pelanggan/edit_pelanggan/(:num)', 'pelanggan::edit_pelanggan/$1');
$routes->get('pelanggan/dihapus_pelanggan', 'pelanggan::dihapus_pelanggan');
$routes->get('pelanggan/delete_pelanggan/(:num)', 'pelanggan::delete_pelanggan/$1');
$routes->get('pelanggan/restore_pelanggan/(:num)', 'pelanggan::restore_pelanggan/$1');
$routes->get('pelanggan/hapus_pelanggan/(:num)', 'pelanggan::hapus_pelanggan/$1');
$routes->get('pelanggan/detail_pelanggan/(:num)', 'pelanggan::detail_pelanggan/$1');

$routes->get('/', 'Home::index');
$routes->get('/newsletter', 'Home::newsletter');
$routes->get('/contact', 'Home::contact');
$routes->get('Admin', 'Admin::index');
$routes->get('Katalog', 'Katalog::index'); 
$routes->get('/login', 'Login::index');
$routes->post('login/aksi_login', 'Login::aksi_login');
$routes->get('login/logout', 'Login::logout');