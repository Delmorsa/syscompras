<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']   = 'Login_controller';
$route['404_override']         = '';
$route['translate_uri_dashes'] = false;

$route['sendMail'] = 'Notificaciones_controller/sendMail';

$route['prueba'] = 'Notificaciones_controller/prueba';

$route['SolicitudesJefe']              = 'Notificaciones_controller/mostrarSolicitudesJefe';
$route['SolicitudesAutNot']            = 'Notificaciones_controller/mostrarSolicitudesAut';
$route['mostrarSolicitudesAnul']       = 'Notificaciones_controller/mostrarSolicitudesAnul';
$route['mostrarSolicitudesRechazadas'] = 'Notificaciones_controller/mostrarSolicitudesRechazadas';

$route['mostrarProveedoresSAP']   = 'Compras_controller/mostrarProveedoresSAP';
$route['mostrarProveedoresSAPCH'] = 'Compras_controller/mostrarProveedoresSAPCH';
$route['mostrarImpSAP']           = 'Compras_controller/mostrarImpSAP';

/*********************************************************************************************************************************************** */
$route['Dashboard']         = 'Login_controller/dashborad';
$route['Login']             = 'Login_controller/Acreditar';
$route['Logout']            = 'Login_controller/Salir';
$route['mostrarConectados'] = 'Login_controller/mostrarConectados'; //mostrar usuarios conectados
/*********************************************************************************************************************************************** */

/*********************************************************************************************************************************************** */
$route['Roles']            = 'Roles_controller';
$route['guardarRol']       = 'Roles_controller/guardarRol';
$route['actualizarRol']    = 'Roles_controller/actualizarRol';
$route['actualizarEstado'] = 'Roles_controller/actualizarEstado';
/*********************************************************************************************************************************************** */

/*********************************************************************************************************************************************** */
$route['Usuarios']               = 'Usuarios_controller';
$route['getUsuariosAjax']        = 'Usuarios_controller/getUsuariosAjax';
$route['getUserJefe']            = 'Usuarios_controller/getUserJefe';
$route['getUserJefeEdit/(:any)'] = 'Usuarios_controller/getUserJefeEdit/$1';
$route['guardarUser']            = 'Usuarios_controller/guardarUser';
$route['actualizarUser']         = 'Usuarios_controller/actualizarUser';
$route['bajaUser']               = 'Usuarios_controller/bajaUser';

$route['perfil']         = 'Usuarios_controller/perfil';
$route['actualizarPass'] = 'Usuarios_controller/actualizarPass';
$route['datosSolic']     = 'Usuarios_controller/datosSolic';
/*********************************************************************************************************************************************** */

/*********************************************************************************************************************************************** */
$route['Areas']                = 'Areas_controller';
$route['guardarArea']          = 'Areas_controller/guardarArea';
$route['actualizarArea']       = 'Areas_controller/actualizarArea';
$route['actualizarEstadoArea'] = 'Areas_controller/actualizarEstadoArea';
$route['getAreasAjax']         = 'Areas_controller/getAreasAjax';
/*********************************************************************************************************************************************** */

/*********************************************************************************************************************************************** */
$route['Solicitudes']  = 'Solicitudes_controller';
$route['DashboardSol'] = 'Solicitudes_controller/dashboardSolicitantes';
$route['nuevaSolic']   = 'Solicitudes_controller/nuevaSolic';
$route['anularSolic']  = 'Solicitudes_controller/anularSolicitudes';

$route['guardarSolic']                    = 'Solicitudes_controller/guardarSolicitud';
$route['getSolicitudesAjax']              = 'Solicitudes_controller/getSolicitudesAjax';
$route['getSolicitudesDetAjax/(:any)']    = 'Solicitudes_controller/getSolicitudesDetAjax/$1'; //detalle de solicitud modulo mis solicitudes
$route['getSolicitudesAutDetAjax/(:any)'] = 'Solicitudes_controller/getSolicitudesAutDetAjax/$1'; //detalle de solicitud modulo mis solicitudes
$route['bajaSolicituduser']               = 'Solicitudes_controller/bajaSolicitud';

$route['autSolicitudes']        = 'Solicitudes_controller/autSolicitudes';
$route['getSolicitudesAutAjax'] = 'Solicitudes_controller/getSolicitudesAutAjax'; //solicitudes a autorizar
$route['autorizarSolicitud']    = 'Solicitudes_controller/autorizarSolicitud';

$route['cargarSolicAnula']      = 'Solicitudes_controller/cargarSolicAnula';
$route['anularSolicitud']       = 'Solicitudes_controller/anularSolicitud';
$route['cerraSolicitud/(:any)'] = 'Compras_controller/cerraSolicitud/$1';

$route['editSolicitud/(:any)']     = 'Solicitudes_controller/editSolicitud/$1';
$route['editSolicitudAjax/(:any)'] = 'Solicitudes_controller/editSolicitudAjax/$1';
$route['actualizarSolicitud']      = 'Solicitudes_controller/actualizarSolicitud';

$route['denegarSolicitud/(:any)'] = 'Solicitudes_controller/denegarSolicitud/$1';
/*********************************************************************************************************************************************** */

/*********************************************************************************************************************************************** */

$route['Compras']                           = 'Compras_controller';
$route['compras_autorizadas/(:any)/(:any)'] = 'Compras_controller/SolicAutorizadas/$1/$2';

$route['ordenPago/(:any)']              = 'Compras_controller/ordenPago/$1';
$route['getSolicitudesDetOrden/(:any)'] = 'Compras_controller/getSolicitudesDetOrden/$1';
$route['saveOrdenPago']                 = 'Compras_controller/saveOrdenPago';
$route['updateOrdenPago']               = 'Compras_controller/updateOrdenPago';
$route['updateOrdenCompra']             = 'Compras_controller/updateOrdenCompra';

