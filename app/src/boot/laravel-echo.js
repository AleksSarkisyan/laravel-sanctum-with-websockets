import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

const echo = new Echo({
  broadcaster: 'pusher',
  // key: process.env.MIX_PUSHER_APP_KEY,
  // cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  key: 'FoodDeliveryApp',
  cluster: 'mt1',
  forceTLS: false,
  wsHost: window.location.hostname,
  wsPort: 6001,
  //wssPort: 6001,
  enabledTransports: ['ws', 'wss', 'flash'],
  disableStats: true,
});

export { echo };
