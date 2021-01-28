<template>
  <div class="mb-6">
    <v-toolbar
      dark
      color="blue-grey darken-1"
      class="hidden-sm-and-down"
    >
      <v-toolbar-title>
        <nuxt-link
          class="nav-link"
          to="/"
        >
          Topipost
        </nuxt-link>
      </v-toolbar-title>
      <v-spacer />
      <v-toolbar-items>
        <v-btn
          v-for="item in nav"
          :key="item.icon"
          :to="item.link"
          :title="item.title"
          text
        >
          {{ item.text }}
        </v-btn>
      </v-toolbar-items>
    </v-toolbar>
      
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
     data () {
    return {
      dialog: false,
      nav: [
        {
          icon: 'mdi-home',
          text: 'Home',
          title: 'Back to Home page',
          link:'/',
          active: true
        },
        {
          icon: 'mdi-folder-plus',
          text: 'Create',
          title: 'Create new topic',
          link:'/create',
          active: false
        },
        {
          icon: 'mdi-account-circle',
          text: 'Account',
          title: 'Your profile',
          link:'/profile',
          active: false
        },
        {
          icon: 'mdi-login-variant',
          text: 'Auth',
          title: 'Go login',
          link:'/auth',
          active: false
        }
      ]
    }
  }
  }
</script>

<style>

</style>