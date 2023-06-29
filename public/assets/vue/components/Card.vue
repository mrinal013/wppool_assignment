<template>
  <v-card
    class="mx-auto my-12"
    max-width="374"
  >
<!-- {{ project }} -->
    <v-img
      height="250"
      :src="sourceUrl"
    ></v-img>

    <v-card-title>Title: {{ title }}</v-card-title>

    

    <v-divider class="mx-4"></v-divider>

    <v-card-title>Category: {{ catName }}</v-card-title>

    

    <Dialog />
  </v-card>
</template>

<script>
import Dialog  from "./Dialog.vue";

export default {
  props: [ 'project_id' ],
  name: 'Card',
  components: {
    Dialog
  },
  data () {
    return {
      title: '',
      sourceUrl: '',
      catName: ''
    }
  },
  mounted: function() {
    const project_id = this.project_id
    const projects = this.$store.state.projects;
    for( let i =0; i<projects.length; i++ ) {
      if ( projects[i].project_id == this.project_id ) {
        this.title = projects[i].project_title;
        this.sourceUrl = projects[i].project_cover;

        if ( Array.isArray( projects[i].project_cat ) ) {
          let catNames = Object.keys( projects[i].project_cat ).map( function(key) { return projects[i].project_cat[key]['name'] } );
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
