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

    $sql ="INSERT INTO seats (quant, price, remaining, id_seattype, id_calendar, active) VALUES (:quant, :price, :remaining, :id_seattype, :id_calendar, :active)";

    $parameters['quant'] = $obj->getQuantity();
    $parameters['price'] = $obj->getPrice();
    $parameters['remaining'] =$obj->getRemaining();
    $parameters['id_seattype'] =$obj->getSeatType()->getId();
    $parameters['id_calendar'] =$obj->getCalendar()->getId();
    $parameters['active'] = 1;

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

    $sql = "SELECT * from seats where id_seat = :id_seat and active = 1";
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

    $sql = "SELECT * FROM seats WHERE active = 1";
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql);
    }catch(Exception $ex){
      throw $ex;
    }
    if(isset($response))
    return $this->map($response);
    else
    return null;

  }


  public function getAllNonActive(){

    $sql = "SELECT * FROM seats WHERE active = 2";
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql);
    }catch(Exception $ex){
      throw $ex;
    }
    if(isset($response))
    return $this->map($response);
    else
    return null;
  }


  public function getSeatsActAndNonAct(){

    $sql = "SELECT * FROM seats";
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql);
    }catch(Exception $ex){
      throw $ex;
    }
    if(isset($response))
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

      return new M_Seat($p['quant'], $p['price'], $p['remaining'], $seattype, $calendar, $p['id_seat']);
    }, $value);
      //echo '<pre> $resp en map de seatDb = ';var_dump($resp);
    return count($resp) >= 1 ? $resp : $arrayResponse[] = $resp['0'];
  }


  public function update($obj){
    $sql = "UPDATE seats SET quant = :quant, price = :price, remaining = :remaining  where id_seat = :id_seat";
    $parameters['quant'] = $obj->getQuantity();
    $parameters['price'] = $obj->getPrice();
    $parameters['remaining'] = $obj->getRemaining();
    $parameters['id_seat'] = $obj->getId();
    try{
      $this->connection = Connection::getInstance();
      return $this->connection->ExecuteNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;
    }
  }


  public function  retrieveSeatsByIdCalendar($id_calendar){
    $sql= "SELECT * from seats where id_calendar = :id_calendar and active = 1";
    $parameters['id_calendar'] = $id_calendar;
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql,$parameters);
    }catch(Exception $ex){
      throw $ex;
    }
    if(isset($response)){
      return $this->map($response);
      }
    else
      return null;
    }


  public function delete($id){

    $sql = "UPDATE seats SET active = :active WHERE id_seat = :id_seat";
    $parameters['id_seat'] = $id;
    $parameters['active'] = 2;
    try{
      $this->connection = Connection::getInstance();
      return $this->connection->ExecuteNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;
    }
  }

  public function  retrieveSeatsByDate($from,$to){
    $sql= " SELECT 
                s.quant as quant,
                s.price as price,
                s.remaining as remaining,
                s.id_seattype as id_seattype,
                s.id_calendar as id_calendar,
                s.id_seat as id_seat
            FROM  seats s ";//inner join calendars c on s.id_calendar = c.id_calendar
            //where  c.date_calendar BETWEEN :fromDate AND :toDate";
    $parameters['fromDate'] = $from;
    $parameters['toDate'] = $to;
   
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql,$parameters);
    }catch(Exception $ex){
      throw $ex;
    }
    if(isset($response)){
      $result = $this->map($response);
      return array_shift($result);
      }
    else
      return null;
    }

}


?>