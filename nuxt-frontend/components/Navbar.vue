<template>
  <div class="">
    <div class="d-flex">
      <v-row class="align-center">
        <v-col
          class="d-flex justify-start"
          cols="3"
        >
          <!-- <div>loll</div> -->
          
          <nuxt-link
            to="/"
          >
            <v-img
              height="80"
              width="auto"
              contain
              src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTWGdvhnIjfJLOwLGoOeHpINrvpkMrOcSOSzw&usqp=CAU"
            />
          </nuxt-link>
        </v-col>
        <v-col
          class="justify-center d-flex"
          cols="4"
          offset="1"
        >
          <v-text-field
            solo-inverted
            flat
            hide-details
            placeholder="search for topics"
            prepend-inner-icon="mdi-magnify"
            single-line
          />
        </v-col>
        <v-col
          class="d-flex justify-end"
          cols="3"
          offset="1"
        >
          <v-btn
            v-if="authPage"
            to="/"
          >
            Homepage
          </v-btn>

          <template v-else>
            <v-btn v-if="isAuthenticated">
              Account
            </v-btn>
            <v-btn
              v-else
              to="/auth"
            >
              Authentification
            </v-btn>
          </template>
        </v-col>
      </v-row>

      

    

     

      <!-- <v-toolbar-items>
        <v-btn
          v-for="item in nav"
          :key="item.icon"
          :to="item.link"
          :title="item.title"
          text
        >
          {{ item.text }}
        </v-btn>
      </v-toolbar-items> -->
    </div>
      
    <v-toolbar
      dark
      color="blue-grey darken-3"
      class="hidden-sm-and-up"
    >
      <v-toolbar-title>Mobile Menu</v-toolbar-title>
      <v-spacer />

      <v-dialog
        v-model="dialog"
        fullscreen
        hide-overlay
        transition="dialog-bottom-transition"
      >
        <template #activator="{ on, attrs }">
          <v-btn
            text 
            v-bind="attrs"
            v-on="on"
          >
            <v-icon
              dark
            >
              mdi-menu
            </v-icon>
          </v-btn>
        </template>
        <v-card>
          <v-toolbar
            text
            color="blue-grey darken-2"
          >
            <v-toolbar-title>Mobile Menu</v-toolbar-title>
            <v-spacer />
            <v-btn
              icon
              @click.native="dialog = false"
            >
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-toolbar>

          <v-list>
            <v-list-item
              v-for="(item, index) in nav"
              :key="index"
              to="#"
            >
              <v-list-item-action>
                <v-icon v-if="item.icon">
                  {{ item.icon }}
                </v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title :title="item.title">
                  {{ item.text }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card>
      </v-dialog>
    </v-toolbar>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      isAuthenticated: false,
      nav: [
        {
          icon: 'mdi-home',
          text: 'Home',
          title: 'Back to Home page',
          link: '/',
          active: true,
        },
        {
          icon: 'mdi-folder-plus',
          text: 'Create',
          title: 'Create new topic',
          link: '/create',
          active: false,
        },
        {
          icon: 'mdi-account-circle',
          text: 'Account',
          title: 'Your profile',
          link: '/profile',
          active: false,
        },
        {
          icon: 'mdi-login-variant',
          text: 'Auth',
          title: 'Go login',
          link: '/auth',
          active: false,
        },
      ],
    }
  },
  computed: {
    authPage() {
      return this.$route.path == '/auth'
    },

    status() {
      if (this.user) {
        return 'connected'
      } else {
        if (this.$router.currentRoute.name == 'auth') {
          return 'inlogin'
        } else {
          return 'unconnected'
        }
      }
    },
  },
  mounted() {
    console.log('router')

    console.log(this.status)
  },
}
</script>

<style>
.inputGrey .v-input__slot {
  background-color: red;
}
</style>