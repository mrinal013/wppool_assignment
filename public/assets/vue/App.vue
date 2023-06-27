<template>
<v-app>
<v-container>
  <v-layout row wrap>
    <v-flex xs3 class="red">
    Filter
    </v-flex>
    <v-flex xs9>
      <v-container>
        <v-layout row wrap>
          <v-flex xs12>
            Sort
          </v-flex>
          <v-flex xs12>
            <v-layout wrap>
              <v-flex v-for="project in projects" xs6>
                <Card
                 :project_id="project.project_id" 
                 :title="project.project_title"
                 :media_url="project.media_url" 
                 :project_cat="project.project_cat" />
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
import Card  from "./components/Card.vue";

export default {
  name: 'App',
  components: {
    Card
  },
  data() {
    return {
      projects: []
    }
  },
  mounted: function() {
    
    let rest_url = frontend_ajax_object.rest_url;
    let projects_url = rest_url + 'wp/v2/projects';

    this.axios.get( projects_url  )
    .then((result) => {
      for( let i = 0; i < result.data.length; i++ ) {
        let project_id = result.data[i].id;
        let project_title = result.data[i].title.rendered;
        let media_id = result.data[i].featured_media;
        let media_url = rest_url + 'wp/v2/media/' + media_id;
        let project_cat = result.data[i].project_cat;
        this.projects.push({
          'project_id': project_id,
          'project_title': project_title,
          'media_url': media_url,
          'project_cat': project_cat
        })
      }
    })
  }
}
</script>

<style>

</style>
