# food-delivery-app

Local SETUP

-   composer install
-   Run php artisan migrate
-   Install quasar cli https://quasar.dev/quasar-cli/installation
-   Run php artisan serve from {parent dir}
-   Run php artisan websockets:serve from {parent dir}
-   Run quasar dev from {parent dir}/app
-   Important - Open project from http://127.0.0.1:8080/
-   Login from different browsers to test order crreation/confirmation
-   Use the below env variables

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:uTSQae5HFRxwXSnWdl8y4xKP+10tEuUFfJ8XJooApgM=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=food-delivery-app
DB_USERNAME=postgres
DB_PASSWORD=postgres

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=cookie
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
MIX_API_URL=127.0.0.1/

SESSION_DOMAIN=127.0.0.1
SANCTUM_STATEFUL_DOMAINS=localhost,127.0.0.1:8080
