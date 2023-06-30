import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        counter: 0,
        allprojects: [],
        activeProjects: [],
        projectCats: [],
        checkedCat: []
    },
    getters: {
        counter: state => state.counter * 2,
        activeProjects: state => state.activeProjects
    },
    mutations: {
        increment: state => state.counter++,
        checked( state, payload ) {
            // console.log( payload.length)
            let payloadLength = payload.length;
            if ( payloadLength ) {
                // console.log( payload.length)
                let activeCatProjects = '';
                state.activeProjects = activeCatProjects
            } else {
                state.activeProjects = state.allprojects
            }
            
        }
    }
})