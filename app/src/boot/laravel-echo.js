import Echo from 'laravel-echo';
import { api } from '../boot/axios';

window.Pusher = require('pusher-js');

const options = {
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
        api.post('broadcasting/auth', {
          socket_id: socketId,
          channel_name: channel.name
        })
        .then(response => {
          callback(false, response.data);
        })
        .catch(error => {
          callback(true, error);
        });
      }
    };
  }
}

const echo = new Echo(options);

export { echo, options };
