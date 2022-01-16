// // import Echo from 'laravel-echo'
// window._ = require('lodash');

// window.io = require('socket.io-client')

// const echo = new Echo({
//     broadcaster: 'socket-io',
//     host: window.location.hostname + ':6001'
// })

// export default ({ Vue }) => {
//     Vue.prototype.$echo = echo
// }

import Echo from 'laravel-echo';
import { boot } from 'quasar/wrappers';

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

// const echo = Vue.prototype.$echo;

// export default boot(({ app }) => {
//   app.config.globalProperties.$echo = echo;
// });

export { echo };

// export default ({ Vue }) => {
//   Vue.prototype.$echo = echo
// }
