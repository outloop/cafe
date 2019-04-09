var api_url = '';

switch( process.env.NODE_ENV){
    case 'development':
        api_url = 'http://cafe.test/api/v1';
        break;
    case 'production':
        api_url = 'http://cafe.test/api/v1';
        break;
}

export const config = {
    API_URL: api_url
}
