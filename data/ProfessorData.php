<?php

include_once __DIR__.'/../data/Connector.php';
include_once __DIR__.'/../domain/Professor.php';
include_once __DIR__.'/../domain/ProfessorAll.php';

date_default_timezone_set('America/Costa_Rica');

//include_once __DIR__.'/./resource/log/ErrorHandler.php';

class ProfessorData extends Connector
{

    public function insertProfessorWithCredentials($professor, $pass)
    {
        $query = "call insertProfessorWithCredentials("
        . "" . $professor->getProfessorPerson() . ","
            . "'" . $pass . "')";
        try {
            return $this->exeQuery($query);
        } catch (Exception $ex) {
            ErrorHandler::Log(__METHOD__, $query, $_SESSION["id"]);
        }
    }

    public function update($professor)
    {
        $query = "call updateProfessor(" . $professor->getProfessorId() . ","
        . "" . $professor->getProfessorPerson() . ")";
        try {
            return $this->exeQuery($query);
        } catch (Exception $ex) {
            ErrorHandler::Log(__METHOD__, $query, $_SESSION["id"]);
        }
    }

    public function delete($id)
    {
        $query = 'call delete("' . $id . '");';
        try {
            if ($this->exeQuery($query)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            ErrorHandler::Log(__METHOD__, $query, $_SESSION["id"]);
        }
    }

    public function getAll()
    {
        $query = "call getAllProfessor()";
        try {
            $allProfessors = $this->exeQuery($query);
            $array = [];
            if (mysqli_num_rows($allProfessors) > 0) {
                while ($row = mysqli_fetch_array($allProfessors)) {
                    $currentProfessor = new ProfessorAll($row['professorid'], $row['personid'], $row['persondni'], $row['personfirstname'], $row['personfirstlastname'], $row['personsecondlastname'], $row['personemail'], $row['persongender'], $row['personnationality'], $row['userusername'], $row['useruserpass']);
                    array_push($array, $currentProfessor);
                }
            }
            return $array;
        } catch (Exception $ex) {
            ErrorHandler::Log(__METHOD__, $query, $_SESSION["id"]);
        }
    }

    public function getAllSchedule()
    {
        $query = "call getAllProfessor()";
        try {
            $allProfessors = $this->exeQuery($query);
            $array = [];
            if (mysqli_num_rows($allProfessors) > 0) {
                while ($row = mysqli_fetch_array($allProfessors)) {
                    $array[] = array(
                        "personid" => $row['personid'],
                        "personfirstname" => $row['personfirstname'],
                        "personfirstlastname" => $row['personfirstlastname'],
                        "personsecondlastname" => $row['personsecondlastname']);
                }
            }

            foreach ($array as $key => $row) {
                $aux[$key] = $row['personfirstname'];
            }

            array_multisort($aux, SORT_ASC, $array);

            return $array;
        } catch (Exception $ex) {
            ErrorHandler::Log(__METHOD__, $query, $_SESSION["id"]);
        }
    }

    public function getProfessor($id)
    {
        $query = 'call getProfessor("' . $id . '");';
        try {
            $allProfessor = $this->exeQuery($query);
            $array = [];
            if (mysqli_num_rows($allProfessor) > 0) {
                while ($row = mysqli_fetch_array($allProfessor)) {
                    $currentProfessor = new ProfessorAll(
                        $row['professorid'], $row['personid'], $row['persondni'], $row['personfirstname'], $row['personfirstlastname'], $row['personsecondlastname'], $row['personemail'], $row['persongender'], $row['personnationality'], $row['userusername'], $row['useruserpass']);
                    array_push($array, $currentProfessor);
                }
            }
            return $array;
        } catch (Exception $ex) {
            ErrorHandler::Log(__METHOD__, $query, $_SESSION["id"]);
        }
    }

    public function getLastId()
    {
        $query = 'call getProfessorLastId();';
        try {
            $value = $this->exeQuery($query);
            if (mysqli_num_rows($value) > 0) {
                $row = mysqli_fetch_array($value);
                return $row['id'];
            }
            return -1;
        } catch (Exception $ex) {
            ErrorHandler::Log(__METHOD__, $query, $_SESSION["id"]);
        }
    }

    public function insertCourseToProfessor($id, $group, $period, $course)
    {
        $year = date("Y");

        if (date("m") > 7) {
            $year += 1;
        }

        $query = "call insertProfessorCourse('" . $id . "',"
            . "'" . $group . "',"
            . "" . $period . ","
            . "" . $course . ","
            . "" . $year . ")";
        try {
            return $this->exeQuery($query);
        } catch (Exception $ex) {
            ErrorHandler::Log(__METHOD__, $query, $_SESSION["id"]);
        }
    }

    public function deleteProfessorCourse($id)
    {
        $query = 'call deleteProfessorCourse(' . $id . ');';
        try {
            if ($this->exeQuery($query)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            ErrorHandler::Log(__METHOD__, $query, $_SESSION["id"]);
        }
    }

}
