<template>
  <v-card
    class="mx-auto "
    elevation="0"
    color="#FAFAFA"
  >
    <v-list-item>
      <v-card-text>
        <div class="mb-5 mt-5">
          <avatar-rounded
            v-if="isBetter==0"
            :post="post"
          />
          <avatar-normal
            v-else
            :post="post"
          >
            <template #username="{ user }">
              {{ user.id }}
            </template>
            <div class="d-flex flex-column ml-4">
              {{ post.user.email }}
              <p class="font-weight-thin mb-0">
                {{ post.created_at }}
              </p> 
            </div>
          </avatar-normal> 
        </div>
        <div>
          {{ post.body }}
        </div>
        <div class="mt-5 subtitle-2">
          {{ post.comments.length }} comments
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
              v-for="(comment,index) in post.comments"
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
import AvatarNormal from '../UiElements/AvatarNormal.vue'
import AvatarRounded from '../UiElements/AvatarRounded.vue'
export default {
  components: { AvatarNormal, AvatarRounded },
props:{
  isBetter:{
     type:Number,
  default:1,
  },
 
   post:{
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
  console.log(this.post)
}
}
</script>

<style scoped>
</style>