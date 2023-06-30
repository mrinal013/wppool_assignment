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
              <v-flex v-for="project in projects" :key="project.project_id" xs6 class="px-3">
                <Card :project_id="project.project_id" />
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
      console.log(this.$store.getters.activeProjects)
      return this.$store.getters.activeProjects;
    }
  },
  methods: {
    increment() {
      this.$store.commit('increment')
    }
  },
  mounted: function() {

    let restUrl = frontend_ajax_object.rest_url;
    let projectsUrl = restUrl + 'projects/v1/all';

    this.axios.get( projectsUrl  )
    .then((result) => {
      this.$store.state.allprojects = result.data;
      this.$store.state.activeProjects = result.data;
    });
    
  }
}
</script>

<style>

</style>
