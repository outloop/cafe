import brewMethodsApi from '../api/brewMethods'

export const brewMethods = {
    state: {
        brewMethods: [],
        loadBrewMethodsStatus: 0
    },
    actions: {
        loadBrewMethods( {commit} ) {
            commit('setLoadBrewMethodsStatus', 1);
            brewMethodsApi.getBrewMethods().then((res)=>{
                commit('setBrewMethods', res.data);
                commit('setLoadBrewMethodsStatus', 2);
            }).catch(()=>{
                commit('setBrewMethods', []);
                commit('setLoadBrewMethodsStatus', 3);
            });
        }

    },
    mutations: {
        setLoadBrewMethodsStatus(state){
            state.loadBrewMethodsStatus = state;
        },
        setBrewMethods(state, data) {
            state.brewMethods = data
        }
    },
    getters: {
        getBrewMethods(state) {
            return state.brewMethods;
        },
        getLoadBrewMethodsStatus(state) {
            return state.loadBrewMethodsStatus;
        }
    },

};
