# Buto-Plugin-WfPagenotfound
- Plugin to handle when client trying to access a none existing page.

## Settings
- This event should listen form event page_not_found. 
- Location params are optional. 
- If param data/location_url is set user will be transfer to that page.  
- Otherwise user will get a message and 404 as status code.

````
events:
  page_not_found:
    -
      plugin: 'wf/pagenotfound'
      method: handler
      data:
        location_url: '/d/pagenotfound'
````

## Buto
- Buto system is handling this if not set.