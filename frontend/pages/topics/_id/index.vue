<template>
  <div class="container">
    <div class="bg-light mt-5 mb-5" style="padding:20px">
      <h2 class="display-3">{{topic.title}}</h2>
      <hr>
      <p class="text-muted">{{topic.created_at}} by {{topic.user.name}}</p>
      <div v-for="(content,index) in topic.posts" :key="index" class="ml-5 content">
        <p>{{content.body}}</p>
        <div v-if="content.file" class="image">
          <img :src="content.file" />
        </div>
        <div v-if="authenticated">
        <div v-if="user.id === content.user.id">
          <nuxt-link :to="{name:'topics-posts-edit',params:{id:$route.params.id,body:content.id}}">
            <button class="btn btn-outline-success  fa fa-edit pull-right">
            </button>
          </nuxt-link>
          <button @click="deletePost(content.id)" class="btn btn-outline-danger fa fa-trash pull-right"></button>
        </div>
      </div>
        <p class="text-muted">{{content.created_at}} by {{content.user.name}}</p>
      </div>
    </div>
    <div class="mt-5 ml-5" v-if="authenticated">
      <form @submit.prevent="create">
        <div class="form-group">
          <h4>Add a new post</h4>
          <textarea v-model="body" type="text" class="form-control" ></textarea>
          <small v-if="errors.body" class="form-text text-danger">{{errors.body[0]}}</small>


          <div class="mb-3">
  <label for="formFile" class="form-label">Default file input example</label>
  <input class="form-control" type="file" multiple id="formFile" ref="file" />
</div>

             
          <button class="btn btn-outline-primary">Add a new post</button>
        </div>
      </form>
      
    </div>
  </div>
</template>

<script>
  export default {
    data(){
      return{
        topic:'',
        body:''
      }
    },
    async asyncData({params,$axios}) {
      try{
        const {data} = await $axios.$get(`/topics/${params.id}`)
        console.log(data)
        return {
          topic:data
        }
      }catch(err) {
        console.log(err)
      }
    },
    computed: {
      files() {
        return Array.from(this.$refs.file.files).map(file => file)
      }
    },
    methods:{
      async create(){
        let formData = new FormData()
        this.files.forEach(file => {
          formData.append('medias[]',file,file.name)
        });
        formData.append('body',this.body)

console.log(this.files)

        for (var key of formData.entries()) {
        console.log(key[0] + ', ' + key[1]);
    }
         let config = {headers: {'content-type': 'multipart/form-data'}}
          try{
            let res = await this.$axios.$post(`/topics/${this.$route.params.id}/posts`,formData,config)
            console.log(res)
          this.$router.push('/topics')
          }catch(err) {
        console.log(err)
          }
      },
      async deletePost(id){
        try{
          await this.$axios.$delete(`/topics/${this.$route.params.id}/posts/${id}`)
          this.$router.push('/')
        }catch(err){
          console.log(err)
        }
      }
    },
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