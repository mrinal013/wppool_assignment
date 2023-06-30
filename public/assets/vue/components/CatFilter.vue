<template>
  <div>
    <ul>
      <li v-for="(cat, key, index) in projectCat" :key="key">
        <input type="checkbox" :id="`cat-${cat.catId}`" :name="`cat-${cat.catId}`" v-on:click="selectedCat(cat.catId, $event)">
        <label :for="`cat-${cat.catId}`">{{cat.catName + ' (' + cat.count + ')'}}</label><br>
      </li>
    </ul>
  </div>
</template>

<script>
import { store } from '../store/store.js';

export default {
  name: 'CatFilter',
  data () {
    return {
      projectCat: [],
      catChecked: []
    }
  },
  methods: {
    selectedCat: function(categoryId, event) {

      this.$store.state.projectCats.map( function(key) {
        if ( key.catId === categoryId ) {
          key.isActive = event.target.checked;
        }
      });
      
      let storeCat = this.$store.state.projectCats;
      let totalCat = this.$store.state.projectCats.length;
      
        if ( event.target.checked ) {
          
          if ( ! this.catChecked.includes( categoryId ) ) {
            this.catChecked.push(categoryId);
          }

        } else {
            this.catChecked = this.catChecked.filter( item => item != parseInt(categoryId) )
        }
      
        this.$store.commit( 'checked', this.catChecked )
      }
  },
  mounted: function() {

    let rest_url = frontend_ajax_object.rest_url;
    let projectCatUrl = rest_url + 'wp/v2/project_cat';
    this.axios.get( projectCatUrl )
    .then((result) => {
      for( let i=0; i<result.data.length; i++ ) {
        this.$store.state.projectCats.push({
          'catId': result.data[i].id,
          'catName': result.data[i].name,
          'count': result.data[i].count,
          'isActive': false
        })
      }
      this.projectCat = this.$store.state.projectCats;
    })
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
