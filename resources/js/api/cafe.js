import {config} from '../config'

export default {
    getCafes: function () {
        return axios.get(config.API_URL + '/cafes');
    },
    getCafe: function (cafeID) {
        return axios.get(config.API_URL + '/cafes/' + cafeID)
    },
    postCafe: function (name, address, city, state, zip) {
        return axios.post(config.API_URL + '/cafes', {
            name: name,
            address: address,
            city: city,
            state: state,
            zip: zip
        });
    }
}
