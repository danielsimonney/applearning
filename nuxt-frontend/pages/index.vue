<template>
  <v-card
    class="cardBase mb-15 pr-10 pl-10"
    color="#FAFAFA"
  >
    <v-row
      align="start"
      justify="center"
    >
      <v-col
        cols="3"
      >
        <my-toolbar />
      </v-col>
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
      <v-col
        cols="3"
      />
    </v-row>
  </v-card>
</template>

<script>
import Card from '../components/topics/Card';
import MyToolbar from '../components/topics/MyToolbar.vue';


export default {
  components: {
    Card,
    MyToolbar,
  
    
    
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
.cardBase{
  margin-top:140px;
}
</style>
