<?php
namespace dao\db;

use Model\Seat as M_Seat;
use Dao\db\SeatTypeDb as D_SeatType;
use Dao\db\CalendarDb as D_Calendar;
use Dao\singletondao as SingletonDAO;
/**
*
*/
class SeatDb extends SingletonDAO implements \interfaces\Idao
{

  private $connection;
  private $daoSeatTypes;
  private $daoCalendar;
  function __construct(){

    $this->daoSeatTypes = D_SeatType::getInstance();
    $this->daoCalendar = D_Calendar::getInstance();

  }


  public function add($obj){

    $sql ="INSERT INTO seats (quant, price, remaining, id_seattype, id_calendar) VALUES (:quant, :price, :remaining, :id_seattype, :id_calendar)";

    $parameters['quant'] = $obj->getQuantity();
    $parameters['price'] = $obj->getPrice();
    $parameters['remaining'] =$obj->getRemaining();
    $parameters['id_seattype'] =$obj->getSeatType()->getId();
    $parameters['id_calendar'] =$obj->getCalendar()->getId();


    try{
      $this->connection = Connection::getInstance();

      return $this->connection->executeNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }

  public function retrieveByName($name){



  }


  public function retrieveById($id){

    $sql = "SELECT * from seats where id_seat = :id_seat";
    $parameters['id_seat'] = $id;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);

    }catch(Exception $ex){
      throw $ex;

    }if(!empty($response)){

      $result = $this->map($response);
      return array_shift($result);
    }

    else
    return null;



  }


  public function getAll(){

    $sql = "SELECT * FROM seats";
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql);
    }catch(Exception $ex){
      throw $ex;
    }
    if(!isset($response))
    return $this->map($response);
    else
    return null;

  }

  protected function map($value) {

    $value = is_array($value) ? $value : [];
    $arrayResponse = array();


    $resp = array_map(function($p){

      $seattype = $this->daoSeatTypes->retrieveById($p['id_seattype']);
      $calendar = $this->daoCalendar->retrieveById($p['id_calendar']);

      return new M_Event($p['quant'], $p['price'], $p['remaining'], $seattype, $calendar, $p['id_seat']);
    }, $value);

    return count($resp) >= 1 ? $resp : $arrayResponse[] = $resp['0'];


  }

  public function update($obj){
    $sql = "UPDATE seats SET quant = :quant, price = :price, remaining = :remaining,  where id_seat = :id_seat";
    $parameters['quant'] = $obj->getQuantity();
    $parameters['price'] = $obj->getPrice();
    $parameters['remaining'] = $obj->getRemaining();
    try{
      $this->connection = Connection::getInstance();
      return $this->connection->ExecuteNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }

  public function delete($id){


  }


}


?>
