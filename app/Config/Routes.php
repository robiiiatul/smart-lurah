<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->get('login/index', 'Login::index');
$routes->post('login/aksi_login', 'Login::aksi_login');
$routes->get('login/logout', 'Login::logout');
$routes->get('admin', 'Admin::index');
$routes->get('admin/index', 'Admin::index');
$routes->get('admin/user', 'Admin::user');
$routes->get('admin/formUser', 'Admin::formUser', ['as' => 'admin.formUser']);
$routes->get('admin/openUser/(:num)', 'Admin::openUser/$1', ['as' => 'admin.openUser']);
$routes->get('admin/formEditUser/(:num)', 'Admin::formEditUser/$1', ['as' => 'admin.formEditUser']);
$routes->post('admin/editUser/(:num)', 'Admin::editUser/$1', ['as' => 'admin.editUser']);
$routes->post('admin/addUser', 'Admin::addUser');
$routes->get('admin/deleteUser', 'Admin::deleteUser', ['as' => 'admin.deleteUser']);

$routes->get('rw', 'Rw::index');
$routes->get('rw/index', 'Rw::index');
$routes->get('rw/profile', 'Rw::profile');

$routes->get('rt', 'Rt::index');
$routes->get('rt/index', 'Rt::index');
$routes->get('rt/profile', 'Rt::profile');
$routes->get('rt/program', 'Rt::program');
$routes->get('rt/formProgram', 'Rt::formProgram', ['as' => 'rt.formProgram']);
$routes->post('rt/addProgram', 'Rt::addProgram');
