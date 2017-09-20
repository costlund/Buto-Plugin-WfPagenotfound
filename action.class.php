<?php
/**
<p>
Plugin to handle when client trying to access a none existing page. 
</p>
 */
class PluginWfPagenotfound{
  /**
  <p>
  This event should listen form event page_not_found. 
  </p>
  <p>
  Location params are optional. 
  If param data/location_url is set user will be transfer to that page.  
  Otherwise user will get a message and 404 as status code.
  </p>
   */
  public static function event_handler($data, $event = null){
    /**
     * 
     */
    $data = new PluginWfArray($data);
    /**
     * Change location.
     */
    if($data->get('data/location_url')){
      if(!$data->get('data/location_status_code')){
        $data->set('data/location_status_code', 303);
      }
      header('Location: '.$data->get('data/location_url'), true, $data->get('data/location_status_code'));
      die();
    }
    header("HTTP/1.0 404 Not Found");
    $element = wfFilesystem::loadYml(__DIR__.'/data/alert.yml');
    $element = wfArray::set($element, 'html/innerHTML/body/innerHTML/col/innerHTML/alert/innerHTML/webmaster/innerHTML/description/innerHTML', wfArray::get($event, 'description'));
    wfDocument::renderElement(($element));
    exit();
  }
}
