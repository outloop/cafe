import userApi from '../api/user'


export const users = {
    state: {
        user: {},
        userLoadStatus: 0
    },
    actions: {
        loadUser({commit}) {
            commit('setLoadUserStatus', 1);
            userApi.getUser().then( (res) => {
                commit('setUser', res.data);
                commit('setLoadUserStatus', 2);
            }).catch(() => {
                commit('setUser', {});
                commit('setLoadUserStatus', 3);
            });
        }
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setLoadUserStatus(state, status) {
            state.userLoadStatus = status;
        }
    },
    getters: {
        getUser(state) {
            return state.user;
        },
        getUserLoadStatus(state) {
            return state.userLoadStatus;
        }
    }
};
