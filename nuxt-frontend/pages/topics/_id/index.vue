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
        cols="9"
      >
        <card-show :topic="topic" />
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
import CardShow from '../../../components/topics/CardShow.vue'
  export default {
  components: {CardShow  },
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
    data(){
      return{
        topic:'',
        body:''
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