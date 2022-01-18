import Echo from 'laravel-echo';
import { api } from '../boot/axios';

window.Pusher = require('pusher-js');

const echo = new Echo({
  broadcaster: 'pusher',
  // key: process.env.MIX_PUSHER_APP_KEY,
  // cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  authEndpoint: 'api/broadcasting/auth',
  key: 'FoodDeliveryApp',
  cluster: 'mt1',
  forceTLS: false,
  wsHost: window.location.hostname,
  wsPort: 6001,
  //wssPort: 6001,
  enabledTransports: ['ws', 'wss', 'flash'],
  disableStats: true,
  authorizer: (channel) => {
    return {
      authorize: (socketId, callback) => {
        console.log('got socketId', socketId)
        api.post('broadcasting/auth', {
            socket_id: socketId,
            channel_name: channel.name
        })
        .then(response => {
          console.log('got response', response)
            callback(false, response.data);
        })
        .catch(error => {
          console.log('got error', error)
            callback(true, error);
        });
      }
    };
  }
});

export { echo };
