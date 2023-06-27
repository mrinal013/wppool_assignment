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
  props: [ 'project_id', 'title', 'media_url', 'project_cat' ],
  name: 'Card',
  components: {
    Dialog
  },
  data () {
    return {
    }
  },
  mounted: function() {
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
