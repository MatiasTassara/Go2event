<?php
namespace dao;

use Model\Calendar as M_Calendar;
use Model\Artist as M_Artist;
use Dao\ArtistDb as D_Artist;
use Dao\CalendarDb as D_Calendar;
use Dao\VenueDb as D_Venue;
use Dao\EventDb as D_Event;

/**
 *
 */
class ArtistsPerCalendarDb extends SingletonDAO implements \interfaces\Idao
{

  private $connection;
  private $daoArtist;
  private $daoCalendar;
  private $daoVenue;
  private $daoEvent;
  function __construct(){

     $this->daoArtist = D_Artist::getInstance();
     $this->daoCalendar = D_Calendar::getInstance();
     $this->daoVenue = D_Venue::getInstance();
     $this->daoEvent = D_Event::getInstance();
  }
  public function add($obj){

    echo "<br> acordarse de usar addArtistPerCalendar, no add";

  }
  /*El siguiente método recibe un calendario y un artista y lo carga en la tabla artists_x_calendar*/
  public function addArtistPerCalendar($calendar, $artist){

    $sql = "INSERT INTO artists_x_calendar(id_calendar, id_artist) values (:id_calendar, :id_artist)";
    $parameters['id_calendar'] = $calendar->getId();
    $parameters['id_artist'] = $artist->getId();
    
    

    try{
      $this->connection = Connection::getInstance();
      return $this->connection->executeNonQuery($sql, $parameters);
    }catch(\PDOException $ex){
      throw $ex;
    }
  }



  public function retrieveByName($name){


  }
  /*El siguiente método, recibe un Id Calendario y retorna un arreglo con todos los artistas que estarán en ese calendario*/
  public function  retrieveArtistsByIdCalendar($id_calendar){

    $sql= "SELECT id_artist from artists_x_calendar where id_calendar = :id_calendar";
    $parameters['id_calendar'] = $id_calendar;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);


    }catch(Exception $ex){
      throw $ex;
    }
    if(!empty($response)){
      foreach ($response as $key => $value) {

       $arrayArtists[] = $this->daoArtist->retrieveById($value['id_artist']);
       //var_dump($arrayArtists);


      }
      return $arrayArtists;


    }

  }
  /*El siguiente método recibe un Id de Artista y devuelve un arreglo con todos los calendarios que tiene el artista*/
  public function retrieveCalendarByIdArtist($idArtist){

    $sql = "SELECT id_calendar FROM artists_x_calendar WHERE id_artist = :id_artist";
    $parameters['id_artist'] = $idArtist;
    try{
      $this->connection = Connection::getInstance();
      $response = $this->connection->execute($sql, $parameters);
var_dump($response);
    }catch(Exception $ex){
      throw $ex;
    }
    if(!empty($response)){

      foreach ($response as $key => $value) {

        $arrayCalendars[]= $this->daoCalendar->retrieveById($value['id_calendar']);
       return $arrayCalendars;
      }


    }

  }


  public function retrieveById($id){
  }

  public function getAll(){
  }

  public function update($obj){
  }

  public function delete($id){
  }


}


 ?>
