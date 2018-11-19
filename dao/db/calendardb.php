<?php
namespace dao\db;

use Model\Calendar as M_Calendar;
use dao\db\EventDb as EventDb;
use dao\db\VenueDb as VenueDb;
use Dao\singletondao as SingletonDAO;
/**
*
*/
class CalendarDb extends \dao\SingletonDAO implements \interfaces\Idao
{

  private $connection;
  private $daoEvents;
  private $daoVenues;
  function __construct(){

    $this->daoEvents = EventDb::getInstance();
    $this->daoVenues = VenueDb::getInstance();

  }

  public function add($obj){

    $sql ="INSERT INTO calendars (id_venue, id_event, date_calendar) VALUES (:id_venue, :id_event, :date_calendar)";
    $parameters['id_venue'] = $obj->getVenue()->getId();
    $parameters['id_event'] = $obj->getEvent()->getId();
    $parameters['date_calendar'] = $obj->getDate();
    // $parameters['img_path'] = $obj->getImgPath();


    try{
      $this->connection = Connection::getInstance();

      $response = $this->connection->executeNonQuery($sql, $parameters);


    }catch(\PDOException $ex){
      throw $ex;

    }

  }

  public function getLastCalendar(){
    $sql = "SELECT * FROM calendars order by id_calendar desc limit 1";
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql);
    }catch(Exception $ex){
      throw $ex;
    }
    if(!empty($response)){

      $result = $this->map($response);
      return array_shift($result);
    }

    else
    return null;


  }

  public function retrieveByName($name){


  }


  public function retrieveById($id){

    $sql = "SELECT * from calendars where id_calendar = :id_calendar";
    $parameters['id_calendar'] = $id;
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

    $sql = "SELECT * FROM calendars";
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql);
    }catch(Exception $ex){
      $ex->getMessage();
    }
    if(isset($response))
    return $this->map($response);
    else
    return null;

  }

  protected function map($value) {

    $value = is_array($value) ? $value : [];
//    $arrayResponse = array();


    $resp = array_map(function($p){

      $venue = $this->daoVenues->retrieveById($p['id_venue']);
      $event = $this->daoEvents->retrieveById($p['id_event']);

      return new M_Calendar($venue, $event, $p['date_calendar'], $p['id_calendar']);}, $value);

    return count($resp) >= 1 ? $resp : $arrayResponse[] = $resp['0'];

  }

  public function update($obj){
    $sql = "UPDATE calendars SET date_calendar = :date_calendar, img_path = :img_path, id_venue = :id_venue, id_event = :id_event where id_calendar = :id_calendar";
    $parameters['id_calendar'] = $obj->getId();
    $parameters['date_calendar'] = $obj->getDate();
    $parameters['img_path'] = $obj->getImgPatch();
    $parameters['id_venue'] = $obj->getVenue()->getId();
    $parameters['id_event'] = $obj->getEvent()->getId();
    try{
      $this->connection = Connection::getInstance();
      return $this->connection->ExecuteNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;

    }

  }

  public function delete($id){

    $sql = "DELETE from calendars where id_calendar = :id_calendar";
    $parameters['id_calendar'] = $id;

    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->executeNonQuery($sql, $parameters);
    }catch(Exception $ex){
      throw $ex;
    }



  }


}


?>
