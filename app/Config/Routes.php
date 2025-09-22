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
$routes->get('admin/request', 'Admin::request');
$routes->get('admin/requestDetail/(:num)', 'Admin::requestDetail/$1', ['as' => 'admin.requestDetail']);
$routes->get('admin/formRequestDetail/(:num)', 'Admin::formRequestDetail/$1', ['as' => 'admin.formRequestDetail']);
$routes->post('admin/addRequestDetail/(:num)', 'Admin::addRequestDetail/$1', ['as' => 'admin.addRequestDetail']);
$routes->get('admin/deleteRequestDetail', 'Admin::deleteRequestDetail', ['as' => 'admin.deleteRequestDetail']);

$routes->get('supervisor', 'Supervisor::index');
$routes->get('supervisor/index', 'Supervisor::index');
$routes->get('supervisor/request', 'Supervisor::request');
$routes->get('supervisor/formRequest', 'Supervisor::formRequest');
$routes->post('supervisor/addRequest', 'Supervisor::addRequest');
$routes->get('supervisor/deleteRequest', 'Supervisor::deleteRequest', ['as' => 'supervisor.deleteRequest']);
$routes->get('supervisor/requestDetail/(:num)', 'Supervisor::requestDetail/$1', ['as' => 'supervisor.requestDetail']);
$routes->get('supervisor/formRequestDetail/(:num)', 'Supervisor::formRequestDetail/$1', ['as' => 'supervisor.formRequestDetail']);
$routes->post('supervisor/addRequestDetail/(:num)', 'Supervisor::addRequestDetail/$1', ['as' => 'supervisor.addRequestDetail']);
$routes->get('supervisor/approveRequest', 'Supervisor::approveRequest', ['as' => 'supervisor.approveRequest']);
$routes->get('supervisor/rejectRequest', 'Supervisor::rejectRequest', ['as' => 'supervisor.rejectRequest']);
