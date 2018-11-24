<?php
namespace controller;

use Controller\ControllerHome as C_Home;
use Model\SeatType as M_SeatType;
use Dao\db\SeatTypeDb as D_SeatType;


class ControllerSeatType
{

	private $daoSeattype;
	private $cHome;

	public function __construct()
	{
		$this->daoSeattype = D_SeatType::getInstance();
		$this->cHome = new C_Home();
	}

	public function index($alert = null){
		if(isset($_SESSION["user"]) && $_SESSION["user"]->isAdmin() == 1)
		{
			$seattypes = $this->daoSeattype->getAll();
			include(ROOT.'views/seattypes.php');
		}else {
			$this->cHome->index("Usted no es un administrador");
		}
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