$route['addItemOP'] = 'Compras_controller/addItemOP';
$route['addItemOC'] = 'Compras_controller/addItemOC';
$route['addItemCH'] = 'Compras_controller/addItemCH';

$route['ordenCompra/(:any)'] = 'Compras_controller/ordenCompra/$1';
$route['saveOrdenCompra']    = 'Compras_controller/saveOrdenCompra';

$route["cajaChica/(:any)"]    = "Compras_controller/cajaChica/$1";
$route["saveCajaChica"]       = "Compras_controller/saveCajaChica";
$route["mostrarCH/(:any)"]    = "Compras_controller/mostrarCH/$1";
$route["mostrarDetCH/(:any)"] = "Compras_controller/mostrarDetCH/$1";
$route["updateCajaChica"]     = "Compras_controller/updateCajaChica";

$route['mostrarOC/(:any)']    = 'Compras_controller/mostrarOC/$1';
$route['mostrarDetOC/(:any)'] = 'Compras_controller/mostrarDetOC/$1';
$route['mostrarOP/(:any)']    = 'Compras_controller/mostrarOP/$1';
$route['mostrarDetOP/(:any)'] = 'Compras_controller/mostrarDetOP/$1';

$route['viewEditOrder/(:any)/(:any)/(:any)'] = 'Compras_controller/viewEditOrder/$1/$2/$3';
$route['editOrders/(:any)/(:any)/(:any)']    = 'Compras_controller/editOrders/$1/$2/$3';
$route['editOrdersC/(:any)/(:any)/(:any)']   = 'Compras_controller/editOrdersC/$1/$2/$3';
$route['editOrdersCH/(:any)/(:any)/(:any)']  = 'Compras_controller/editOrdersCH/$1/$2/$3';

$route['viewAddItemOrder/(:any)/(:any)/(:any)'] = 'Compras_controller/viewAddItemOrder/$1/$2/$3';

$route['bajaOrden']          = 'Compras_controller/bajaOrden';
$route['bajaOrdenArticulos'] = 'Compras_controller/bajaOrdenArticulos';
/*********************************************************************************************************************************************** */

$route["Documentos"]      = "Documentos_controller";
$route["mostrarOPDoc"]    = "Documentos_controller/mostrarOPDoc";
$route["mostrarOCDoc"]    = "Documentos_controller/mostrarOCDoc";
$route["subirDocumentos"] = "Documentos_controller/subirDocumentos";

$route["getDocCuadros/(:any)/(:any)"] = "Documentos_controller/getDocCuadros/$1/$2";
$route["bajaCuadro"]                  = "Documentos_controller/bajaCuadro";
$route["getDocumentos/(:any)/(:any)"] = "Documentos_controller/getDocumentos/$1/$2";
$route["elmiminarDoc"]                = "Documentos_controller/elmiminarDoc";

$route["imprimirDocumentos/(:any)/(:any)"] = "Documentos_controller/imprimir/$1/$2";
$route["imprimirSolic/(:any)"]             = "Documentos_controller/imprimirSolic/$1";

/*********************************************************************************************************************************************** */
$route["bajaSolicitud"] = "Compras_controller/bajaSolicitud";
/*********************************************************************************************************************************************** */

$route["rechazadas"]          = "Rechazadas_controller";
$route["guardarSolRechazada"] = "Rechazadas_controller/guardarSolRechazada";
$route["SolicConfirmar"]      = "Rechazadas_controller/SolicConfirmar";

/*********************************************************************************************************************************************** */

$route["bodega"]               = "Bodega_controller";
$route["mostrarOCBodega"]      = "Bodega_controller/mostrarOCBodega";
$route["getDetOrdenOC/(:any)"] = "Bodega_controller/getDetOrdenOC/$1";

$route["mostrarOPBodega"]      = "Bodega_controller/mostrarOPBodega";
$route["getDetOrdenOP/(:any)"] = "Bodega_controller/getDetOrdenOP/$1";

$route["mostrarCHBodega"]      = "Bodega_controller/mostrarCHBodega";
$route["getDetOrdenCH/(:any)"] = "Bodega_controller/getDetOrdenCH/$1";

$route["recepcionarArticulos"] = "Bodega_controller/recepcionarArticulos";

/*********************************************************************************************************************************************** */
$route["reportes"]                            = "Reportes_controller";
$route["historial"]                           = "Reportes_controller/historialSolicitudes";
$route["estadoSolcitudes"]                    = "Usuarios_controller/estadoSolcitudes";
$route["contadorSolic"]                       = "Usuarios_controller/contadorSolic";
$route["mostrarHistorial/(:any)/(:any)"]      = "Reportes_controller/mostrarHistorial/$1/$2";
$route["mostrarHistorialChart/(:any)/(:any)"] = "Reportes_controller/mostrarHistorialChart/$1/$2";
$route["historialChartPie/(:any)/(:any)"]     = "Reportes_controller/historialChartPie/$1/$2";
$route["historialPrioridad/(:any)/(:any)"]    = "Reportes_controller/historialPrioridad/$1/$2";
$route["rptOrdenesHistorial"]                 = "Reportes_controller/rptOrdenesHistorial";
$route["iSolicitudes"]                 = "Reportes_controller/iSolicitudes";
$route["mostrarSolicitudesRpt/(:any)/(:any)"]                 = "Reportes_controller/mostrarSolicitudesRpt/$1/$2";
$route["mostrarAnos"]                 = "Reportes_controller/mostrarAños";
