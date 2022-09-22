export default {
     namespaced: true,
     state: {
          code: '',
          objUser: [],
          boolCode: false
     },
     mutations: {
          setUser(state,payload){
               state.objUser = payload;
          },
          setCode(state,payload){
               state.code = payload;
          },
          setBoolCode(state,payload){
               state.boolCode = payload;
          },
          setReset(state, payload){
               state.code = '';
               state.objUser = [];
               state.boolCode = false;
          },
     },
     actions: {
          
     },
     getters: {
          getUser(state){
               return state.objUser;
          },
          getCode(state){
               return state.code;
          },
          getBoolCode(state){
               return state.boolCode;
          },
     }
}