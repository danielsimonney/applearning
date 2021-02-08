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
        <div class="mt-5 subtitle-2">
          {{ post.comments.length }} comments
          <v-btn
            v-show="post.comments.length!=0"
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
            <div>
              <p>Write your comment</p>
              <v-textarea
                v-model="commentAnswer"
                label="Be polite and not more than 250 characters"
                placeholder="write your answer here"
                hint="Be polite"
                outlined
                rows="3"
                row-height="45"
                class="mb-5"
              />
              <create-button
                color="primary"
                text="Post your comment mdi"
                :loading="loadingstate"
                :disabled="loadingstate"
                @click="create"
              > 
                mdi-comment
              </create-button>
            </div>
          </div>
        </v-expand-transition>
        <div v-show="post.comments.length==0">
          <div>
            <p>Write your comment</p>
            <v-textarea
              v-model="commentAnswer"
              placeholder="write your answer here"
              label="Be polite and not more than 250 characters"
              hint="Be polite"
              outlined
              rows="3"
              row-height="45"
              class="mb-5"
            />
            <create-button
              color="primary"
              text="Post your comment"
              :loading="loadingstate"
              :disabled="loadingstate"
              @click="create"
            >
              mdi-comment
            </create-button>
          </div>
        </div>
        <v-divider class="mb-5 mt-5" />
      </v-card-text>
    </v-list-item>
  </v-card>
</template>

<script>
import AcceptModal from '../UiElements/AcceptModal.vue'
import AvatarNormal from '../UiElements/AvatarNormal.vue'
import AvatarRounded from '../UiElements/AvatarRounded.vue'
import CreateButton from '../UiElements/CreateButton.vue'
export default {
  components: { AvatarNormal, AvatarRounded, AcceptModal, CreateButton },
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