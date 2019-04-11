import {config} from '../config'

export default {
    getBrewMethods: () => {
        return axios.get(config.API_URL + '/brew-methods');
    }
}
