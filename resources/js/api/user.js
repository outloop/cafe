import {config} from '../config'

export default {
    getUser: () => {
        return axios.get(config.API_URL + '/user');
    }
}
