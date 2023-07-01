<template>
<v-app>
<v-container>
  <v-layout row wrap>
    <v-flex xs12 md3>
      <CatFilter />
    </v-flex>
    <v-flex xs12 md9>
      <v-container>
        <v-layout row wrap>
          <v-flex xs12>
            <Sort />
          </v-flex>
          <v-flex xs12>
            <v-layout wrap>
              <v-flex v-for="project in projects" :key="project.project_id"  xs12 md6 class="px-3">
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
import Sort  from "./components/Sort.vue";

export default {
  name: 'App',
  components: {
    CatFilter,
    Card,
    Sort
  },
  data() {
    return {
    }
  },
  computed: {
    projects() {
      return this.$store.getters.activeProjects;
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
