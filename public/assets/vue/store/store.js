import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        allprojects: [],
        activeProjects: [],
        projectCats: [],
        checkedCat: [],
        titleOrder: 'titleasc',
        catOrder: 'catasc'
    },
    getters: {
        activeProjects: state => state.activeProjects
    },
    mutations: {
        checked( state, payload ) {

            const payloadToArr = JSON.parse(JSON.stringify(payload));
            let payloadLength = payloadToArr.length;
            if ( payloadLength ) {
                const activeCatProjects = [];

                let Allprojects = state.allprojects,
                    AllprojectsLength = Allprojects.length;

                for( let i =0; i < AllprojectsLength; i++ ) {
                    
                    if ( Allprojects[i].project_cat ) {
                        
                        let projectCats = Allprojects[i].project_cat.map( value => value.term_id ),
                            filteredArray = projectCats.filter( value => payloadToArr.includes( value ) );

                        if ( filteredArray.length ) {
                            activeCatProjects.push( Allprojects[i] )
                        }
                    }
                }

                state.activeProjects = activeCatProjects;
            } else {
                state.activeProjects = state.allprojects;
            }

            console.log(state.titleOrder);

            this.commit( 'sorting', state.titleOrder )
            
        },
        sorting(state, payload) {
            state.titleOrder = payload;
            const activeProjects = state.activeProjects;
            if ( payload == 'titledesc' ) {
                activeProjects.sort( (a, b) => {
                    let fa = a.project_title.toLowerCase(),
                        fb = b.project_title.toLowerCase();
                    if( fa > fb ) {
                        return -1;
                    }
                    if( fa > fb ) {
                        return 1;
                    }
                    return 0;
                });
            }

            if ( payload == 'titleasc' ) {
                activeProjects.sort( (a, b) => {
                    let fa = a.project_title.toLowerCase(),
                        fb = b.project_title.toLowerCase();
                    if( fb > fa ) {
                        return -1;
                    }
                    if( fb > fa ) {
                        return 1;
                    }
                    return 0;
                });
            }

            if( payload == 'titledefault' ) {
                activeProjects = state.activeProjects;
            }

            
        }
    }
})