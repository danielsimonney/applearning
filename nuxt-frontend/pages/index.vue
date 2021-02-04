<template>
  <v-col
    cols="6"
  >
    <card
      v-for="(topic,index) in topics"
      :key="index"
      class="mt-3 mb-3"
      :topic="topic"
    />
  </v-col>
  <about />
</template>

<script>
import About from '../components/topics/About.vue';
import Card from '../components/topics/Card';


export default {
  components: {
    Card,
    About,
      },
  layout:"default",
  //  middleware:['auth'],

   async asyncData({$axios}) {
      try{
          let {data,links} = await $axios.$get('/topics')
          console.log(data)
          return{
            topics:data,
            links
          }
          }catch(err) {
        console.log(err)
          }
    },
}
</script>


<style scoped>

</style>
