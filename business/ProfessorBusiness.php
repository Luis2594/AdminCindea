<?php

include '../data/ProfessorData.php';

/**
 * Description of ProfessorBusiness
 *
 * @author luisd
 */
class ProfessorBusiness {

    private $professorData;

    public function ProfessorBusiness() {
        return $this->professorData = new ProfessorData();
    }
    
     public function insertProfessorWithCredentials($professor, $pass) {
       return $this->professorData->insertProfessorWithCredentials($professor,$pass);
    }
    
    public function update($professor) {
       return $this->professorData->update($professor);
    }
    
    public function delete($id) {
      return $this->professorData->delete($id);
    }
    
    public function getAll() {
      return $this->professorData->getAll();
    }
    
    public function getProfessor($id) {
     return $this->professorData->getProfessor($id);
    }
    
    public function getLastId() {
        return $this->professorData->getLastId();
    }
    
}