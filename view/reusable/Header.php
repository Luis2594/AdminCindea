<?php
error_reporting(0);
ini_set('display_errors', 0);

include './reusable/Session.php';
include_once '../resource/Constants.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Administración</title>
        <link rel="icon" type="image/png" href="./../resource/images/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="./../resource/images/favicon-16x16.png" sizes="16x16" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="./../resource/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- FontAwesome 4.3.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons 2.0.0 -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="./../resource/css/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link href="./../resource/css/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="./../resource/css/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="./../resource/css/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="./../resource/css/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="./../resource/css/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="./../resource/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="./../resource/css/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="./../resource/css/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="./../resource/css/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link href="./../resource/css/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- daterange picker -->
        <link href="./../resource/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="./../resource/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="./../resource/css/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

        <!--ALERTIFY-->
        <link href="./../resource/css/alertify/themes/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="./../resource/css/alertify/alertify.css" rel="stylesheet" type="text/css" />
        <link href="./../resource/css/alertify/alertify.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="skin-blue">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="./Home.php" class="logo">
                    <b>
                        <label>Administración</label>
                    </b>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php
if (isset($_SESSION['id'])) {
    include '../business/PersonBusiness.php';
    include_once '../domain/Person.php';

    $personBusiness = new PersonBusiness();
    $person = $personBusiness->getPersonId((int) $_SESSION['id'])[0];
    ?>
                                        <img id="imageProfile3" src="./../resource/images/<?php echo $person->getPersonimage(); ?>" class="user-image" alt="User Image" />
                                        <span class="hidden-xs"><?php echo $person->getPersonFirstName() . " " . $person->getPersonFirstlastname(); ?></span>
                                        <?php
} else {
    ?>
                                        <img id="imageProfile3" src="./../resource/images/profile_default.png" width="24" height="24" class="user-image" alt="User Image" />
                                        <span class="hidden-xs">Usuario</span>
                                        <?php
}
?>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <?php
if (isset($_SESSION['type']) && $person != null) {
    ?>
                                            <img id="imageProfile1"src="./../resource/images/<?php echo $person->getPersonimage(); ?>" class="img-circle" alt="User Image" />
                                            <?php
} else {
    ?>
                                            <img id="imageProfile1"src="./../resource/images/profile_default.png" class="img-circle" alt="User Image" />
                                            <?php
}
?>

                                        <p>
                                            <?php
if (isset($_SESSION['type'])) {
    echo $person->getPersonFirstName();
    switch ((int) $_SESSION['type']) {
        case Constants::USER_ADMIN:
            echo '<small>Administrador</small>';
            break;
        default:
            session_start(); //to ensure you are using same session
            session_unset(); // remove all session variables
            session_destroy(); //destroy the session
            header("location: ./Login.php");
            break;
    }
} else {
    echo 'Usuario';
}
?>

                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="./ShowProfile.php" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <form role="form" id="form" action="../business/LogoutAction.php" method="POST" enctype="multipart/form-data">
                                                <input type="submit" class="btn btn-default btn-flat" value="Cerrar Sessión" />
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php
if (isset($_SESSION['id'])) {
    ?>
                                <img id="imageProfile2" src="./../resource/images/<?php echo $person->getPersonimage(); ?>" class="img-circle" alt="User Image" />
                                <?php
//echo $person->getPersonFirstName() . " " . $person->getPersonFirstlastname();
} else {
    ?>
                                <img id="imageProfile2" src="./../resource/images/profile_default.png" class="img-circle" alt="User Image" />
                                <?php
}
?>
                        </div>
                        <div class="pull-left info">
                            <p>
                                <?php
if (isset($_SESSION['id'])) {
    echo "<br/>" . $person->getPersonFirstName() . " " . $person->getPersonFirstlastname();
} else {
    ?>
                                    Usuario
                                    <?php
}
?>
                            </p>
                        </div>
                    </div>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MENÚ</li>

                        <?php
