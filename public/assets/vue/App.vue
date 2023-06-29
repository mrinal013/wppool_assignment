<template>
<v-app>
<v-container>
  <v-layout row wrap>
    <v-flex xs3>
    <CatFilter />
    </v-flex>
    <v-flex xs9>
      <v-container>
        <v-layout row wrap>
          <v-flex xs12>
            Sort
            <p>{{counter}}</p>
            <button v-on:click="increment">Click</button>
          </v-flex>
          <v-flex xs12>
            <v-layout wrap>
              <v-flex v-for="project in projects" xs6 class="px-3">
                <Card />
              </v-flex>
            </v-layout>
          </v-flex>
        </v-layout>
      </v-container>
    </v-flex>
  </v-layout>
</v-container>
  
</v-app>
</template>

<script>
import CatFilter from "./components/CatFilter.vue";
import Card  from "./components/Card.vue";

export default {
  name: 'App',
  components: {
    CatFilter,
    Card
  },
  data() {
    return {
    }
  },
  computed: {
    counter() {
      return this.$store.state.counter
    },
    projects() {
      return this.$store.state.projects
    }
  },
  methods: {
    increment() {
      console.log(this.$store.state.projects)
      this.$store.commit('increment')
    }
  },
  mounted: function() {
    // console.log(frontend_ajax_object.rest_url)

    let restUrl = frontend_ajax_object.rest_url;

    console.log(restUrl)
    // if ( restUrl ) {
    let projectsUrl = restUrl + 'wp/v2/projects';

    this.axios.get( projectsUrl  )
    .then((result) => {
      // for( let i = 0; i < result.data.length; i++ ) {
      //   let projectId = result.data[i].id;
      //   // if ( projectId ) {
      //   //   this.$store.state.projects[i]['projectId'] = projectId;
      //   // }

      //   let projectTitle = result.data[i].title.rendered;
      //   // if ( projectTitle ) {
      //   //   this.$store.state.projects[i]['projectTitle'] = projectTitle;
      //   // }
        
      //   let projectCat = result.data[i].project_cat;
      //   let projectCatUrl = restUrl + 'wp/v2/project_cat/' + this.projectCat;
      //   let catName = '';
      //   this.axios.get( projectCatUrl )
      //   .then((result) => {
      //     catName = result.data.name;
      //       // this.$store.state.projects[i]['projectCatName'] = result.data.name;
      //   })
        
      //   let mediaId = result.data[i].featured_media;
      //   let mediaUrl = restUrl + 'wp/v2/media/' + mediaId;

      //   this.axios.get( this.mediaUrl )
      //   .then((result) => {
      //     // this.$store.state.projects[i]['sourceUrl'] = result.data.source_url;
      //   })

      //   }
    })
  }
}
</script>

<style>

</style>
