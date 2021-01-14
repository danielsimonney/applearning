<template>
  <div class="container">
    <h2>Latest Topics</h2>
    <div v-for="(topic,index) in topics" :key="index" class="bg-light mt-5 mb-5" style="padding:20px">
      <h2><nuxt-link :to="{name:'topics-id',params:{id:topic.id}}">{{topic.title}}</nuxt-link></h2>
      <div v-if="authenticated">
        <div v-if="user.id === topic.user.id">
          <nuxt-link :to="`/topics/${topic.id}/edit`">
            <button class="btn btn-outline-success  fa fa-edit fa-2x pull-right">
            </button>
          </nuxt-link>
          <button @click="deleteTopic(topic.id)" class="btn btn-outline-danger fa fa-trash fa-2x pull-right"></button>
        </div>
      </div>
      <p class="text-muted">{{topic.created_at}} by {{topic.user.name}}</p>
      <div v-for="(content,index) in topic.posts" :key="index" class="ml-5 content">
        {{content.body}}
        <div v-if="content.file" class="image">
          <div :key="index" v-for="(filename,index) in content.file">
            <img :src="filename" />
          </div>
        </div>
        <p class="text-muted">{{content.created_at}} by {{content.user.name}}</p>
      </div>
    </div>
    <nav>
      <ul class="pagination justify-content-center">
        <li v-for="(key,value) in links" :key="value" class="page-item">
          <a v-if="key!==null" @click="loadMore(key)" href="#" class="page-link">{{value}}</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        topics:[],
        links:[]
      }
    },
    async asyncData({$axios}) {
      try{
          let {data,links} = await $axios.$get('/topics')
          console.log(data[0].posts[11])
          return{
            topics:data,
            links
          }
          }catch(err) {
        console.log(err)
          }
    },
    methods: {
       async loadMore(key) {
         try{
          let {data,links} = await this.$axios.$get(key)
          this.topics = {...this.topics, ...data}
          this.links=links
          }catch(err) {
        console.log(err)
          }
      },
      async deleteTopic(id){
        try{
          await this.$axios.$delete(`/topics/${id}`)
          this.$router.push('/')
        }catch(err){
          console.log(err)
        }
      }
    }
  }
</script>

<style>
.content{
  margin-left: 30px;
  border-left: 15px solid white;
  padding: 0 10px 0 30px;
}

.btn-outline-success, .btn-outline-danger{
  border: none;
}

</style>