<template>
  <div class="container">
    <h2>Update topic title</h2>
    <form @submit.prevent="update">
      <div class="form-group mt-5">
        <input type="text" class="form-control" v-model="form.title">
        <small v-if="errors.title" class="form-text text-danger">{{errors.title[0]}}</small>
      </div>


       <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
        <span v-for="(content,index) in tags" :key="index">
          <input type="checkbox" :id="content.id" :value="content.id" v-model="form.tags" class="btn-check" autocomplete="off">
          <label class="btn btn-outline-primary" :for="content.id">{{content.name}}</label>
        </span>
      </div>

      <button class="btn btn-outline-success">Update</button>
    </form>
    <p class="mt-5 btn btn-outline-warning">
      <nuxt-link to="/topics">Back to topics</nuxt-link>
    </p>
  </div>
</template>

<script>
export default {
  data(){
    return{
      tags:[],
      form: {},
      topic:{
        title:'',
        tags:[],
      }
    }
  },
  async asyncData({$axios,route,params}){
    const {data} = await $axios.$get(`/topics/${params.id}`)
    return {topic : data}
  },
  mounted(){
      this.loadTags()
      this.setForm()
  },
  methods: {
    setForm(){
      this.form.title = this.topic.title
      this.form.tags = this.topic.tags.map(item => item.id)
    },
    async loadTags(){
      try{
          let {data} = await this.$axios.$get('/tags')
          console.log(data)
          this.tags=data
          }catch(err) {
        console.log(err)
      }
    },
    async update(){
      console.log(this.form)
      await this.$axios.patch(`/topics/${this.$route.params.id}`,{
        title: this.form.title,
        tags:this.form.tags
      })
      this.$router.push('/topics')
    }
  }
}
</script>

<style>

</style>