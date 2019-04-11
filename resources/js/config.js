var api_url = '';
var app_url = '';

switch( process.env.NODE_ENV){
    case 'development':
        api_url = 'http://cafe.test/api/v1';
        app_url = 'http://cafe.test';
        break;
    case 'production':
        api_url = 'http://cafe.test/api/v1';
        app_url = 'http://cafe.test';
        break;
}

export const config = {
    API_URL: api_url,
    APP_URL: app_url
};
