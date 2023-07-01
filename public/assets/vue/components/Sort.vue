<template>
  <div class="float-right">
    <b id="sort-heading">Sort by</b>
    <input type="checkbox" id="sort-title" value="title" v-on:click="titleChecked">
    <label for="sort-title">Title</label>
    <select id="projects-sort-title" @change="onChange($event)" v-if="isTitleChecked">
      <option :value="item.name" v-for="( item, index ) in titleOrder" :key="item.index">{{ item.text }}</option>
    </select>
    <input type="checkbox" id="sort-cat" value="cat" v-on:click="catChecked">
    <label for="sort-cat">Category</label>
    <select id="projects-sort-cat" @change="onChange($event)" v-if="isCatChecked">
      <option :value="item.name" v-for="( item, index ) in catOrder" :key="item.index">{{ item.text }}</option>
    </select>
  </div>
</template>

<script>
export default {
  name: 'Sort',
  data () {
    return {
      isTitleChecked: false,
      isCatChecked: false,
      titleOrder: [
        { 'name': 'titleasc', 'text': 'ASC' },
        { 'name': 'titledesc', 'text': 'DESC' },
      ],
      catOrder: [
        { 'name': 'catasc', 'text': 'ASC' },
        { 'name': 'catdesc', 'text': 'DESC' },
      ],
    }
  },
  methods: {
    titleChecked: function() {
      this.isTitleChecked = !this.isTitleChecked;
      this.$store.state.titleSortChecked = this.isTitleChecked;

      if ( this.isTitleChecked ) {
        this.$store.commit( 'sorting', 'titleasc' );
      } else {
        // this.$store.state.titleOrder = 'titleasc';
        this.$store.commit( 'sorting', 'titledefault' );
      }
    },
    catChecked: function() {
      this.isCatChecked = !this.isCatChecked
    },
    onChange: function( event ) {
      // console.log(event.target.value);
      this.$store.commit( 'sorting', event.target.value )
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
select {
  -webkit-appearance: auto;
}
</style>
