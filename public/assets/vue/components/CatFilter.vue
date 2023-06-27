<template>
  <div>
    <ul>
      <li v-for="cat in projectCat" v-on:click="selectedCat(cat.catId)">
        <input type="checkbox" :id="`cat-${cat.catId}`" :name="cat.catName" :value="cat.catName">
        <label :for="`cat-${cat.catId}`">{{cat.catName}}</label><br>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'CatFilter',
  data () {
    return {
      checkbox: [],
      projectCat: [],
      selectedCatList: []
    }
  },
  methods: {
    selectedCat: function(categoryId) {
      console.log(categoryId)
    }
  },
  mounted: function() {

    // let rest_url = frontend_ajax_object.rest_url;
    // let projectCatUrl = rest_url + 'wp/v2/project_cat';
    // this.axios.get( projectCatUrl )
    // .then((result) => {
    //   for( let i=0; i<result.data.length; i++ ) {
    //     this.projectCat.push({
    //       'catId': result.data[i].id,
    //       'catName': result.data[i].name
    //     })
    //   }
    //   console.log(this.projectCat)
    // })
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
