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
$route['timeline'] = 'timeline/index';
$route['clients/capture'] = 'client/capture';
$route['clients'] = 'client/index';
$route['client/(:num)/edit'] = 'client/edit/$1';
$route['client/(:num)/update'] = 'client/update/$1';
$route['client/(:num)/delete'] = 'client/delete/$1';
$route['projects/capture'] = 'project/capture';
$route['projects'] = 'project/index';
$route['project/(:num)/link-to-client'] = 'project/linkClient/$1';
$route['project/new/link-to-client'] = 'ProjectClientLink/link_project_to_client/';
$route['project/(:num)/edit'] = 'project/edit/$1';
$route['project/(:num)/update'] = 'project/update/$1';
$route['project/(:num)/delete'] = 'project/delete/$1';
$route['teams/capture'] = 'team/capture';
$route['teams'] = 'team/index';
$route['team/(:num)/link-to-project'] = 'team/linkProject/$1';
$route['team/new/link-to-project'] = 'TeamProjectLink/link_team_to_project/';
$route['team/(:num)/edit'] = 'team/edit/$1';
$route['team/(:num)/update'] = 'team/update/$1';
$route['team/(:num)/delete'] = 'team/delete/$1';
$route['team-members/capture'] = 'teamMember/capture';
$route['team-members'] = 'teamMember/index';
$route['team-member/(:num)/link-to-team'] = 'teamMember/linkTeam/$1';
$route['team-member/new/link-to-team'] = 'TeamMemberTeamLink/link_team_member_to_team/';
$route['team-member/(:num)/edit'] = 'team-member/edit/$1';
$route['team-member/(:num)/update'] = 'team-member/update/$1';
$route['team-member/(:num)/delete'] = 'team-member/delete/$1';
$route['default_controller'] = 'Home/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
