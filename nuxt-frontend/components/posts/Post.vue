<template>
  <v-card
    class="mx-auto "
    elevation="0"
    color="#FAFAFA"
  >
    <v-list-item>
      <v-card-text>
        <create-button
          :to="`/topics/posts/${post.id}/edit`"
          color="warning"
          text="Edit"
          :loading="loadingstate"
          :disabled="loadingstate"
        >
          mdi-pencil
        </create-button>

        <create-button
          text="delete"
          color="error"
          :loading="loadingstate"
          :disabled="loadingstate"
          @click="dialog=true"
        >
          mdi-delete
        </create-button>
        <accept-modal
          v-if="dialog"
          title="Are you sure you really want to supress this post ??"
          answer="This action is irrevocable and you won't have the possibility to retrieve this post."
          @agree="dialog=false"
          @disagree="dialog=false"
        />
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
        <comment
          :id="post.id"
          :comment-number="post.comments_count"
        />
        <v-divider class="mb-5 mt-5" />
      </v-card-text>
    </v-list-item>
  </v-card>
</template>

<script>
import Comment from '../comment/Comment'
import AcceptModal from '../UiElements/AcceptModal.vue'
import AvatarNormal from '../UiElements/AvatarNormal.vue'
import AvatarRounded from '../UiElements/AvatarRounded.vue'
import CreateButton from '../UiElements/CreateButton.vue'
export default {
  components: { AvatarNormal, AvatarRounded, AcceptModal, CreateButton, Comment },
  props: {
    isBetter: {
      type: Number,
      default: 1,
    },

    post: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      dialog: false,
      loadingstate: null,
      commentAnswer: null,
      show: false,
    }
  },
  mounted() {
    console.log(this.post)
  },

  methods: {
    create() {
      this.loadingstate = true
    },
  },
}
</script>

<style scoped></style>