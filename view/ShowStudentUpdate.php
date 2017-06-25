<?php
//session_start();
//if (!isset($_SESSION['id'])) {
//    header("location: ./Login.php");
//}

include './reusable/Header.php';
?>

<!-- Content Header (Page header) -->
<section class="content-header" style="text-align: left">
    <ol class="breadcrumb">
        <li><a href="Home.php"><i class="fa fa-arrow-circle-right"></i> Inicio</a></li>
        <li><a href="ShowStudentUpdate.php"><i class="fa fa-arrow-circle-right"></i> Actualizar Estudiantes</a></li>
    </ol>
</section>
<br>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Actualizar Estudiantes del Cindea</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Primer Apellido</th>
                                <th>Segundo Apellido</th>
                                <th>Edad</th>
                                <th>Género</th>
                                <th>Adecuación</th>
                                <th>Grupo</th>
                                <th>Actualizar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../business/StudentBusiness.php';
                            $studentBusiness = new StudentBusiness();

                            $students = $studentBusiness->getAll();

                            foreach ($students as $student) {
                                ?>
                                <tr>
                                    <td><?php echo $student->getPersonDni(); ?></td>
                                    <td><?php echo $student->getPersonFirstName(); ?></td>
                                    <td><?php echo $student->getPersonFirstlastname(); ?></td>
                                    <td><?php echo $student->getPersonSecondlastname(); ?></td>
                                    <td><?php echo $student->getPersonAge(); ?></td>
                                    <?php
                                    if ($student->getPersonGender() == "1") {
                                        ?> 
                                        <td>Hombre</td>
                                        <?php
                                    } else {
                                        ?> 
                                        <td>Mujer</td>
                                        <?php
                                    }
                                    ?> 

                                    <?php
                                    if ($student->getStudentAdecuacy() == "0") {
                                        ?> 
                                        <td>Sin adecuación</td>
                                        <?php
                                    } else {
                                        ?> 
                                        <td>Con adecuación</td>
                                        <?php
                                    }
                                    ?> 
                                    <td><?php echo $student->getStudentgroup(); ?></td>
                                    <td><a href="">Actualizar</a></td>
                                </tr>
                                <?php
                            }
                            ?> 
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Primer Apellido</th>
                                <th>Segundo Apellido</th>
                                <th>Edad</th>
                                <th>Género</th>
                                <th>Adecuación</th>
                                <th>Grupo</th>
                                <th>Actualizar</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

<?php
include './reusable/Footer.php';
?>

<!-- page script -->
<script type="text/javascript">
    $(function () {
        $("#example1").dataTable();
    });
</script>

