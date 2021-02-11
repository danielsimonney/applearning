<template>
  <div class="container col-md-6 mt-5">
    <h3>Create a new topic</h3>
    <br>
    <form @submit.prevent="create">
      <div class="form-group">
        <label><strong>Topic title:</strong></label>
        <input v-model.trim="form.title" type="text" class="form-control" placeholder="Enter topic title" autofocus>
        <small class="form-text text-danger" v-if="errors.title">{{errors.title[0]}}</small>
      </div>
      <div class="form-group">
        <label><strong>Topic body:</strong></label>
        <textarea v-model="form.body" rows="10" class="form-control"></textarea>
        <small class="form-text text-danger" v-if="errors.body">{{errors.body[0]}}</small>
      </div>
       <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
        <span v-for="(content,index) in tags" :key="index">
          <input type="checkbox" :id="content.id" :value="content.id" v-model="form.tags" class="btn-check" autocomplete="off">
          <label class="btn btn-outline-primary" :for="content.id">{{content.name}}</label>
        </span>
      </div>
      <button type="submit" class="btn btn-primary">Create</button>
    </form>
  </div>
</template>

<script>
  export default {
    middleware:['auth'],
      data(){
        return{
          form:{
            title:'',
            body:'',
            tags:[],
          },
          tags:[],
          // tagsChecked:[],
        }
      },
      async asyncData({$axios}) {
        console.log("hi")
      try{
          let {data} = await $axios.$get('/tags')
          console.log(data)
          return{
            tags:data,
          }
          }catch(err) {
        console.log(err)
          }
    },
      methods:{
        async create(){
          console.log(this.form)
          try{
            await this.$axios.$post('/topics',this.form)
          this.$router.push('/')
          }catch(err) {
        console.log(err)
          }
        },
      },
    }
</script>

<style>

</style>










<div class="mb-5 mt-5">
          <avatar-normal
          v-if="isBetter==0"
            :postlist="post"
          />
           <avatar-rounded
            v-else
            :postlist="post"
          /> 
        </div>