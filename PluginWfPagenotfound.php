<?php
class PluginWfPagenotfound{
  public static function event_handler($data, $event = null){
    wfPlugin::includeonce('wf/array');
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
    if(!wfRequest::get('_time')){
      header("HTTP/1.0 404 Not Found");
      $element = wfFilesystem::loadYml(__DIR__.'/data/alert.yml');
      $element = wfArray::set($element, 'html/innerHTML/body/innerHTML/col/innerHTML/alert/innerHTML/webmaster/innerHTML/description/innerHTML', wfArray::get($event, 'description'));
      wfDocument::renderElement(($element));
    }else{
      echo wfArray::get($event, 'description');
    }
    exit();
  }
}
