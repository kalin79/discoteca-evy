import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate'
import user from './modules/user';

const store = createStore({
     plugins:[
          createPersistedState({
               path:[
                    'modules.user',
               ]
          })
     ],
     modules: {
          user,
     }

});

export default store;