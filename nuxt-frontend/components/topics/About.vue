<template>
  <v-navigation-drawer
    permanent
    width="300px"
    color="transparent"
  >
    <div class="d-flex flex-column">
      <v-btn
      
        class="mb-3 mt-3"
        color="blue"
        dark
      >
        <v-icon>mdi-plus</v-icon> Start a new topic
      </v-btn>
      <v-card
        color="#FFFFFF"
        class="mt-10 mb-10 "
        outlined
        elevation="0"
      >
        <v-list rounded>
          <v-subheader>Top users</v-subheader>

          <v-list-item
            v-for="(item, i) in items"
            :key="i"
            class="d-flex justify-space-between flex-row align-center"
          >
            <span><v-avatar
              color="indigo"
              size="25"
            >
              <span class="white--text headline">DS</span>
            </v-avatar><span class="ml-2">{{ item.username }}</span></span>
            <span> {{ item.likes }} k <v-icon color="blue">mdi-arrow-up</v-icon></span>
          </v-list-item>
          <v-divider dark />
          <v-list-item class="d-flex justify-space-between flex-row align-center">
            <span><v-avatar
              color="indigo"
              size="25"
            >
              <span class="white--text headline">DS</span>
            </v-avatar><span class="ml-2">You</span></span>
            <span> 52 <v-icon color="blue">mdi-arrow-up</v-icon></span>
          </v-list-item>
        </v-list>
      </v-card>
      <v-card
        color="#FFFFFF"
        class="mt-10 mb-10 "
        outlined
        elevation="0"
      >
        <v-row class="pl-5 mt-5">
          <v-col cols="6">
            Help
          </v-col>
          <v-col cols="6">
            About
          </v-col>
        </v-row>
        <v-row class="pl-5">
          <v-col cols="6">
            Forum pro
          </v-col>
          <v-col cols="6">
            Careers
          </v-col>
        </v-row>
        <v-row class="pl-5">
          <v-col cols="6">
            Topics
          </v-col>
          <v-col cols="6">
            Press
          </v-col>
        </v-row>
        <v-row class="pl-5">
          <v-col cols="6">
            Top topics
          </v-col>
          <v-col cols="6">
            Terms
          </v-col>
        </v-row>
        <v-row class="pl-5">
          <v-col cols="6">
            Blog
          </v-col>
          <v-col cols="6">
            Privacy policy
          </v-col>
        </v-row>
        <v-row class="pl-5 mb-5">
          <v-col cols="6">
            Advertise
          </v-col>
        </v-row>
      </v-card>
    </div>
  </v-navigation-drawer>
</template>

<script>
export default {
  data: () => ({
    selectedItem: 1,
    items: [
      { username: 'Rajan N', likes: '15.5' },
      { username: 'Adrien P', likes: '14' },
      { username: 'Jeremei S', likes: '10' },
      { username: 'Lisan P', likes: '9.8' },
      { username: 'Maori Z', likes: '5.6' },
    ],
    linksitemxs: [
      { name: 'Help', to: '15.5' },
      { name: 'About', to: '14' },
      { name: '', to: '10' },
      { name: 'Lisan P', to: '9.8' },
      { name: 'Maori Z', to: '5.6' },
    ],
  }),
}
</script>

<style>
.rightBar .v-navigation-drawer__border {
  width: 0px;
}

.rightBar .v-list-item::after {
  content: none;
}
</style>
