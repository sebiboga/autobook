'use strict';

self.addEventListener('push', function(event) {
  console.log('Received a push message', event);
  

  var title = 'Yay a message.';
  var body = 'We have received a push message.';
  var icon = '/images/icon-192x192.png';
  var tag = 'simple-push-demo-notification-tag';

  var data;
  if (event.data){
	 

    // Need to parse to JSON format
    // - Consider event.data.text() the "stringify()"
    //   version of the data
    var payload = event.data.json();
    // For those of you who love logging
    console.log(event.data.json()); 

    
  } else {
	  //fetch data from server
	  console.log('no data read');
  }
  
  event.waitUntil(
    self.registration.showNotification(title, {
      body: body,
      icon: icon,
      tag: tag
    })
  );
});



self.addEventListener('message', function(event) {
    console.log(event.data.alert);
});



self.addEventListener('notificationclick', function(event) {
  console.log('On notification click: ', event.notification.tag);
  // Android doesn’t close the notification when you click on it
  // See: http://crbug.com/463146
  event.notification.close();

  // This looks to see if the current is already open and
  // focuses if it is
  event.waitUntil(clients.matchAll({
    type: 'window'
  }).then(function(clientList) {
    for (var i = 0; i < clientList.length; i++) {
      var client = clientList[i];
      if (client.url === '/' && 'focus' in client) {
        return client.focus();
      }
    }
    if (clients.openWindow) {
      return clients.openWindow('/');
    }
  }));
});
