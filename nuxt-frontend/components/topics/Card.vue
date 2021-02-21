<template>
  <div>
    <v-hover>
      <template #default="{ hover }">
        <v-card
          :elevation="hover ? 4 : 0"
          color="#FFFFFF"
          class="mx-auto mb-10"
        >
          <v-row>
            <v-col
              cols="1 ml-6"
              class="justify-center d-flex flex-column align-center align-self-center"
            >
              <div class="text-center">
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
            </v-col>
            <v-col cols="10 px-0">
              <v-list-item>
                <v-card-text>
                  <v-card-title class="blue--text display-1 mb-4 mr-0 px-0 font-weight-bold">
                    <nuxt-link :to="{name:'topics-topic',params:{topic:topic.id}}">
                      {{ topic.title }}
                    </nuxt-link>
                  </v-card-title>
                                    
                  <div>
                    {{ topic.body }}
                  </div>
                  <v-divider class="mb-5 mt-5" />
                  <div class="d-flex align-center">
                    <span>
                      <v-avatar
                        class="mr-2"
                        color="indigo"
                        size="30"
                      >
                        <span class="white--text headline">DS</span>
                      </v-avatar> Posted by <span class="blue--text">{{ topic.user.email }}</span> 

                    </span>


                    <span class="ml-5">
                      {{ topic.created_at }}
                    </span>
                    <v-spacer />
                    <v-icon>
                      mdi-comment-outline
                    </v-icon>
                    <span class="ml-3">
                      50+
                  
                    </span>
                  </div>
                </v-card-text>
              </v-list-item>
            </v-col>
          </v-row>
        </v-card>
      </template>
    </v-hover>
  </div>
</template>

<script>
export default {
  props: {
    topic: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      likescount: 0,
      userLike: undefined,
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