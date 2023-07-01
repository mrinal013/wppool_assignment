<template>
<v-dialog
      v-model="dialog"
      width="95%"
    >

    
      <template v-slot:activator="{ on, attrs }">
      <v-card
    class="mx-auto my-12"
    max-width="374"
  >
<!-- {{ project }} -->
    <v-img
      height="250"
      :src="sourceUrl" contain
      v-bind="attrs"
      v-on="on" 
      v-on:click="fetchSingle(project_id)"
    ></v-img>

    <v-card-title v-bind="attrs"
          v-on="on" v-on:click="fetchSingle(project_id)">Title: {{ title }}</v-card-title>

    

    <v-divider class="mx-4"></v-divider>

    <v-card-title>Category: {{ catName }}</v-card-title>
<div class="text-center">
    <v-btn
          color="red lighten-2 mb-3"
          dark
          v-bind="attrs"
          v-on="on" 
          v-on:click="fetchSingle(project_id)"
        >
          More
        </v-btn>
</div>
  </v-card>
        
      </template>

      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          {{ title }}
        </v-card-title>

        <v-card-text>
          {{ projectContent }}
        </v-card-text>

        <v-divider></v-divider>

        <v-card-text>
          Project url: <a :href="projectUrl" target="_blank">{{ projectUrl }}</a>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-text>
          Project Category: {{ catName }}
        </v-card-text>
        
        <v-divider></v-divider>
        <v-card-text>
          Project Thumbnail: 
          <v-img 
            width="350"
            height="350" 
            contain
            :src="sourceUrl" 
          ></v-img>
        </v-card-text>

        <v-card-text>
          Project Gallery

          <!-- <ul>
            <li v-for="project in projectGallery">
              Hello
            </li>
          </ul> -->
          <v-flex xs12>
            <v-layout wrap>
              <v-flex v-for="project in projectGallery" xs3>
                <v-img 
            width="350"
            height="350" 
            contain
            :src="project" 
          ></v-img>
              </v-flex>
            </v-layout>
          </v-flex>
        </v-card-text>
        

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog = false"
          >
            Close
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>

<script>

export default {
  props: [ 'project_id' ],
  name: 'Card',
  components: {
  },
  data () {
    return {
      title: '',
      sourceUrl: '',
      catName: '',
      projectUrl: '',
      projectGallery: [],
      projectContent: '',
      dialog: false,
    }
  },
  computed: {
    // projectUrl() {
    //   let allprojects = this.$store.state.allprojects;
    //   let allprojectsLength = allprojects.length;
    //   for ( let i = 0; i < allprojectsLength; i++ ) {

    //     if ( allprojects[i].project_id = project_id ) {
    //       console.log('Hello')
    //       this.projectUrl = allprojects[i].project_url;
    //     }
    //   }
    // }
  },
  methods: {
    fetchSingle: function( project_id ) {
      let projects = this.$store.state.allprojects;
      for( let i =0; i < projects.length; i++ ) {
        if( projects[i].project_id == project_id ) {
          if ( projects[i].hasOwnProperty('project_gallery').toString() == 'false' ) {
            let restUrl = frontend_ajax_object.rest_url;
            let singleProjectUrl = restUrl + 'projects/v1/single/' + project_id;
            this.axios.get( singleProjectUrl )
            .then((result) => {
              projects[i].project_url = result.data.project_url;
              projects[i].project_gallery = result.data.project_gallery;
              projects[i].project_content = result.data.project_content;
              this.projectContent = result.data.project_content;
              this.projectUrl = result.data.project_url;
              let projectGalleryObserver = result.data.project_gallery.image_url;
              this.projectGallery = JSON.parse(JSON.stringify(projectGalleryObserver));
              // console.log(projectGallery)
            })
          }
        }
      }
      console.log(projects)
      

      }
  },
  mounted: function() {
    const project_id = this.project_id
    const projects = this.$store.state.activeProjects;
    for( let i =0; i<projects.length; i++ ) {
      if ( projects[i].project_id == this.project_id ) {
        this.title = projects[i].project_title;
        this.sourceUrl = projects[i].project_cover;

        if ( Array.isArray( projects[i].project_cat ) ) {
          let catNames = Object.keys( projects[i].project_cat ).map( 
            function(key) { 
              return projects[i].project_cat[key]['name'];
            });
            this.catName = catNames.toString();
        }
      return;
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
