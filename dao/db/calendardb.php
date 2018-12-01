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

    $sql ="INSERT INTO calendars (id_venue, id_event, date_calendar, active) VALUES (:id_venue, :id_event, :date_calendar, :active)";
    $parameters['id_venue'] = $obj->getVenue()->getId();
    $parameters['id_event'] = $obj->getEvent()->getId();
    $parameters['date_calendar'] = $obj->getDate();
    $parameters['active'] = 1;



    try{
      $this->connection = Connection::getInstance();

      $response = $this->connection->executeNonQuery($sql, $parameters);


    }catch(\PDOException $ex){
       $ex->getMessage();

    }

  }

  public function getLastCalendar(){
    $sql = "SELECT * FROM calendars order by id_calendar desc limit 1";
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql);
    }catch(Exception $ex){
       $ex->getMessage();
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

    $sql = "SELECT * from calendars where id_calendar = :id_calendar and active = 1";
    $parameters['id_calendar'] = $id;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);

    }catch(Exception $ex){
      $ex->getMessage();

    }if(!empty($response)){

      $result = $this->map($response);
      return array_shift($result);
    }

    else
    return null;



  }


  public function getAll(){

    $sql = "SELECT * FROM calendars WHERE active = 1";
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql);
    }catch(Exception $ex){
      $ex->getMessage();
    }
    if(!empty($response))
      return $this->map($response);
    else
    return null;

  }

  public function getAllNonActive(){

    $sql = "SELECT * FROM calendars WHERE active = 2";
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql);
    }catch(Exception $ex){
      $ex->getMessage();
    }
    if(!empty($response))
      return $this->map($response);
    else
    return null;

  }

  public function getCalendarsActAndNonAct(){

    $sql = "SELECT * FROM calendars";
    try{
      $this->connection = Connection::getInstance();
      $response =$this->connection->execute($sql);
    }catch(Exception $ex){
      $ex->getMessage();
    }
    if(!empty($response))
      return $this->map($response);
    else
    return null;

  }

  protected function map($value) {

    $value = is_array($value) ? $value : [];

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
       $ex->getMessage();

    }

  }
   public function quantityTicketsPerCalendar($idCalendar){

    $sql="SELECT sum(t.id_ticket) as result FROM calendars c
          INNER JOIN seats s ON c.id_calendar = s.id_calendar INNER JOIN purchase_items pi 
          ON s.id_seat = pi.id_seat INNER JOIN tickets t ON pi.id_purchase_item = t.id_purchase_item
          WHERE c.id_calendar = :id_calendar";
    $parameters["id_calendar"] = $idCalendar;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);
    }catch(Exception $ex){
       $ex->getMessage();
    }
    if(!empty($response)){
      $quantity = $response['result'];
      return $quantity;
    } else
    return 0;

  }
  public function quantityMoneyPerCalendar($idCalendar){

    $sql="SELECT sum(pi.quantity * pi.price) as result FROM  calendars c
          INNER JOIN seats s ON c.id_calendar = s.id_calendar INNER JOIN purchase_items pi 
          ON s.id_seat = pi.id_seat INNER JOIN tickets t ON pi.id_purchase_item = t.id_purchase_item
          WHERE c.id_calendar = :id_calendar";
    $parameters["id_calendar"] = $idCalendar;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);
    }catch(Exception $ex){
       $ex->getMessage();
    }
    if(!empty($response)){
      $money = $response['result'];
      return $quantity;
    } else
    return 0;

  }


  public function delete($id){

    $sql = "UPDATE calendars SET active = :active where id_calendar = :id_calendar";
    $parameters['id_calendar'] = $id;
    $parameters['active'] = 2;

    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->executeNonQuery($sql, $parameters);
    }catch(Exception $ex){
       $ex->getMessage();
    }



  }
  public function calendarHasTicket($idCalendar){

    $sql="SELECT t.id_ticket FROM  calendars c 
          INNER JOIN seats s ON c.id_calendar = s.id_calendar INNER JOIN purchase_items pi 
          ON s.id_seat = pi.id_seat INNER JOIN tickets t ON pi.id_purchase_item = t.id_purchase_item
          WHERE c.id_calendar = :id_calendar";
    $parameters["id_calendar"] = $idCalendar;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);
    }catch(Exception $ex){
       $ex->getMessage();
    }
    if(!empty($response))
    return true;
    else
    return false;

  }
  public function retrieveByIdEvent($id){

    $sql = "SELECT * from calendars where id_event = :id_event AND active = 1 AND date_calendar >= NOW() ORDER BY date_calendar";
    $parameters['id_event'] = $id;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);

    }catch(Exception $ex){
       $ex->getMessage();
    }
      if(isset($response))
        return $this->map($response);
      else
        return null;

  }
  public function retrieveUpcomingEvents(){

    $sql = "SELECT id_event 
            FROM calendars 
            WHERE date_calendar >= now() AND active = 1 
            GROUP BY id_event 
            ORDER BY min(date_calendar)
            limit 6;";

    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql);
    }catch(Exception $ex){
      $ex->getMessage();
    }
    $arrayEvents = array();
    if(!empty($response)){
      foreach ($response as $key => $value) {
        $event = $this->daoEvents->retrieveById($value['id_event']);
        $arrayEvents[] = $event;

      }
      return $arrayEvents;

    }else{
      return null;
    }

  }
  
  public function retrieveAllEvents(){

    $sql = "SELECT id_event FROM calendars where date_calendar >= now() and active = 1 GROUP BY id_event ORDER BY min(date_calendar);";
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql);
    }catch(Exception $ex){
      $ex->getMessage();
    }
    $arrayEvents = array();
    if(!empty($response)){
      foreach ($response as $key => $value) {
        $event = $this->daoEvents->retrieveById($value['id_event']);
        $arrayEvents[] = $event;

      }
      return $arrayEvents;

    }else{
      return null;
    }
  }
  public function retrieveEventsByCategory($category){

    $sql = "SELECT DISTINCT c.id_event
    FROM calendars c inner join events e on c.id_event = e.id_event
    inner join categories ca on ca.id_category = e.id_category
    where LOWER(ca.name_category) LIKE :name_category
    and c.date_calendar >= now() and c.active = 1
    GROUP BY c.id_event, c.date_calendar
    ORDER BY min(c.date_calendar);";

    $categ = strtolower($category);
    $parameters['name_category'] = '%'.$categ.'%';

    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);
    }catch(Exception $ex){
      $ex->getMessage();
    }
    $arrayEvents = array();
    if(isset($response)){
      foreach ($response as $key => $value) {
        $event = $this->daoEvents->retrieveById($value['id_event']);
        $arrayEvents[] = $event;

      }
      return $arrayEvents;

    }else{
      return null;
    }
  }

  public function retrieveEventsByName($name){
    $sql = "SELECT DISTINCT c.id_event
    FROM calendars c inner join events e on c.id_event = e.id_event
    where
    lower(e.name_event) like :name_event and c.date_calendar >= now()
    and c.active = 1
    GROUP BY c.id_event, c.date_calendar
    ORDER BY min(c.date_calendar)";

    $na = strtolower($name);
    $parameters['name_event'] = '%'.$na.'%';
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);
    }catch(Exception $ex){
      $ex->getMessage();
    }
    $arrayEvents = array();
    if(isset($response)){
      foreach ($response as $key => $value) {
        $event = $this->daoEvents->retrieveById($value['id_event']);
        $arrayEvents[] = $event;

      }
      return $arrayEvents;

    }else{
      return null;
    }
  }
  public function retrieveEventsByArtist($name_art){

    $sql = "SELECT DISTINCT c.id_event
    from calendars c inner join  artists_x_calendar ac
    on c.id_calendar = ac.id_calendar
    inner join artists a on ac.id_artist = a.id_artist
    where LOWER(a.name_artist) LIKE :name_artist and c.date_calendar >= now()
    and c.active = 1
    GROUP BY c.id_event, c.date_calendar
    ORDER BY min(c.date_calendar)";

    $artist = strtolower($name_art);
    $parameters['name_artist'] = '%'.$artist.'%';

    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql,$parameters);
    }catch(Exception $ex){
      $ex->getMessage();
    }
    $arrayEvents = array();
    if(isset($response)){
      foreach ($response as $key => $value) {
        $event = $this->daoEvents->retrieveById($value['id_event']);
        $arrayEvents[] = $event;

      }
      return $arrayEvents;

    }else{
      return null;
    }

  }

}


?>
