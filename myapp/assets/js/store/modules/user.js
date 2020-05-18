// Initial state
const state = () => ({
  id: undefined,
  username: undefined,
  email: undefined,
  roles: [],
});

const getters = {
  user: (ownState) => ({
    id: ownState.id,
    username: ownState.username,
    email: ownState.email,
    roles: ownState.roles,
  }),
};

export default {
  namespaced: true,
  state,
  getters,
  actions: {},
  mutations: {},
};
