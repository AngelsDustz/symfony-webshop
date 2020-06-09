/* eslint-disable no-param-reassign */

export default {
  namespaced: true,
  state() {
    return {
      username: undefined,
      email: undefined,
      roles: [],
    };
  },
  getters: {
    user: (state) => ({
      username: state.username,
      email: state.email,
      roles: state.roles,
    }),
    username: (state) => state.username,
  },
  mutations: {
    setUser(state, payload) {
      state.username = payload.username;
      state.email = payload.email;
      state.roles = payload.roles;
    },
  },
};
