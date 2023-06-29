import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        counter: 0,
        projects: [],
        projectCats: [],
        checkedCat: []
    },
    getters: {
        counter: state => state.counter * 2
    },
    mutations: {
        increment: state => state.counter++,
        checked( state, { categoryId, isActive } ) {
            // console.log( categoryId)
            
        }
    }
})