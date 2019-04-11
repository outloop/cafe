import {config} from '../config'

export default {
    getCafes: function () {
        return axios.get(config.API_URL + '/cafes');
    },
    getCafe: function (cafeID) {
        return axios.get(config.API_URL + '/cafes/' + cafeID)
    },
    postCafe: function (name, locations, website, description, roaster) {
        return axios.post(config.API_URL + '/cafes', {
            name: name,
            locations: locations,
            website: website,
            description: description,
            roaster: roaster
        });
    }
}
