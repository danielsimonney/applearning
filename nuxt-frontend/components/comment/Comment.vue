<template>
  <div>
    <div class="mt-5 subtitle-2">
      {{ commentNumber }} comments
      <v-btn
        v-show="commentNumber!=0"
        icon
        @click="switchShow"
      >
        <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
      </v-btn>
    </div>
    <v-expand-transition>
      <div v-show="show">
        <div
          v-for="comment in comments"
          :key="comment.id"
        >
          <div class="d-flex flex-row justify-space-between align-center">
            <p class="display-1">
              {{ comment.user.name }}
            </p>
            <p class="text-caption">
              Commented {{ comment.created_at }}
            </p>
          </div>
          <p>
            {{ comment.body }}
          </p>
        </div>
        <v-btn @click="loadmore">
          See more comments
        </v-btn>
        <v-card>
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
        </v-card>
      </div>
    </v-expand-transition>
    <div v-show="comments.length==0">
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
  </div>
</template>

<script>
export default {
  props: {
    id: {
      type: Number,
      default: null,
    },
    commentNumber: {
      type: Number,
      default: null,
    },
  },
  data() {
    return {
      commentShow: false,
      show: false,
      loadingstate: null,
      commentAnswer: null,
      meta: {},
      comments: {},
    }
  },
  mounted() {
    console.log(this.comments)
  },
  methods: {
    create() {
      this.loadingstate = true
    },
    async switchShow() {
      this.show = !this.show
      if (this.show == false) {
        this.comments = {}
        this.meta = {}
      } else {
        const { data, meta } = await this.$axios.$get(`/${this.id}/comments`)
        console.log(meta)
        this.comments = data
        this.meta = meta
      }
    },
    async loadmore() {
      const { data, meta } = await this.$axios.$get(this.meta.links[2].url)
      this.comments = [...this.comments, ...data]
      this.meta = meta
    },
  },
}
</script>

<style></style>