
<template>
  <v-card
    class="mx-auto "
    elevation="0"
    color="#FAFAFA"
  >
    <v-list-item>
      <v-card-text>
        <v-card-title class="mb-0 pb-0 mr-0 pl-0 font-weight-bold">
          {{ topic.title }}
        </v-card-title>
        <div class="mb-5 mt-5">
          <v-card-text class="pl-0 d-flex flex-row align-center">
            <v-avatar
              class="mr-2"
              color="indigo"
              size="30"
            >
              <span class="white--text headline">DS</span>
            </v-avatar>
            <div class="d-flex flex-column ml-4">
              <!-- {{ topic.user.email }} -->
              <p class="font-weight-thin mb-0">
                {{ topic.created_at }}
              </p> 
            </div>
          </v-card-text> 
        </div>
        <div>
          (content of  the topic)
          dd Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut, nisi. Quaerat fuga ducimus voluptatibus eius delectus magnam, dignissimos neque, repudiandae, numquam eos iusto? Tenetur, maxime doloribus! Exercitationem ratione deserunt quasi!
        </div>
        <div class="mt-5 subtitle-2">
          {{ topic.posts.length }} answers
        </div>
        <div class="mt-5 subtitle-2">
          {{ topic.comments.length }} comments
          <v-btn
            icon
            @click="show = !show"
          >
            <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
          </v-btn>
        </div>
        <v-expand-transition>
          <div v-show="show">
            <comment
              v-for="(comment,index) in topic.comments"
              :key="index"
              class="mt-3 mb-3"
              :comment="comment"
            />
          </div>
        </v-expand-transition>
        <v-divider class="mb-5 mt-5" />
      </v-card-text>
    </v-list-item>
  </v-card>
</template>

<script>
import Comment from './Comment.vue'
export default {
  components: { Comment },
props:{
   topic:{
      type:Object,
      default:null,
    },
},
 data(){
        return{
          show: false,
        }
      },
mounted(){
  console.log(this.topic)
}
}
</script>

<style>

</style>