if ($_SESSION['dni'] != "999999999") {
    ?>

                            <!--PROFILE-->
                            <li class="treeview">
                                <a>
                                    <i class="fa"></i> <span>Perfil</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="./ShowProfile.php"><i class="fa"></i>Mi Perfil</a></li>
                                    <li><a href="./UpdatePassword.php"><i class="fa"></i>Cambiar Contraseña</a></li>
                                </ul>
                            </li>

                            <!--ENROLLMENT-->
                            <li class="treeview">
                                <a>
                                    <i class="fa"></i> <span>Matrícula</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="./ShowStudents.php?enrollment=enrollment"><i class="fa"></i>Matrícular</a></li>
                                </ul>
                            </li>

                            <!-- NOTIFICATIONS -->
                            <li class="treeview">
                                <a>
                                    <i class="fa"></i> <span>Notificaciones</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="./NotificationsShowAdmins.php"><i class="fa"></i> Administrativos</a></li>
                                    <li><a href="./NotificationsShowProfessors.php"><i class="fa"></i> Profesores</a></li>
                                    <li><a href="./NotificationsShowStudents.php"><i class="fa"></i> Estudiantes</a></li>
                                    <li><a href="./NotificationsShowIncoming.php"><i class="fa"></i> Recibidas</a></li>
                                </ul>
                            </li>

                            <!-- CIRCULAR -->
                            <li class="treeview">
                                <a>
                                    <i class="fa"></i> <span>Circulares</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="./CircularCreate.php"><i class="fa"></i> Enviar Circular</a></li>
                                    <li><a href="./CircularShow.php"><i class="fa"></i> Ver Circulares</a></li>
                                </ul>
                            </li>

                            <!-- ADMIN -->
                            <li class="treeview">
                                <a>
                                    <i class="fa"></i> <span>Administradores</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="./ShowAdmins.php"><i class="fa"></i> Administradores</a></li>
                                    <li><a href="./CreateAdmin.php"><i class="fa"></i> Crear Administradores</a></li>
                                </ul>
                            </li>

                            <!--PROFESSOR-->
                            <li class="treeview">
                                <a>
                                    <i class="fa"></i> <span>Profesores</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="./ShowProfessors.php"><i class="fa"></i> Profesores</a></li>
                                    <li><a href="./CreateProfessor.php"><i class="fa"></i> Crear Profesores</a></li>
                                    <li><a href="./ShowProfessorsManagement.php"><i class="fa"></i> Gestionar Profesores</a></li>
                                </ul>
                            </li>

                            <!--STUDENTS-->
                            <li class="treeview">
                                <a>
                                    <i class="fa"></i> <span>Estudiantes</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="./ShowStudents.php"><i class="fa"></i>Ver Estudiantes</a></li>
                                    <li><a href="./CreateStudent.php"><i class="fa"></i>Crear Estudiante</a></li>
                                    <li><a href="./ShowStudents.php?update=update"><i class="fa"></i>Actualizar Estudiante</a></li>
                                    <li><a href="./ShowStudents.php?delete=delete"><i class="fa"></i>Eliminar Estudiante</a></li>
                                    <li><a href="./ShowGroupsList.php"><i class="fa"></i>Ver Estudiantes por Grupo</a></li>
                                </ul>
                            </li>

                            <!--SPECIALITIES-->
                            <li class="treeview">
                                <a>
                                    <i class="fa"></i> <span>Atinencia</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="./ShowSpecialities.php"><i class="fa"></i>Ver Atinencia</a></li>
                                    <li><a href="./CreateSpeciality.php"><i class="fa"></i>Crear Atinencia</a></li>
                                </ul>
                            </li>

                            <!--COURSES-->
                            <li class="treeview">
                                <a>
                                    <i class="fa"></i> <span>Módulos</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="./ShowCourses.php"><i class="fa"></i>Ver Módulos</a></li>
                                    <li><a href="./CreateCourse.php"><i class="fa"></i>Crear Módulo</a></li>
                                    <li><a href="./ShowCourses.php?update=update"><i class="fa"></i>Actualizar Módulo</a></li>
                                    <li><a href="./ShowCourses.php?delete=delete"><i class="fa"></i>Eliminar Módulo</a></li>
                                </ul>
                            </li>

                            <!-- GROUPS -->
                            <li class="treeview">
                                <a>
                                    <i class="fa"></i> <span>Grupos</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="./ShowGroups.php"><i class="fa"></i>Gestionar Grupos</a></li>
                                    <li><a href="./CreateGroup.php"><i class="fa"></i>Crear Grupo</a></li>
                                </ul>
                            </li>

                            <!--CURRICULUM-->
                            <li class="treeview">
                                <a>
                                    <i class="fa"></i> <span>Malla Curricular</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="./ShowCurriculum.php"><i class="fa"></i>Ver Malla Curricular</a></li>
                                    <li><a href="./CreateCurriculum.php"><i class="fa"></i>Crear Malla Curricular</a></li>
                                </ul>
                            </li>

                            <!--SCHEDULE-->
                            <li class="treeview">
                                <a>
                                    <i class="fa"></i> <span>Horarios</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="active"><a href="./ShowSchedule.php"><i class="fa"></i>Ver Horarios</a></li>
                                    <li class="active"><a href="./CreateSchedule.php"><i class="fa"></i>Crear Horarios</a></li>
                                </ul>
                            </li>

                        <?php }?>

                        <!--EMERGIN ENROLLMENT-->
                        <li class="treeview">
                            <a>
                                <i class="fa"></i> <span>Matrícula Emergente</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a><i class="fa"></i> Matrícula Emergente<i class="fa fa-angle-left pull-right"></i></a>
                                    <ul class="treeview-menu">
                                        <li><a href="./ShowStudentsEmergent.php?enrollment=enrollment"><i class="fa"></i> Matricular</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <a><i class="fa"></i> Estudiantes Emergentes <i class="fa fa-angle-left pull-right"></i></a>
                                    <ul class="treeview-menu">
                                        <li><a href="./ShowStudentsEmergent.php"><i class="fa"></i> Ver Estudiantes</a></li>
                                        <li><a href="./ShowCoursesEmergent.php?export=export"><i class="fa"></i> Exportar Estudiantes</a></li>
                                        <li><a href="./CreateStudentEmergent.php"><i class="fa"></i> Crear Estudiante</a></li>
                                        <li><a href="./ShowStudentsEmergent.php?update=update"><i class="fa"></i> Actualizar Estudiante</a></li>
                                        <li><a href="./ShowStudentsEmergent.php?delete=delete"><i class="fa"></i> Eliminar Estudiante</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a><i class="fa"></i> Cursos Libres <i class="fa fa-angle-left pull-right"></i></a>
                                    <ul class="treeview-menu">
                                        <li><a href="./ShowCoursesEmergent.php"><i class="fa"></i> Ver Cursos Libres</a></li>
                                        <li><a href="./CreateFreeCourse.php"><i class="fa"></i> Crear Curso Libre</a></li>
                                        <li><a href="./ShowCoursesEmergent.php?update=update"><i class="fa"></i> Actualizar Curso Libre</a></li>
                                        <li><a href="./ShowCoursesEmergent.php?delete=delete"><i class="fa"></i> Eliminar Curso Libre</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a><i class="fa"></i> Áreas <i class="fa fa-angle-left pull-right"></i></a>
                                    <ul class="treeview-menu">
                                        <li><a href="./AreasShow.php"><i class="fa"></i> Ver Áreas</a></li>
                                        <li><a href="./AreasCreate.php"><i class="fa"></i> Crear Área</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                            <!--INFO-->
                            <li class="treeview">
                                <a>
                                    <i class="fa"></i> <span>Información CINDEA</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="./InformationInstitution.php"><i class="fa"></i>Ver Información</a></li>
                                </ul>
                            </li>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <div class="content-wrapper">
                <br>
                <br>
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane" id="revenue-chart" style="position: relative; height: 300px;display: none;" ></div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px; display: none;" ></div>
                <div class="chart" id="line-chart" style="display: none;"></div>
