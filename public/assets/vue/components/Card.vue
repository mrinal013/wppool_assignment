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

    <v-card-title>{{ title }}</v-card-title>

    

    <v-divider class="mx-4"></v-divider>

    <v-card-title>{{ catName }}</v-card-title>

    

    <Dialog />
  </v-card>
</template>

<script>
import Dialog  from "./Dialog.vue";

export default {
    props: [ 'project_id', 'title', 'media_url', 'project_cat' ],
  name: 'Card',
  components: {
    Dialog
  },
  data () {
    return {
      msg: 'I am card component',
      catName: '',
      sourceUrl: ''
    }
  },
  mounted: function() {
    const rest_url = frontend_ajax_object.rest_url;

    if ( typeof this.project_cat !== 'undefined' ) {
        let project_cat_url = rest_url + 'wp/v2/project_cat/' + this.project_cat
        this.axios.get( project_cat_url )
        .then((result) => {
            this.catName = result.data.name;
            this.axios.get( this.media_url )
            .then((result) => {
                console.log(result.data.source_url)
                this.sourceUrl = result.data.source_url
            })
        })
    }

    // if ( typeof this.media_url !== 'undefined' ) {
    //     this.axios.get( this.media_url )
    //     .then((result) => {
    //         console.log(result)
    //         this.sourceUrl = result.data.guid
    //     })
    // }
    console.log( this.sourceUrl )
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
