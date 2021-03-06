<?php

include_once __DIR__.'/./FreeCourseBusiness.php';

$id = $_GET['id'];
$code = $_POST['code'];
$name = $_POST['name'];
$numbergroup = $_POST['numbergroup'];
$area = (int) $_POST['area'];
$day = (int) $_POST['day'];
$hour = (int) $_POST['hour'];

if (isset($code) &&
        isset($name) &&
        isset($numbergroup) &&
        isset($area) &&
        isset($day) &&
        isset($hour)
) {
    $freeCourseBusiness = new FreeCourseBusiness();

    $course = new FreeCourse($id, $code, utf8_decode($name), $numbergroup, $area, $day, $hour, 0, "System");

    if ($freeCourseBusiness->update($course)) {
        header("location: ../view/InformationCourseEmergent.php?id=" . $id . "&action=1&msg=Registro_creado_correctamente");
    } else {
        header("location: ../view/InformationCourseEmergent.php?id=" . $id . "&action=0&msg=El_curso_no_fue_creado_correctamente._Puede_que_exista_uno_con_el_mismo_código_de_módulo.");
    }
} else {
    //error
    header("location: ../view/InformationCourseEmergent.php?id=" . $id . "&action=0&msg=Datos_erroneos");
}
