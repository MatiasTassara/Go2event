<?php
namespace controller;

use Model\SeatType as M_SeatType;
use DAO\SeatTypeDb as D_SeatType;


class ControllerSeatType
{

	private $daoSeattype;

	public function __construct()
	{
		$this->daoSeattype = D_SeatType::getInstance();
	}

	public function index(){
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			$seattypes = $this->daoSeattype->getAll();
			include(ROOT.'views/seattypes.php');
		 }else include(ROOT.'views/index.php');
	}

	public function addSeatType($name, $description){

		$newSeatType = new M_SeatType($name, $description);
		$this->daoSeattype->add($newSeatType);

		$this->index();

	}
	function modifySeatType($id,$name,$description) {

        $obj = $this->daoSeattype->retrieveById($id);

        $obj->setName($name);
        $obj->setDesc($description);


        $this->daoSeattype->update($obj);
        $this->index();
      }

      function deleteSeatType($idSeatType) {
        $this->daoSeattype->delete($idSeatType);
        $this->index();
      }
}
?>
