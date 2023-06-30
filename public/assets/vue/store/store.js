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
            
            const payloadToArr = JSON.parse(JSON.stringify(payload));
            let payloadLength = payloadToArr.length;
            if ( payloadLength ) {
                const activeCatProjects = [];

                let Allprojects = state.allprojects,
                    AllprojectsLength = Allprojects.length;

                for( let i =0; i < AllprojectsLength; i++ ) {
                    if ( Allprojects[i].project_cat ) {
                        
                        let projectCats = Allprojects[i].project_cat.map( value => value.term_id );
                        let filteredArray = projectCats.filter(value => payloadToArr.includes(value));
                        if ( filteredArray.length ) {
                            activeCatProjects.push(Allprojects[i])
                        }
                    }
                }

                state.activeProjects = activeCatProjects
            } else {
                state.activeProjects = state.allprojects
            }
            
        }
    }
})