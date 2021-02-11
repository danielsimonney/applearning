
<template>
  <v-card
    class="mx-auto "
    elevation="0"
    color="#FAFAFA"
  >
    <v-list-item>
      <v-card-text>
        <accept-modal
          v-if="dialog"
          title="Are you sure you really want to supress this topic ??"
          answer="This action is irrevocable and you won't have the possibility to retrieve this topic. All the posts linked to this topic wil be supressed forever"
          @agree="dialog=false"
          @disagree="dialog=false"
        />
        
         
        <v-toolbar
          dense
          flat
          color="transparent"
        >
          <v-toolbar-title class="text-wrap">
            {{ topic.title }}
          </v-toolbar-title>

          <v-spacer />

          <option-button
            :to="`/topics/${topic.id}/edit`"
            text="Edit"
            color="warning"
            name="mdi-pencil"
          />


          <option-button
            text="delete"
            name="mdi-delete"
            color="error"
            @click="dialog=true"
          />
        </v-toolbar>
             
           
            
              

            


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
              <p class="font-weight-thin mb-0">
                {{ topic.created_at }}
              </p> 
            </div>
          </v-card-text> 
        </div>
        <div>
          {{ topic.body }}
        </div>
        <div class="mt-5 subtitle-2 d-flex flex-row justify-space-between align-center">
          <div class="d-flex flex-row">
            <v-icon
              :color="(userLike==true) ? 'blue' : 'grey'"
              @click="count(1)"
            >
              mdi-arrow-up
            </v-icon>
            <p
              class="my-2"
              :class="(userLike==false) ? 'red--text' : (userLike==true) ? 'blue--text' : 'grey--text'"
            >
              {{ likescount }}
            </p>
            <v-icon
              :color="(userLike==false) ? 'red' : 'grey'"
              @click="count(-1)"
            >
              mdi-arrow-down
            </v-icon>
          </div>
          <div>
            <v-icon>
              mdi-alert-octagon
            </v-icon> Report this topic
          </div>
        </div>
        <p class="mt-8">
          {{ topic.posts.length }} answers
        </p>
        <v-divider class="mb-5 mt-5" />
      </v-card-text>
    </v-list-item>
  </v-card>
</template>

<script>
import AcceptModal from '../UiElements/AcceptModal.vue'
import OptionButton from '../UiElements/optionButton.vue'
export default {
  components: { AcceptModal, OptionButton },
  props: {
    topic: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      show: false,
      likescount: 0,
      userLike: undefined,
      dialog: false,
    }
  },
  mounted() {
    this.likescount = Math.floor(Math.random() * (1 - 1000) + 1000)
  },
  methods: {
    count(nb) {
      if (this.userLike == undefined) {
        this.likescount += nb
        nb == 1 ? (this.userLike = true) : (this.userLike = false)
      } else {
        alert('vous avez déjà donné votre avis')
      }
    },
  },
}
</script>

<style></style>