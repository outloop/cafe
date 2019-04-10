import cafeApi from '../api/cafe'


export const cafes = {
    state: {
        cafes: [],
        cafesLoadStatus: 0,
        cafe: {},
        cafeLoadStatus: 0,
        cafeAddStatus:0
    },

    actions: {
        loadCafes( {commit} ) {
            commit('setCafesLoadStatus', 1);

            cafeApi.getCafes().then((response) => {
                commit( 'setCafes', response.data);
                commit( 'setCafesLoadStatus', 2);
            }).catch( () => {
                commit( 'setCafes', []);
                commit( 'setCafesLoadStatus', 3);
            });

        },
        loadCafe( {commit}, data ) {
            commit('setCafeLoadStatus', 1);

            cafeApi.getCafe(data.id).then((res) => {
                commit('setCafe', res.data);
                commit('setCafeLoadStatus', 2);
            }).catch(()=>{
                commit('setCafe', {});
                commit('setCafeLoadStatus', 3);
            });
        },
        addCafe( {commit, state, dispatch}, data) {
            commit('setCafeAddStatus', 1);
            cafeApi.postCafe(data.name, data.address, data.city, data.state, data.zip).then( (res) => {
                commit('setCafeAddStatus', 2);
                dispatch('loadCafes');
            } ).catch( ()=>{
                commit('setCafeAddStatus', 3);
            } );
        }
    },

    mutations: {
        setCafes(state, cafes) {
            state.cafes = cafes;
        },
        setCafesLoadStatus(state, status) {
            state.cafesLoadStatus = status;
        },
        setCafe(state, cafe) {
            state.cafe = cafe;
        },
        setCafeLoadStatus(state, status) {
            state.cafeLoadStatus = status;
        },
        setCafeAddStatus(state, status) {
            state.cafeAddStatus = status;
        }
    },

    getters: {
        getCafes(state) {
            return state.cafes;
        },
        getCafesLoadStatus(state) {
            return state.cafesLoadStatus;
        },
        getCafe(state) {
            return state.cafe;
        },
        getCafeLoadStatus(state) {
            return state.cafeLoadStatus;
        },
        getCafeAddStatus(state) {
            return state.cafeAddStatus;
        }
    }

};
